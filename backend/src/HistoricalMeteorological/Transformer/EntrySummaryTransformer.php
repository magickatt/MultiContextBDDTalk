<?php

namespace HistoricalMeteorological\Transformer;

use HistoricalMeteorological\Calculator\Summary\EntrySummary;

class EntrySummaryTransformer
{
    public static function transformEntryToArray(EntrySummary $summary)
    {
        return [
            'totals' => [
                'rain_volume' => round($summary->getTotalRainVolume(), 2),
                'sun_duration' => round($summary->getTotalSunDuration(), 2)
            ],
            'averages' => [
                'temperature_maximum' => round($summary->getAverageTemperatureMaximum(), 2),
                'temperature_minimum' => round($summary->getAverageTemperatureMinimum(), 2),
                'rain_volume' => round($summary->getAverageRainVolume(), 2),
                'sun_duration' => round($summary->getAverageSunDuration(), 2)
            ]
        ];
    }
}