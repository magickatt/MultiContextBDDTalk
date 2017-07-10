<?php

namespace HistoricalMeteorological\Data\Parser\Text;

use Generator;
use HistoricalMeteorological\Data\Parser\ParserInterface;
use HistoricalMeteorological\Data\Parser\Strategy\TextStrategyInterface;

class TextParser implements ParserInterface
{
    /** @var Generator */
    private $rows;

    /** @var TextStrategyInterface */
    private $textParsingStrategy;

    /**
     * @param Generator $rows
     * @param TextStrategyInterface $textParsingStrategy
     */
    public function __construct(Generator $rows, TextStrategyInterface $textParsingStrategy)
    {
        $this->rows = $rows;
        $this->textParsingStrategy = $textParsingStrategy;
    }

    /**
     * Get entry for each row
     * @return Generator
     */
    public function getEntries()
    {
        foreach ($this->rows as $row) {
            yield $this->textParsingStrategy->parseTextIntoArray($row);
        }
    }
}
