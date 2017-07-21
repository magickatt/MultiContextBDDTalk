<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Temperature;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TemperatureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Temperature::class);
    }
}
