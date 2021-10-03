<?php

namespace JollyBlueMan\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static string $defaultName = "console:my-command";

    protected function configure(): void
    {
        $this
            ->setHidden(true) // Hides command from suggestions/list
            ->setDescription('TestCommand is just an example')
            ->setHelp('Don\'t read too much into it')
        ;

        $this->addOption("yell", "y",InputArgument::OPTIONAL, "The volume in which the greeting should be typed.");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException("This command accepts only an instance of 'ConsoleOutputInterface'.");
        }
        $volume = 0;
        if ($input->getOption("yell")) {
            $volume = 7;
        }

        // establish 2 sections
        $section1 = $output->section();
        $section2 = $output->section();

        // prints Hello\nWorld!\n
        $section1->writeln($volume > 5 ? "HELLO" : "Hello");
        $section2->writeln($volume > 5 ? "WORLD!" : "world.");
        sleep(2);

        // overwrites Hello to Goodbye\nWorld\n
        $section1->overwrite("Goodbye");
        sleep(2);

        // removes all of section 2 (aka World\n)
        $section2->clear();
        sleep(2);

        // removes given number of lines (aka everything including Goodbye\n)
        $section1->clear(2);
        sleep(2);

        return Command::SUCCESS;
    }
}