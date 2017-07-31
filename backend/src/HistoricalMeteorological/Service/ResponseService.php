<?php

namespace HistoricalMeteorological\Service;

use HistoricalMeteorological\Collection\LocationCollection;
use HistoricalMeteorological\Entity\Location;
use Symfony\Component\HttpFoundation\JsonResponse;
use HistoricalMeteorological\Collection\EntryCollection;

class ResponseService
{
    public function createEntryCollectionResponse(EntryCollection $collection)
    {
        return new JsonResponse($collection->toArray());
    }

    public function createLocationCollectionResponse(LocationCollection $collection)
    {
        return new JsonResponse($collection->toArray());
    }

    public function createLocationResponse(Location $location)
    {
        return new JsonResponse(LocationCollection::transformLocationToArray($location));
    }
}
