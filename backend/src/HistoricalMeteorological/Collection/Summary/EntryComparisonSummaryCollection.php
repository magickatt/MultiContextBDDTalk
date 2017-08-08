<?php

namespace HistoricalMeteorological\Collection\Summary;

use HistoricalMeteorological\Collection\EntryCollection;

class EntryComparisonSummaryCollection implements SummaryCollectionInterface
{
    private $collection1;

    private $collection2;

    public function __construct(EntryCollection $collection1, EntryCollection $collection2)
    {
        $this->collection1 = $collection1;
        $this->collection2 = $collection2;
    }

    public function getFirstCollection()
    {
        return $this->collection1;
    }

    public function getSecondCollection()
    {
        return $this->collection2;
    }
}