<?php

namespace spec\HistoricalMeteorological\Calculator\Summary;

use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Entity\Entry;
use HistoricalMeteorological\Entity\Location;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use PHPUnit\Framework\Assert;
use spec\HistoricalMeteorological\Entity\LocationSpec;

class EntrySummarySpec extends ObjectBehavior
{
    /** @var Location */
    private $location;

    function it_can_add_a_single_entry_and_return_identical_totals()
    {
        $entry = $this->createEntry(
            1,
            1993,
            1,
            1.1,
            2.2,
            3.3,
            4.4
        );

        $this->addEntry($entry);

        $this->getTotalRainVolume()->shouldReturn(3.3);
        $this->getTotalSunDuration()->shouldReturn(4.4);
        $this->getAverageTemperatureMaximum()->shouldReturn(1.1);
        $this->getAverageTemperatureMinimum()->shouldReturn(2.2);
        $this->getAverageRainVolume()->shouldReturn(3.3);
        $this->getAverageSunDuration()->shouldReturn(4.4);
    }

    function it_can_calculate_the_average_of_multiple_entries()
    {
        $entry1 = $this->createEntry(
            1,
            1993,
            1,
            1.1,
            2.2,
            3.3,
            4.4
        );

        $entry2 = $this->createEntry(
            1,
            1993,
            2,
            4.4,
            3.3,
            2.2,
            1.1
        );

        $entry3 = $this->createEntry(
            1,
            1993,
            3,
            1.2,
            2.3,
            3.4,
            4.1
        );

        $this->addEntry($entry1);
        $this->addEntry($entry2);
        $this->addEntry($entry3);

        $this->getTotalRainVolume()->shouldReturn(8.9);
        $this->getTotalSunDuration()->shouldReturn(9.6);
        $this->getAverageTemperatureMaximum()->shouldReturn(6.7 / 3);
        $this->getAverageTemperatureMinimum()->shouldReturn(7.8 / 3);
        $this->getAverageRainVolume()->shouldReturn(8.9 / 3);
        $this->getAverageSunDuration()->shouldReturn(9.6 / 3);
    }

    /**
     * @param int $id
     * @param int $year
     * @param int $month
     * @param float $temperatureMaximum
     * @param float $temperatureMinimum
     * @param float $rainVolume
     * @param float $sunDuration
     * @return Entry
     */
    private function createEntry(
        int $id,
        int $year,
        int $month,
        float $temperatureMaximum,
        float $temperatureMinimum,
        float $rainVolume,
        float $sunDuration
    ) {
        if (!$this->location) {
            $this->location = LocationSpec::createLocation();
        }

        $entry = new Entry();
        return $entry->hydrate(
            $id,
            $this->location,
            $year,
            $month,
            $temperatureMaximum,
            $temperatureMinimum,
            $rainVolume,
            $sunDuration
        );
    }
}
