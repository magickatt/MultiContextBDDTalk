<?php

namespace spec\HistoricalMeteorological\Data;

use HistoricalMeteorological\Data\Converter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConverterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Converter::class);
    }
}
