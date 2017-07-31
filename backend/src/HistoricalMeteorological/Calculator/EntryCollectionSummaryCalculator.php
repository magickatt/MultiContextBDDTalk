<?php

namespace HistoricalMeteorological\Calculator;

use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Collection\EntryCollection;

class EntryCollectionSummaryCalculator
{
    public static function summariseEntryCollection(EntryCollection $collection, EntrySummary $summary):EntrySummary
    {
        foreach ($collection as $entry) {
            $summary->addEntry($entry);
        }
        return $summary;
    }
}