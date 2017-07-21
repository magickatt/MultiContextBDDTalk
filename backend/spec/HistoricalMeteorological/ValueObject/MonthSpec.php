<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Month;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MonthSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Month::class);
    }
}
