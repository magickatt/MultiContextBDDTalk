<?php

namespace HistoricalMeteorological\Calculator\Summary;

use HistoricalMeteorological\Entity\Entry;

class EntrySummary
{
    /** @var float */
    private $totalTemperatureMaximum = 0;

    /** @var float */
    private $totalTemperatureMinimum = 0;

    /** @var float */
    private $totalRainVolume = 0;

    /** @var float */
    private $totalSunDuration = 0;

    /** @var int */
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
        if ($this->count === 0) {
            return null;
        }
        return $this->totalTemperatureMaximum / $this->count;
    }

    public function getAverageTemperatureMinimum()
    {
        if ($this->count === 0) {
            return null;
        }
        return $this->totalTemperatureMinimum / $this->count;
    }

    public function getAverageRainVolume()
    {
        if ($this->count === 0) {
            return null;
        }
        return $this->totalRainVolume / $this->count;
    }

    public function getAverageSunDuration()
    {
        if ($this->count === 0) {
            return null;
        }
        return $this->totalSunDuration / $this->count;
    }
}