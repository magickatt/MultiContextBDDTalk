<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Latitude;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LatitudeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Latitude::class);
    }
}
