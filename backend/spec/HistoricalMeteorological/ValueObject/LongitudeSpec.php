<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Longitude;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LongitudeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Longitude::class);
    }
}
