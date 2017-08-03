<?php

namespace spec\HistoricalMeteorological\Calculator\Summary;

use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Entity\Entry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use PHPUnit\Framework\Assert;

class EntrySummarySpec extends ObjectBehavior
{
    function it_can_add_a_single_entry_and_return_identical_totals(Entry $entry)
    {
        $entry->getTemperatureMaximum()->willReturn(1.1);
        $entry->getTemperatureMinimum()->willReturn(2.2);
        $entry->getRainVolume()->willReturn(3.3);
        $entry->getSunDuration()->willReturn(4.4);

        $this->addEntry($entry);

        $this->getTotalRainVolume()->shouldReturn(3.3);
        $this->getTotalSunDuration()->shouldReturn(4.4);
        $this->getAverageTemperatureMaximum()->shouldReturn(1.1);
        $this->getAverageTemperatureMinimum()->shouldReturn(2.2);
        $this->getAverageRainVolume()->shouldReturn(3.3);
        $this->getAverageSunDuration()->shouldReturn(4.4);
    }

    function it_can_calculate_the_average_of_multiple_entries(
        Entry $entry1,
        Entry $entry2,
        Entry $entry3
    ) {
        $entry1->getTemperatureMaximum()->willReturn(1.1);
        $entry1->getTemperatureMinimum()->willReturn(2.2);
        $entry1->getRainVolume()->willReturn(3.3);
        $entry1->getSunDuration()->willReturn(4.4);

        $entry2->getTemperatureMaximum()->willReturn(4.4);
        $entry2->getTemperatureMinimum()->willReturn(3.3);
        $entry2->getRainVolume()->willReturn(2.2);
        $entry2->getSunDuration()->willReturn(1.1);

        $entry3->getTemperatureMaximum()->willReturn(1.2);
        $entry3->getTemperatureMinimum()->willReturn(2.3);
        $entry3->getRainVolume()->willReturn(3.4);
        $entry3->getSunDuration()->willReturn(4.1);

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
}
