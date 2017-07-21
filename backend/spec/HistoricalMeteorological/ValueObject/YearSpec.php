<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Year;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YearSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Year::class);
    }
}
