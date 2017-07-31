<?php

namespace spec\HistoricalMeteorological\Service;

use HistoricalMeteorological\Service\ResponseService;
use JMS\Serializer\Serializer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ResponseService::class);
    }
}
