<?php

namespace HistoricalMeteorological\Data\Parser\Strategy;

/**
 * Parse text as fields delimited by random amounts of whitespace (pseudo-columns)
 */
class RandomWhitespacePaddingStrategy implements TextStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function parseTextIntoArray(string $text):array
    {
        $matches = [];
        preg_match_all('([\d.-]+%?)', $text, $matches);
        return isset($matches[0]) ? $matches[0] : [];
    }
}
