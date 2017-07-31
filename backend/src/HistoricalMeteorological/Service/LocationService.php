<?php

namespace HistoricalMeteorological\Service;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use OutOfBoundsException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use HistoricalMeteorological\Collection\LocationCollection;
use HistoricalMeteorological\Entity\Location;

class LocationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return Location
     */
    public function getLocationById($id):Location
    {
        $repository = $this->getRepository($this->entityManager);
        /** @var $location Location */
        $location = $repository->find($id);
        if (!$location instanceof Location) {
            throw new OutOfBoundsException(sprintf('Location %s could not be found', $id));
        }
        return $location;
    }

    public function getLocationList()
    {
        $repository = $this->getRepository($this->entityManager);
        return new LocationCollection($repository->findAll());
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return QueryBuilder
     */
    private function createQueryBuilder(EntityManagerInterface $entityManager)
    {
        return $entityManager->createQueryBuilder()
                             ->select('l')
                             ->from('HistoricalMeteorological\Entity\Location', 'l');
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return ObjectRepository
     */
    private function getRepository(EntityManagerInterface $entityManager):ObjectRepository
    {
        return $entityManager->getRepository(Location::class);
    }
}
