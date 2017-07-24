<?php

namespace spec\HistoricalMeteorological\Application;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Argument\ArgumentsWildcard;
use Silex\Application;

class ApplicationBuilderSpec extends ObjectBehavior
{
    function it_should_return_the_same_application(Application $application)
    {
        $application->register(Argument::any())->willReturn($application);
        $application->register(Argument::any(), Argument::type('array'))->willReturn($application);

        $this->buildApplication($application)->shouldReturn($application);
    }
}
