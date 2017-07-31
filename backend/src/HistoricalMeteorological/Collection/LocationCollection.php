<?php

namespace HistoricalMeteorological\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use HistoricalMeteorological\Entity\Location;

class LocationCollection extends ArrayCollection
{
    public function toArray()
    {
        return array_map(array(self::class, 'transformLocationToArray'), parent::toArray());
    }

    public static function transformLocationToArray(Location $location)
    {
        return [
            'id' => $location->getId(),
            'name' => $location->getName(),
            'latitude' => $location->getLatitude(),
            'longitude' => $location->getLongitude(),
            'amsl' => $location->getDistanceAboveMeanSeaLevel()
        ];
    }
}