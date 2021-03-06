<?php

namespace spec\HistoricalMeteorological\Entity;

use HistoricalMeteorological\Entity\Location;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationSpec extends ObjectBehavior
{
    function it_should_be_able_to_save_and_retrieve_information()
    {
        $this->setId('northampton')->shouldReturn($this);
        $this->getId()->shouldReturn('northampton');

        $this->setName('Northampton')->shouldReturn($this);
        $this->getName()->shouldReturn('Northampton');

        $this->setLatitude(52.2405)->shouldReturn($this);
        $this->getLatitude()->shouldReturn(52.2405);

        $this->setLongitude(-0.9027)->shouldReturn($this);
        $this->getLongitude()->shouldReturn(-0.9027);

        $this->setDistanceAboveMeanSeaLevel(130)->shouldReturn($this);
        $this->getDistanceAboveMeanSeaLevel()->shouldReturn(130);
    }

    /**
     * @return Location
     */
    public static function createLocation()
    {
        $location = new Location();
        return $location->hydrate(
            'northampton',
            'Northampton',
            52.2405,
            -0.9027,
            130
        );
    }
}
