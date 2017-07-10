<?php

namespace HistoricalMeteorological\Data\Parser\Strategy;

class RandomWhitespacePaddingStrategy implements TextStrategyInterface
{
    /**
     * @inheritdoc
     */
    public function parseTextIntoArray($text)
    {
        $matches = [];
        preg_match_all('([\d.-]+%?)', $text, $matches);
        return isset($matches[0]) ? $matches[0] : [];
    }
}
