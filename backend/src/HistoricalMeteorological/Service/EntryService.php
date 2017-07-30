<?php

namespace HistoricalMeteorological\Service;

use Doctrine\Common\Persistence\ObjectManager;

class EntryService
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}
