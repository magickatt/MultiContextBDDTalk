<?php

namespace HistoricalMeteorological\Collection;

interface CollectionInterface
{
    public function __construct(array $elements = []);

    public function toArray();

    public function merge(CollectionInterface $collection);
}