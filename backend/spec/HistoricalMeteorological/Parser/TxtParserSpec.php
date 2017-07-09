<?php

namespace spec\HistoricalMeteorological\Parser;

use HistoricalMeteorological\Parser\ParserInterface;
use HistoricalMeteorological\Parser\TxtParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TxtParserSpec extends ObjectBehavior
{
    function it_should_implement_the_parser_interface()
    {
        $this->shouldHaveType(ParserInterface::class);
    }
}
