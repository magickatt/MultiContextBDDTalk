<?php

namespace spec\HistoricalMeteorological\Provider\Controller;

use HistoricalMeteorological\Provider\Controller\DefaultControllerProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultControllerProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DefaultControllerProvider::class);
    }
}
