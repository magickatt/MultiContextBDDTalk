<?php

namespace spec\HistoricalMeteorological\ValueObject;

use HistoricalMeteorological\ValueObject\Duration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Duration::class);
    }
}
