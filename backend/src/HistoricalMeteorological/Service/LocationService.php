<?php

namespace HistoricalMeteorological\Service;

use Doctrine\ORM\EntityManagerInterface;

class LocationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getLocationList()
    {

    }
}
