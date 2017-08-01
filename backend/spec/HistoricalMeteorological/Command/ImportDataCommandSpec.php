<?php

namespace spec\HistoricalMeteorological\Command;

use DirectoryIterator;
use Knp\Command\Command;
use PhpSpec\ObjectBehavior;
use HistoricalMeteorological\Data\Converter;

class ImportDataCommandSpec extends ObjectBehavior
{
    function let(Converter $converter, DirectoryIterator $directoryIterator)
    {
        $this->beConstructedWith($converter, $directoryIterator);
    }

    function it_has_the_correct_inheritance()
    {
        $this->shouldHaveType(Command::class);
    }
}
