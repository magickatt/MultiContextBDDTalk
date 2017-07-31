<?php

namespace HistoricalMeteorological\Data;

use HistoricalMeteorological\Entity\Entry;
use InvalidArgumentException;
use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Data\Loader\LoaderInterface;
use HistoricalMeteorological\Data\Parser\ParserInterface;
use SeekableIterator;
use DirectoryIterator;
use Symfony\Component\Finder\SplFileInfo;

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
                $entity->setLocation($this->extractLocationSlugFromResource($resource));
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
        if (isset($entry[2]) && $entry[2] != '---') {
            $entity->setTemperatureMaximum((float)$entry[2]);
        }
        if (isset($entry[3]) && $entry[3] != '---') {
            $entity->setTemperatureMinimum((float)$entry[3]);
        }
        if (isset($entry[5]) && $entry[5] != '---') {
            $entity->setRainVolume((float)$entry[5]);
        }
        if (isset($entry[6]) && $entry[6] != '---') {
            $entity->setSunDuration((float)$entry[6]);
        }
    }

    /**
     * Quick way to determine the location slug
     * @param DirectoryIterator $resource
     * @return bool|string
     */
    private function extractLocationSlugFromResource(DirectoryIterator $resource)
    {
        $basename = $resource->getBasename('.txt');
        return substr($basename, 0, strlen($basename) - 4); // remove "data" from the end
    }
}
