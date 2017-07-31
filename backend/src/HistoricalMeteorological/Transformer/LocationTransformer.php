<?php

namespace HistoricalMeteorological\Transformer;

use HistoricalMeteorological\Entity\Location;

class LocationTransformer
{
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