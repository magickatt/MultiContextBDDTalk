<?php

namespace HistoricalMeteorological\Calculator\Summary;

use HistoricalMeteorological\Entity\Entry;

class EntrySummary
{
    const TEMPERATURE_MAXIMUM = 'temperature_maximum';
    const TEMPERATURE_MINIMUM = 'temperature_minimum';
    const RAIN_VOLUME = 'rain_volume';
    const SUN_DURATION = 'sun_duration';

    /** @var float */
    private $totalTemperatureMaximum = 0;

    /** @var float */
    private $totalTemperatureMinimum = 0;

    /** @var float */
    private $totalRainVolume = 0;

    /** @var float */
    private $totalSunDuration = 0;

    /** @var int */
    private $counts = [
        self::TEMPERATURE_MAXIMUM => 0,
        self::TEMPERATURE_MINIMUM => 0,
        self::RAIN_VOLUME => 0,
        self::SUN_DURATION => 0,
    ];

    /**
     * @param Entry $entry
     */
    public function addEntry(Entry $entry)
    {
        $this->addTemperatureMaximum($entry);
        $this->addTemperatureMinimum($entry);
        $this->addRainVolume($entry);
        $this->addSunDuration($entry);
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
        if ($this->counts[self::TEMPERATURE_MAXIMUM] === 0) {
            return null;
        }
        return $this->totalTemperatureMaximum / $this->counts[self::TEMPERATURE_MAXIMUM];
    }

    public function getAverageTemperatureMinimum()
    {
        if ($this->counts[self::TEMPERATURE_MINIMUM] === 0) {
            return null;
        }
        return $this->totalTemperatureMinimum / $this->counts[self::TEMPERATURE_MINIMUM];
    }

    public function getAverageRainVolume()
    {
        if ($this->counts[self::RAIN_VOLUME] === 0) {
            return null;
        }
        return $this->totalRainVolume / $this->counts[self::RAIN_VOLUME];
    }

    public function getAverageSunDuration()
    {
        if ($this->counts[self::SUN_DURATION] === 0) {
            return null;
        }
        return $this->totalSunDuration / $this->counts[self::SUN_DURATION];
    }

    private function addTemperatureMaximum(Entry $entry)
    {
        if ($entry->hasTemperatureMaximum()) {
            $this->totalTemperatureMaximum += $entry->getTemperatureMaximum();
            $this->counts[self::TEMPERATURE_MAXIMUM]++;
        }
    }

    private function addTemperatureMinimum(Entry $entry)
    {
        if ($entry->hasTemperatureMinimum()) {
            $this->totalTemperatureMinimum += $entry->getTemperatureMinimum();
            $this->counts[self::TEMPERATURE_MINIMUM]++;
        }
    }

    private function addRainVolume(Entry $entry)
    {
        if ($entry->hasRainVolume()) {
            $this->totalRainVolume += $entry->getRainVolume();
            $this->counts[self::RAIN_VOLUME]++;
        }
    }

    private function addSunDuration(Entry $entry)
    {
        if ($entry->hasSunDuration()) {
            $this->totalSunDuration += $entry->getSunDuration();
            $this->counts[self::SUN_DURATION]++;
        }
    }
}