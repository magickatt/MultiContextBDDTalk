<?php

namespace spec\HistoricalMeteorological\Service;

use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Service\LocationService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationServiceSpec extends ObjectBehavior
{
    function let(ObjectManager $objectManager)
    {
        $this->beConstructedWith($objectManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LocationService::class);
    }
}
