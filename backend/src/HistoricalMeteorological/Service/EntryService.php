<?php

namespace HistoricalMeteorological\Service;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use HistoricalMeteorological\Collection\EntryCollection;
use HistoricalMeteorological\Collection\YearCollection;
use HistoricalMeteorological\Entity\Location;

class EntryService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntryList():EntryCollection
    {
        return $this->getEntries();
    }

    public function getEntryListByLocation(Location $location):EntryCollection
    {
        return $this->getEntries($location);
    }

    public function getEntryListByLocationAndYearRange(Location $location, int $yearFrom, int $yearTo = null):EntryCollection
    {
        return $this->getEntries($location, $yearFrom, $yearTo);
    }

    public function getEntryListByLocationPairAndYear(Location $location1, Location $location2, int $year)
    {
        $location1Collection = $this->getEntries($location1, $year);
        $location2Collection = $this->getEntries($location2, $year);

        return $location1Collection->merge($location2Collection);
    }

    private function getEntries(Location $location = null, int $yearFrom = null, int $yearTo = null):EntryCollection
    {
        $queryBuilder = $this->createQueryBuilder($this->entityManager);

        if ($location) {
            $queryBuilder->where('e.location = :location')
                         ->setParameter('location', $location);
        }
        if ($yearFrom) {
            if ($yearTo) {
                $queryBuilder->andWhere('e.year BETWEEN :yearFrom AND :yearTo');
                $queryBuilder->setParameter('yearTo', $yearTo);

            } else {
                $queryBuilder->andWhere('e.year = :yearFrom');
            }
            $queryBuilder->setParameter('yearFrom', $yearFrom);
        }

        return $this->createCollection($queryBuilder->getQuery());
    }

    public function getYearsAvailableByLocation(Location $location, Location $additionalLocation = null)
    {
        $sql = 'SELECT DISTINCT year FROM entries WHERE location = :location';
        if ($additionalLocation) {
            $sql .= ' INTERSECT SELECT DISTINCT year FROM entries WHERE location = :additionalLocation';
        }
        $statement = $this->entityManager->getConnection()->prepare($sql);
        $statement->bindValue('location', $location->getId());
        if ($additionalLocation) {
            $statement->bindValue('additionalLocation', $additionalLocation->getId());
        }
        $statement->execute();
        return new YearCollection($statement->fetchAll(\PDO::FETCH_COLUMN));
    }

    private function createCollection(Query $query):EntryCollection
    {
        $query->setMaxResults(120);

        return new EntryCollection($query->getResult());
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return QueryBuilder
     */
    private function createQueryBuilder(EntityManagerInterface $entityManager):QueryBuilder
    {
        return $entityManager->createQueryBuilder()
                             ->select('e')
                             ->from('HistoricalMeteorological\Entity\Entry', 'e');
    }
}
