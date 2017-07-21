<?php

namespace spec\HistoricalMeteorological\Entity;

use HistoricalMeteorological\Entity\Entry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Entry::class);
    }
}
