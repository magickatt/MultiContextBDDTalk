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

    /** @var Converter */
    private $converter;

    /**
     * @param Converter $converter
     */
    public function __construct(Converter $converter)
    {
        $this->converter = $converter;
        parent::__construct(self::NAME);
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('import:data')
             ->setDescription('Import or re-import data from text files.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Importing historical meteorological data from text files.');
        $this->converter->convert(new DirectoryIterator(__DIR__.'/../../../data/database/txt'));
        $output->writeln('Finished importing.');
    }
}
