<?php

namespace spec\HistoricalMeteorological\Provider;

use HistoricalMeteorological\Provider\LocationServiceProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationServiceProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationServiceProvider::class);
    }
}
