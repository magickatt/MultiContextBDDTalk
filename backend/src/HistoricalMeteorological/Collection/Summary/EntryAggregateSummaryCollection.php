<?php

namespace HistoricalMeteorological\Collection\Summary;

use HistoricalMeteorological\Collection\EntryCollection;

class EntryAggregateSummaryCollection implements SummaryCollectionInterface
{
    private $collection;

    public function __construct(EntryCollection $collection)
    {
        $this->collection = $collection;
    }

    public function getCollection()
    {
        return $this->collection;
    }
}