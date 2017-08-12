<?php

namespace spec\HistoricalMeteorological\Application;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Silex\Application;

class ApplicationBuilderSpec extends ObjectBehavior
{
    function it_should_return_the_same_application(Application $application)
    {
        // Ensure that various service providers are registered
        $application->register(Argument::any())->willReturn($application);
        $application->register(Argument::any(), Argument::type('array'))->willReturn($application);
        $application->mount(Argument::type('string'), Argument::any())->willReturn($application);

        // Array access to the Dependency Injection container will invoke offsetSet as it implements the ArrayAccess interface
        $application->offsetSet(Argument::type('string'), Argument::any())->shouldBeCalled();

        // Bizarre way to workaround unusual registration in CorsServiceProvider
        $application->protect(Argument::any())->willReturn(function() {});
        $application->offsetGet('cors-enabled')->willReturn(function () {});

        $this->buildApplication($application)->shouldReturn($application);
    }
}
