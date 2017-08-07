<?php

namespace HistoricalMeteorological\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class EntryCollection extends ArrayCollection implements CollectionInterface
{
    public function merge(CollectionInterface $collection)
    {
        foreach ($collection as $entry) {
            $this->add($entry);
        }
        return $this;
    }
}