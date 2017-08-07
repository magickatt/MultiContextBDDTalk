<?php

namespace HistoricalMeteorological\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class LocationCollection extends ArrayCollection implements CollectionInterface
{
    public function merge(CollectionInterface $collection)
    {
        foreach ($collection as $location) {
            $this->add($location);
        }
        return $this;
    }
}