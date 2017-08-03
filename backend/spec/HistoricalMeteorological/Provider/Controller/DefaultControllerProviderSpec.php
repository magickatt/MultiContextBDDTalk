<?php

namespace spec\HistoricalMeteorological\Provider\Controller;

use HistoricalMeteorological\Provider\Controller\AbstractControllerProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Silex\Application;
use Silex\ControllerCollection;

class DefaultControllerProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AbstractControllerProvider::class);
    }

    function it_should_register_the_homepage_route(Application $application, ControllerCollection $collection)
    {
        $application->offsetGet('controllers_factory')->willReturn($collection);
        $collection->get('/', Argument::any())->shouldBeCalled();

        $this->connect($application);
    }
}
