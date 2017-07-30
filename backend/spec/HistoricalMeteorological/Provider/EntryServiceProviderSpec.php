<?php

namespace spec\HistoricalMeteorological\Provider;

use HistoricalMeteorological\Provider\EntryServiceProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntryServiceProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EntryServiceProvider::class);
    }
}
