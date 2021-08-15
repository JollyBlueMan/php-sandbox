<?php

namespace JollyBlueMan\Console\Command;

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
            ->setHelp("Authenticated users can be greeted by this.")
        ;

        $this->addArgument("username", InputArgument::REQUIRED, "The user's username.");
        //$this->addOption("--yell", "-y",InputArgument::OPTIONAL, "The volume in which the greeting should be typed.");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $greeting = "Welcome Phantom Program Initiate, " . $input->getArgument("username");
        /*if ($input->getOption("--yell")) {
            $greeting = strtoupper($greeting);
        }*/

        $output->writeln($greeting);

        return Command::SUCCESS;
    }
}
