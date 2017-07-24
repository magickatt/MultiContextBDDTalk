<?php

namespace spec\HistoricalMeteorological\Command;

use HistoricalMeteorological\Command\ImportDataCommand;
use HistoricalMeteorological\Data\Converter;
use Knp\Command\Command;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImportDataCommandSpec extends ObjectBehavior
{
    function let(Converter $converter)
    {
        $this->beConstructedWith($converter);
    }

    function it_has_the_correct_inheritance()
    {
        $this->shouldHaveType(Command::class);
    }
}
