<?php

namespace HistoricalMeteorological\Command;

use DirectoryIterator;
use Doctrine\ORM\EntityManager;
use HistoricalMeteorological\Data\Converter;
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
    const NAME = 'import:data';
    const DESCRIPTION = 'Import or re-import data from text files.';

    /** @var Converter */
    private $converter;

    /** @var DirectoryIterator  */
    private $directoryIterator;

    /**
     * @param Converter $converter
     * @param DirectoryIterator $directoryIterator
     */
    public function __construct(Converter $converter, DirectoryIterator $directoryIterator)
    {
        $this->converter = $converter;
        $this->directoryIterator = $directoryIterator;

        parent::__construct(self::NAME);
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName(self::NAME)
             ->setDescription(self::DESCRIPTION);
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Importing historical meteorological data from text files.');
        $this->converter->convert($this->directoryIterator);
        $output->writeln('Finished importing.');
    }
}
