<?php

namespace HistoricalMeteorological\Data\Parser;

use Generator;

interface ParserInterface
{
    /**
     * Get entry for each row
     * @param Generator $rows
     * @return Generator
     */
    public function getEntries(Generator $rows):Generator;
}
