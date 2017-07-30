<?php

namespace spec\HistoricalMeteorological\Service;

use Doctrine\ORM\EntityManagerInterface;
use HistoricalMeteorological\Service\EntryService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntryServiceSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EntryService::class);
    }
}
