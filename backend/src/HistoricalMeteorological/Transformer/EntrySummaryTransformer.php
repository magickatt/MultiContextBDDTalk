<?php

namespace HistoricalMeteorological\Transformer;

use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Calculator\Summary\EntrySummaryComparison;

class EntrySummaryTransformer
{
    public static function transformEntrySummaryToArray(EntrySummary $summary)
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

    public static function transformEntrySummaryComparisonToArray(EntrySummaryComparison $summaryComparison)
    {
        return [
            'differences' => [
                'temperature_maximum' => round($summaryComparison->getDifferenceTemperatureMaximum(), 2),
                'temperature_minimum' => round($summaryComparison->getDifferenceTemperatureMinimum(), 2),
                'rain_volume' => round($summaryComparison->getDifferenceRainVolume(), 2),
                'sun_duration' => round($summaryComparison->getDifferenceSunDuration(), 2)
            ]
        ];
    }
}