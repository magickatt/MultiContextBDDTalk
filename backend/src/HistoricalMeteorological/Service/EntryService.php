<?php

namespace HistoricalMeteorological\Service;

use Doctrine\ORM\EntityManagerInterface;

class EntryService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntryList()
    {
        $dql = 'SELECT e FROM HistoricalMeteorological\Entity\Entry AS e';
        $query = $this->entityManager->createQuery($dql);
        $query->setMaxResults(10);

        return $query->getResult();
    }
}
