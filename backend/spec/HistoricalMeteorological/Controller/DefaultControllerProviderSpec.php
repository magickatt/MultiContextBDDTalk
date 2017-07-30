<?php

namespace spec\HistoricalMeteorological\Controller;

use HistoricalMeteorological\Controller\DefaultControllerProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultControllerProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DefaultControllerProvider::class);
    }
}
