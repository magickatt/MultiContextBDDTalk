<?php

namespace HistoricalMeteorological\Data;

use HistoricalMeteorological\Entity\Entry;
use InvalidArgumentException;
use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Data\Loader\LoaderInterface;
use HistoricalMeteorological\Data\Parser\ParserInterface;
use SeekableIterator;

class Converter
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var LoaderInterface */
    private $loader;

    /** @var ParserInterface */
    private $parser;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager, LoaderInterface $loader, ParserInterface $parser)
    {
        $this->objectManager = $objectManager;
        $this->loader = $loader;
        $this->parser = $parser;
    }

    /**
     * @param SeekableIterator $location
     */
    public function convert(SeekableIterator $location)
    {
        foreach ($this->loader->getResources($location) as $resource) {
            $rows = $this->loader->getRows($resource);

            foreach ($this->parser->getEntries($rows) as $entry) {
                $entity = $this->convertEntryToEntity($entry);
                $entity->setLocation($resource->getBasename('.txt'));
                if ($entity->hasYear()) {
                    $this->objectManager->persist($entity);
                }
            }
            $this->objectManager->flush();
        }
    }

    /**
     * @param array $entry
     * @return Entry
     */
    private function convertEntryToEntity(array $entry):Entry
    {
        $entity = new Entry();

        if (!empty($entry) && strlen($entry[0]) == 4) {
            $this->addMandatoryPropertiesToEntityFromEntry($entity, $entry);
            $this->addOptionalPropertiesToEntityFromEntry($entity, $entry);
        }

        return $entity;
    }

    /**
     * Add mandatory properties to the entity
     * @param Entry $entity
     * @param array $entry
     */
    private function addMandatoryPropertiesToEntityFromEntry(Entry $entity, array $entry)
    {
        $entity->setYear((int)$entry[0]);
        $entity->setMonth((int)$entry[1]);
    }

    /**
     * Inefficient workaround to handle missing values in the data
     * @param Entry $entity
     * @param array $entry
     */
    private function addOptionalPropertiesToEntityFromEntry(Entry $entity, array $entry)
    {
        if ($entry[2] != '---') {
            $entity->setTemperatureMaximum((float)$entry[2]);
        }
        if ($entry[3] != '---') {
            $entity->setTemperatureMinimum((float)$entry[3]);
        }
        if ($entry[5] != '---') {
            $entity->setRainVolume((float)$entry[5]);
        }
        if ($entry[6] != '---') {
            $entity->setSunDuration((float)$entry[6]);
        }
    }

    private function convertHeaderToEntity(array $heading)
    {
        // @todo Create entity from location information in header
    }
}
