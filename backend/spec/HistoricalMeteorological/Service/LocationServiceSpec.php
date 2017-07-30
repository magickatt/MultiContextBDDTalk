<?php

namespace spec\HistoricalMeteorological\Service;

use Doctrine\ORM\EntityManagerInterface;
use HistoricalMeteorological\Service\LocationService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationServiceSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LocationService::class);
    }
}
