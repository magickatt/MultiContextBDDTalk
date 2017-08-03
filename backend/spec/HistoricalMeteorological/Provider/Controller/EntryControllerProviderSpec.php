<?php

namespace spec\HistoricalMeteorological\Provider\Controller;

use HistoricalMeteorological\Provider\Controller\AbstractControllerProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Silex\Application;
use Silex\ControllerCollection;

class EntryControllerProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AbstractControllerProvider::class);
    }

    function it_should_register_various_routes(Application $application, ControllerCollection $collection)
    {
        $application->offsetGet('controllers_factory')->willReturn($collection);
        $application->offsetGet('entries')->willReturn($collection);
        $application->offsetGet('locations')->willReturn($collection);
        $application->offsetGet('response')->willReturn($collection);

        $collection->get('/', Argument::any())->shouldBeCalled();
        $collection->get('/{locationId}', Argument::any())->shouldBeCalled();
        $collection->get('/{locationId}/{yearFrom}', Argument::any())->shouldBeCalled();
        $collection->get('/{locationId}/{yearFrom}/{yearTo}', Argument::any())->shouldBeCalled();

        $this->connect($application);
    }
}
