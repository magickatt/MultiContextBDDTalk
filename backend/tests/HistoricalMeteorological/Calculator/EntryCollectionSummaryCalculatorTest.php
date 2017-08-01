<?php

namespace HistoricalMeteorological\Calculator;

use PHPUnit\Framework\TestCase;
use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Collection\EntryCollection;
use HistoricalMeteorological\Entity\Entry;

class EntryCollectionSummaryCalculatorTest extends TestCase
{
    public function testWillAddEntriesToTheSummary()
    {
        $summary = $this->prophesize(EntrySummary::class);

        $entry1 = new Entry();
        $entry2 = new Entry();
        $entry3 = new Entry();

        $entries = [$entry1, $entry2, $entry3];

        $summary->addEntry($entry1)->shouldBeCalled();
        $summary->addEntry($entry2)->shouldBeCalled();
        $summary->addEntry($entry3)->shouldBeCalled();

        EntryCollectionSummaryCalculator::summariseEntryCollection(new EntryCollection($entries), $summary->reveal());
    }
}