<?php
namespace JollyBlueMan\Console\Command;

use Symfony\Component\Console\Command\Command;
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

        $section->write("Initialising...");
        sleep(1);

        $section->overwrite("...Initialising...");
        sleep(1);

        $section->clear();
        sleep(2);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException("This command accepts only an instance of 'ConsoleOutputInterface'.");
        }

        $section = $output->section();
        $section->write("Initialised!");
        sleep(2);

        $section->clear();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            "User Creator",
            "================"
        ]);

        $output->write($this->thinkingAboutIt());
        $output->writeln("Whoa!");
        sleep(1);

        $output->write("You are about to ");
        $output->write("create a user.\n\n");
        sleep(1);

        $output->writeln('They\'re called: ' . $input->getArgument('username'));
        sleep(1);

        $output->writeln("Their password is " . $input->getArgument('password'));

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
}