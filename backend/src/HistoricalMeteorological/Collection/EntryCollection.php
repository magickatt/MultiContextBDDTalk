<?php

namespace HistoricalMeteorological\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use HistoricalMeteorological\Entity\Entry;

class EntryCollection extends ArrayCollection
{
    public function toArray()
    {
        return array_map(array(self::class, 'transformEntryToArray'), parent::toArray());
    }

    public static function transformEntryToArray(Entry $entry)
    {
        return [
            'year' => $entry->getYear(),
            'month' => $entry->getMonth(),
            'location' => $entry->getLocation()->getId(),
            'temperature_maximum' => $entry->getTemperatureMaximum(),
            'temperature_minimum' => $entry->getTemperatureMinimum(),
            'rain_volume' => $entry->getRainVolume(),
            'sun_duration' => $entry->getSunDuration()
        ];
    }
}