<?php

namespace spec\HistoricalMeteorological\Command;

use HistoricalMeteorological\Command\ImportDataCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImportDataCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImportDataCommand::class);
    }
}
