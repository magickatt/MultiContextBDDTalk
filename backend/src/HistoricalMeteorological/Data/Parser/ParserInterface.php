<?php

namespace HistoricalMeteorological\Data\Parser;

use Generator;

interface ParserInterface
{
    /**
     * Get entry for each row
     * @return Generator
     */
    public function getEntries():Generator;
}
