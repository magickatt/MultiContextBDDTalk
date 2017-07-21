<?php

namespace HistoricalMeteorological\Data\Loader;

use Generator;

interface LoaderInterface
{
    /**
     * Get rows from somewhere
     * @return Generator
     */
    public function getRows():Generator;
}
