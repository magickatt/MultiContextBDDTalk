<?php

namespace HistoricalMeteorological\Collection;

class YearCollection implements CollectionInterface
{
    private $elements = [];

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function toArray()
    {
        return $this->elements;
    }

}