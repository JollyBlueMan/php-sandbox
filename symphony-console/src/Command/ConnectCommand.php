<?php
namespace JollyBlueMan\Console\Command;

use JollyBlueMan\Console\UtilityBelt\Credentials;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConnectCommand extends ConsoleCommand
{
    protected static string $defaultName = "console:connect";
    protected int $elevationLevel;

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
        ;

        $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
        $this->addArgument('password', InputArgument::OPTIONAL, 'User password');

        $this->addOption(
            'elevation',
            'e',
            InputOption::VALUE_OPTIONAL,
            'Elevated access',
            0
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException("This command accepts only an instance of 'ConsoleOutputInterface'.");
        }

        $this->elevationLevel = Credentials::verifyElevation($input->getOption('elevation'));

        if ($this->elevationLevel == 0) {
            $section = $output->section();

            $section->write("<comment>Initialising...</comment>");
            sleep(1);

            $section->overwrite("<comment>...Initialising...</comment>");
            sleep(1);

            $section->clear();
            sleep(2);
        }
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException("This command accepts only an instance of 'ConsoleOutputInterface'.");
        }

        if ($this->elevationLevel < 2) {
            $hash = password_hash((new \DateTime())->format("Y-m-d"), PASSWORD_DEFAULT);
            $section = $output->section();
            $section->write("<info>Initialised - {$hash}</info>");
            sleep(2);

            $section->clear();
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = strtolower($input->getArgument('username'));
        $password = $input->getArgument('password');
        $elevation = $this->elevationLevel;

        $output->writeln([
            "<info>Phantom Program Online</info>",
            "-..- / -- .- .-. -.- ... / - .... . / ... .--. --- -"
        ]);

        if ($elevation <= 4) {
            $output->write("<question>You are about to </question>");
            $output->write("<question>establish a user connection.</question>\n\n");
            sleep($elevation < 2 ? 1 : 0);

            $output->writeln('Username: ' . $username);
            sleep($elevation < 2 ? 1 : 0);

            if ($elevation < 1) {
                $section = $output->section();
                $section->write("<comment>Attempting decryption...</comment>");
                sleep(1);
                $section->overwrite("<comment>...decrypting...</comment>");
                sleep(2);
                $section->overwrite("<comment>Chi:(accord-acc(UNAME)*accord-acc(AUTH))</comment>");
                sleep(1);
                $section->overwrite("<comment>Upsilon:(str_replace(UNAME,CONTROL)/chr(AUTH++))</comment>");
                sleep(1);
                $section->overwrite("<comment>Zeta:(base_encode(UNAME,CONTROL,2) . fopen(SEC))</comment>");
                sleep(1);
                $section->overwrite("<comment>...decrypting...</comment>");
                sleep(2);
            }
        }

        if (Credentials::validateLogin($username, $password) == false) {
            $section->overwrite("<error>Decryption error.</error>");
            sleep(1);
            $section->overwrite("<error>Running cleanup routine...</error>");
            sleep(1);
            $section->overwrite("Exiting...");
            sleep(1);
            $section->clear();

            return Command::INVALID;
        }

        if ($elevation < 4) {
            if ($elevation < 3) {
                $output->writeln(password_hash($password, PASSWORD_DEFAULT));
                sleep($elevation < 2 ? 1 : 0);
                $output->write($this->thinkingAboutIt());
            }
            $output->writeln("<comment>Secure connection established.</comment>");
            sleep($elevation < 2 ? 1 : 0);

            if ($elevation < 2) {
                $output->write($this->thinkingAboutIt());
            }
        }

        $this->session->set("username", $username);
        $this->session->set("password", $password);
        $this->session->set("elevation", $elevation);

        $command    = $this->getApplication()->find("console:greet");
        $greetInput = new ArrayInput([
            'username' => $username,
            'password' => $password
        ]);
        $returnCode = $command->run($greetInput, $output);

        return Command::SUCCESS;
    }
}