<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Distance;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DistanceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Distance::class);
    }
}
