<?php

namespace HistoricalMeteorological\Calculator\Summary;

class EntrySummaryComparison
{
    private $summary1;

    private $summary2;

    public function __construct(EntrySummary $summary1, EntrySummary $summary2)
    {
        $this->summary1 = $summary1;
        $this->summary2 = $summary2;
    }

    public function getDifferenceTemperatureMaximum()
    {
        return $this->summary1->getAverageTemperatureMaximum() - $this->summary2->getAverageTemperatureMaximum();
    }

    public function getDifferenceTemperatureMinimum()
    {
        return $this->summary1->getAverageTemperatureMinimum() - $this->summary2->getAverageTemperatureMinimum();
    }

    public function getDifferenceRainVolume()
    {
        return $this->summary1->getAverageRainVolume() - $this->summary2->getAverageRainVolume();
    }

    public function getDifferenceSunDuration()
    {
        return $this->summary1->getAverageSunDuration() - $this->summary2->getAverageSunDuration();
    }
}