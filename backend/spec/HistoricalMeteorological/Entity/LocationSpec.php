<?php

namespace spec\HistoricalMeteorological\Entity;

use HistoricalMeteorological\Entity\Location;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Location::class);
    }
}
