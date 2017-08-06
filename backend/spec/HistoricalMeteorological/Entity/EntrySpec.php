<?php

namespace spec\HistoricalMeteorological\Entity;

use HistoricalMeteorological\Entity\Entry;
use HistoricalMeteorological\Entity\Location;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EntrySpec extends ObjectBehavior
{
    function it_should_be_able_to_save_and_retrieve_information(Location $location)
    {
        throw new SkippingException('Annotation errors');

        $this->setLocation($location)->shouldReturn($this);
        $this->getLocation()->shouldReturn($location);

        $this->setYear(1993)->shouldReturn($this);
        $this->getYear()->shouldReturn(1993);

        $this->setMonth(11)->shouldReturn($this);
        $this->getMonth()->shouldReturn(11);

        $this->setTemperatureMaximum(1.1)->shouldReturn($this);
        $this->getTemperatureMaximum()->shouldReturn(1.1);

        $this->setTemperatureMinimum(2.2)->shouldReturn($this);
        $this->getTemperatureMinimum()->shouldReturn(2.2);

        $this->setRainVolume(3.3)->shouldReturn($this);
        $this->getRainVolume()->shouldReturn(3.3);

        $this->setSunDuration(4.4)->shouldReturn($this);
        $this->getSunDuration()->shouldReturn(4.4);
    }
}
