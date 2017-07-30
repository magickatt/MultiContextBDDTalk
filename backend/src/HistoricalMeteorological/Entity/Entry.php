<?php

namespace HistoricalMeteorological\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @Entity
 * @Table(name="entries")
 */
class Entry
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $identifier;

    /** @Column(type="string") */
    private $location;

    /** @Column(type="integer") */
    private $year;

    /** @Column(type="integer") */
    private $month;

    /** @Column(type="float", name="temperature_maximum") */
    private $temperatureMaximum;

    /** @Column(type="float", name="temperature_minimum") */
    private $temperatureMinimum;

    /** @Column(type="float", name="rain_volume") */
    private $rainVolume;

    /** @Column(type="float", name="sun_duration") */
    private $sunDuration;

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Entry
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Does this entry have a year specified?
     * @return bool
     */
    public function hasYear():bool
    {
        if (is_int($this->year)) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getYear():int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return Entry
     */
    public function setYear(int $year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return int
     */
    public function getMonth():int
    {
        return $this->month;
    }

    /**
     * @param int $month
     * @return Entry
     */
    public function setMonth(int $month)
    {
        $this->month = $month;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemperatureMaximum()
    {
        return $this->temperatureMaximum;
    }

    /**
     * @param float $temperatureMaximum
     * @return Entry
     */
    public function setTemperatureMaximum(float $temperatureMaximum)
    {
        $this->temperatureMaximum = $temperatureMaximum;
        return $this;
    }

    /**
     * @return float
     */
    public function getTemperatureMinimum():float
    {
        return $this->temperatureMinimum;
    }

    /**
     * @param float $temperatureMinimum
     * @return Entry
     */
    public function setTemperatureMinimum(float $temperatureMinimum)
    {
        $this->temperatureMinimum = $temperatureMinimum;
        return $this;
    }

    /**
     * @return float
     */
    public function getRainVolume():float
    {
        return $this->rainVolume;
    }

    /**
     * @param float $rainVolume
     * @return Entry
     */
    public function setRainVolume(float $rainVolume)
    {
        $this->rainVolume = $rainVolume;
        return $this;
    }

    /**
     * @return float
     */
    public function getSunDuration():float
    {
        return $this->sunDuration;
    }

    /**
     * @param float $sunDuration
     * @return Entry
     */
    public function setSunDuration(float $sunDuration)
    {
        $this->sunDuration = $sunDuration;
        return $this;
    }


}
