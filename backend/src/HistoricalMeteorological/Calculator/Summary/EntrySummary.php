<?php

namespace HistoricalMeteorological\Calculator\Summary;

use HistoricalMeteorological\Entity\Entry;
use HistoricalMeteorological\Transformer\EntrySummaryTransformer;

class EntrySummary
{
    /** @var float */
    private $totalTemperatureMaximum;

    /** @var float */
    private $totalTemperatureMinimum;

    /** @var float */
    private $totalRainVolume;

    /** @var float */
    private $totalSunDuration;

    private $count = 0;

    /**
     * @param Entry $entry
     */
    public function addEntry(Entry $entry)
    {
        $this->totalTemperatureMaximum += $entry->getTemperatureMaximum();
        $this->totalTemperatureMinimum += $entry->getTemperatureMinimum();
        $this->totalRainVolume += $entry->getRainVolume();
        $this->totalSunDuration += $entry->getSunDuration();

        $this->count++;
    }

    public function getTotalRainVolume()
    {
        return $this->totalRainVolume;
    }

    public function getTotalSunDuration()
    {
        return $this->totalSunDuration;
    }

    public function getAverageTemperatureMaximum()
    {
        return $this->totalTemperatureMaximum / $this->count;
    }

    public function getAverageTemperatureMinimum()
    {
        return $this->totalTemperatureMinimum / $this->count;
    }

    public function getAverageRainVolume()
    {
        return $this->totalRainVolume / $this->count;
    }

    public function getAverageSunDuration()
    {
        return $this->totalSunDuration / $this->count;
    }
}