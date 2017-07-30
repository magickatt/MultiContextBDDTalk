<?php

namespace spec\HistoricalMeteorological\Service;

use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Service\EntryService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntryServiceSpec extends ObjectBehavior
{
    function let(ObjectManager $objectManager)
    {
        $this->beConstructedWith($objectManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EntryService::class);
    }
}
