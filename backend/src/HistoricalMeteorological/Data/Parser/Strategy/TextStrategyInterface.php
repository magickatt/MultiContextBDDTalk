<?php

namespace HistoricalMeteorological\Data\Parser\Strategy;

interface TextStrategyInterface
{
    /**
     * Parse text into an array
     * @param string $text
     * @return array
     */
    public function parseTextIntoArray($text);
}
