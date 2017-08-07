<?php

namespace spec\HistoricalMeteorological\Application;

use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Argument\ArgumentsWildcard;
use Silex\Application;

class ApplicationBuilderSpec extends ObjectBehavior
{
    function it_should_return_the_same_application(Application $application)
    {
        throw new SkippingException('Need to look at how the CORS service provider works');

        $application->register(Argument::any())->willReturn($application);
        $application->register(Argument::any(), Argument::type('array'))->willReturn($application);
        $application->mount(Argument::type('string'), Argument::any())->willReturn($application);

        // Array access to the Dependency Injection container will invoke offsetSet as it implements the ArrayAccess interface
        $application->offsetSet(Argument::type('string'), Argument::any())->shouldBeCalled();
        $application->offsetGet(Argument::type('string'))->shouldBeCalled();

        $this->buildApplication($application)->shouldReturn($application);
    }
}
