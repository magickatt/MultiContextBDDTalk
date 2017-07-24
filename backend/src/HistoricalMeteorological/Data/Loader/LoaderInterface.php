<?php

namespace HistoricalMeteorological\Data\Loader;

use Generator;
use SeekableIterator;

interface LoaderInterface
{
    /**
     * @param SeekableIterator $location
     * @return Generator
     */
    public function getResources(SeekableIterator $location):Generator;

    /**
     * Get rows from somewhere
     * @param mixed $resource
     * @return Generator
     */
    public function getRows($resource):Generator;
}
