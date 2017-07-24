<?php

namespace HistoricalMeteorological\Data\Parser\Text;

use Generator;
use HistoricalMeteorological\Data\Parser\ParserInterface;
use HistoricalMeteorological\Data\Parser\Strategy\TextStrategyInterface;

class TextParser implements ParserInterface
{
    /** @var TextStrategyInterface */
    private $textParsingStrategy;

    /**$rows
     * @param TextStrategyInterface $textParsingStrategy
     */
    public function __construct(TextStrategyInterface $textParsingStrategy)
    {
        $this->textParsingStrategy = $textParsingStrategy;
    }

    /**
     * Get entry for each row
     * @param Generator $rows
     * @return Generator
     */
    public function getEntries(Generator $rows):Generator
    {
        foreach ($rows as $row) {
            yield $this->textParsingStrategy->parseTextIntoArray($row);
        }
    }
}
