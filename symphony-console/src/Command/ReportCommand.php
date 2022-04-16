<?php

namespace JollyBlueMan\Console\Command;

use JollyBlueMan\Console\Output\Message;
use JollyBlueMan\Console\UtilityBelt\Credentials;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReportCommand extends Command
{
    protected static string $defaultName = "console:report";
    protected bool $authenticated = false;

    protected function configure()
    {
        $this
            ->setHidden(true)
            ->setDescription("For the issuance of reports.")
            ->setHelp("Sign in for further information.")
        ;

        $this->addArgument('elevation', InputArgument::REQUIRED, '[CLASSIFIED]');

        $this->addOption("data-a", "a",InputArgument::OPTIONAL, "[CLASSIFIED]");
        $this->addOption("data-b", "b",InputArgument::OPTIONAL, "[CLASSIFIED]");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $elevation = Credentials::verifyElevation($input->getArgument("elevation"));
        $data_a = $input->getOption("data-a");
        $data_b = $input->getOption("data-b");

        if ($elevation == 0) {
            return Command::FAILURE;
        } elseif ($elevation == 1 && password_verify($data_a, '$2y$10$MusbxE1hSaVgaHV5NF3SXuRq7StvW2r/5PtzOJbBP0j3lM6SmQ4pm') && password_verify($data_b, '$2y$10$z0Pn0OHe8zZtauZJTt5Tuei37LHrZW2R6MdDCb.dTPQ7CgEX05YmS')) {
            $output->writeln(Message::retrieve("report.event.a"));
        }

        return Command::SUCCESS;
    }
}