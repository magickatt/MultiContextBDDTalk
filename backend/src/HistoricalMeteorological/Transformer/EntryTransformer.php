<?php

namespace HistoricalMeteorological\Transformer;

use HistoricalMeteorological\Entity\Entry;

class EntryTransformer
{
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