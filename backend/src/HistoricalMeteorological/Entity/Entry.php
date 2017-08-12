<?php

namespace HistoricalMeteorological\Entity;

/**
 * @Entity
 * @Table(name="entries")
 */
class Entry
{
    /**
     * @Id
     * @Column(type="integer", name="id")
     * @GeneratedValue
     */
    private $id;

    /**
     * @OneToOne(targetEntity="HistoricalMeteorological\Entity\Location")
     * @JoinColumn(name="location", referencedColumnName="id")
     */
    private $location;

    /**
     * @Column(type="integer")
     * @var int
     */
    private $year;

    /**
     * @Column(type="integer")
     * @var int
     */
    private $month;

    /**
     * @Column(type="float", name="temperature_maximum")
     */
    private $temperatureMaximum;

    /**
     * @Column(type="float", name="temperature_minimum")
     */
    private $temperatureMinimum;

    /**
     * @Column(type="float", name="rain_volume")
     * @var float
     */
    private $rainVolume;

    /**
     * @Column(type="float", name="sun_duration")
     * @var float
     */
    private $sunDuration;

    /**
     * @param int $id
     * @param Location $location
     * @param int $year
     * @param int $month
     * @param float $temperatureMaximum
     * @param float $temperatureMinimum
     * @param float $rainVolume
     * @param float $sunDuration
     *
     * @return Entry
     */
    public function hydrate(
        int $id,
        Location $location,
        int $year,
        int $month,
        float $temperatureMaximum,
        float $temperatureMinimum,
        float $rainVolume,
        float $sunDuration
    ) {
        $this->id = $id;
        $this->location = $location;
        $this->year = $year;
        $this->month = $month;
        $this->temperatureMinimum = $temperatureMinimum;
        $this->temperatureMaximum = $temperatureMaximum;
        $this->rainVolume = $rainVolume;
        $this->sunDuration = $sunDuration;

        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Entry
     */
    public function setLocation(Location $location)
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
     * @return bool
     */
    public function hasTemperatureMaximum()
    {
        if (!empty($this->temperatureMaximum)) {
            return true;
        }
        return false;
    }

    /**
     * @return float
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
     * @return bool
     */
    public function hasTemperatureMinimum()
    {
        if (!empty($this->temperatureMaximum)) {
            return true;
        }
        return false;
    }

    /**
     * @return float
     */
    public function getTemperatureMinimum()
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
     * @return bool
     */
    public function hasRainVolume()
    {
        if (!empty($this->rainVolume)) {
            return true;
        }
        return false;
    }

    /**
     * @return float
     */
    public function getRainVolume()
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
     * @return bool
     */
    public function hasSunDuration()
    {
        if (!empty($this->sunDuration)) {
            return true;
        }
        return false;
    }

    /**
     * @return float
     */
    public function getSunDuration()
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
