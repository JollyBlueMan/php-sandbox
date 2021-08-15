<?php
namespace JollyBlueMan\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = "console:create-user";

    private bool $requirePassword;

    public function __construct(bool $requirePassword = false)
    {
        $this->requirePassword = $requirePassword;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
        ;

        $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
        $this->addArgument('password', $this->requirePassword ? InputArgument::REQUIRED : InputArgument::OPTIONAL, 'User password');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException("This command accepts only an instance of 'ConsoleOutputInterface'.");
        }

        $section = $output->section();

        $section->write("<comment>Initialising...</comment>");
        sleep(1);

        $section->overwrite("<comment>...Initialising...</comment>");
        sleep(1);

        $section->clear();
        sleep(2);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException("This command accepts only an instance of 'ConsoleOutputInterface'.");
        }

        $hash = password_hash((new \DateTime())->format("Y-m-d"), PASSWORD_DEFAULT);
        $section = $output->section();
        $section->write("<info>Initialised - {$hash}</info>");
        sleep(2);

        $section->clear();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = strtolower($input->getArgument('username'));
        $password = $input->getArgument('password');

        $output->writeln([
            "<info>Phantom Program Online</info>",
            "-..- / -- .- .-. -.- ... / - .... . / ... .--. --- -"
        ]);

        $output->write("<question>You are about to </question>");
        $output->write("<question>establish a user connection.</question>\n\n");
        sleep(1);

        $output->writeln('Username: ' . $username);
        sleep(1);

        $section = $output->section();
        $section->write("<comment>Attempting decryption...</comment>");
        sleep(1);
        $section->overwrite("<comment>...decrypting...</comment>");
        sleep(2);
        $section->overwrite("<comment>Chi:(ord(UNAME)*ord(AUTH))</comment>");
        sleep(1);
        $section->overwrite("<comment>...decrypting...</comment>");
        sleep(2);

        $info = $this->getCredentials();
        if ($password != (ord(json_decode(file_get_contents(__DIR__."/../../{$info['0']}.{$info[1]}"), true)[$info[2]]) * ord($username))) {
            $section->overwrite("<error>Decryption error.</error>");
            sleep(1);
            $section->overwrite("<error>Running cleanup routine...</error>");
            sleep(1);
            $section->overwrite("Exiting...");
            sleep(1);
            $section->clear();

            return Command::INVALID;
        }

        $output->writeln(password_hash($password, PASSWORD_DEFAULT));
        sleep(1);

        $output->write($this->thinkingAboutIt());
        $output->writeln("<comment>Secure connection established.</comment>");
        sleep(1);

        $output->write($this->thinkingAboutIt());

        $command    = $this->getApplication()->find("console:greet");
        $greetInput = new ArrayInput([
            'username'   => $username,
        ]);
        $returnCode = $command->run($greetInput, $output);

        return Command::SUCCESS;
        // or return Command::FAILURE;
        // or return Command::INVALID;
    }

    private function thinkingAboutIt(): \Generator
    {
        foreach ([".", ".", "."] as $step) {
            yield $step;
            sleep(1);
        }
    }

    private function getCredentials(): array
    {
        return [
            $this->decipher([3,15,13,16,15,19,5,18]),
            $this->decipher([10,19,15,14]),
            $this->decipher([14,1,13,5])
        ];
    }

    private function decipher($input): string
    {
        $output = "";
        foreach ($input as $item) {
            $output .= strtolower(chr($item + 64));
        }

        return $output;
    }
}