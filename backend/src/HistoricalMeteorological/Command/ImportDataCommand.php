<?php

namespace HistoricalMeteorological\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Import text files containing historical meteorological data into the database
 *
 * Note: this is registered directly in the console executable for simplicity (see documentation link below)
 * @link https://github.com/KnpLabs/ConsoleServiceProvider/blob/master/doc/adding-commands.md
 */
class ImportDataCommand extends Command
{
    protected function configure()
    {
        $this->setName('import:data')
             ->setDescription('Import or re-import data from text files.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Test');
    }
}
