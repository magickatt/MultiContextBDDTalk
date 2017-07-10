<?php

namespace spec\HistoricalMeteorological\Data\Parser\Strategy;

use HistoricalMeteorological\Data\Parser\Strategy\RandomWhitespacePaddingStrategy;
use HistoricalMeteorological\Data\Parser\Strategy\TextStrategyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RandomWhitespacePaddingStrategySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TextStrategyInterface::class);
    }

    function it_can_parse_words_padded_by_random_whitespace()
    {
        $text = '   2017   1    9.0     3.7       5    91.4    ---    ';

        $this->parseTextIntoArray($text)->shouldReturn([
                '2017',
                '1',
                '9.0',
                '3.7',
                '5',
                '91.4',
                '---'
        ]);
    }
}
