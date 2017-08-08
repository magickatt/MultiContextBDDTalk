<?php

namespace HistoricalMeteorological\Calculator;

use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Calculator\Summary\EntrySummaryComparison;
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

    public static function compareEntryCollections(EntryCollection $collection1, EntryCollection $collection2):EntrySummaryComparison
    {
        $summary1 = self::summariseEntryCollection($collection1, new EntrySummary());
        $summary2 = self::summariseEntryCollection($collection2, new EntrySummary());

        return new EntrySummaryComparison($summary1, $summary2);
    }
}