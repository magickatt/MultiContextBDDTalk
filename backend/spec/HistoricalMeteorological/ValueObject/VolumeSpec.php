<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Volume;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VolumeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Volume::class);
    }
}
