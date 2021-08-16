<?php

namespace JollyBlueMan\Console\Command;

use JollyBlueMan\Console\UtilityBelt\Credentials;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command
{
    protected static $defaultName = "console:greet";

    protected function configure(): void
    {
        $this
            ->setDescription("Greets a user.")
            ->setHelp("All users can be greeted by this.")
        ;

        $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
        $this->addArgument('password', InputArgument::OPTIONAL, 'User password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument("username");
        $password = $input->getArgument("password");

        $greeting = "Please connect before accessing the program.";
        if (Credentials::validateLogin($username, $password) == true) {
            $greeting = "Welcome Phantom Program, " . $username;
        }
        $output->writeln($greeting);

        return Command::SUCCESS;
    }
}
