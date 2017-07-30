<?php

namespace HistoricalMeteorological\Service;

use Doctrine\Common\Persistence\ObjectManager;

class LocationService
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}
