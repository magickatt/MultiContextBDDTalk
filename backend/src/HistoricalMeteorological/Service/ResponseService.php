<?php

namespace HistoricalMeteorological\Service;

use HistoricalMeteorological\Calculator\EntryCollectionSummaryCalculator;
use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Transformer\EntrySummaryTransformer;
use HistoricalMeteorological\Transformer\EntryTransformer;
use HistoricalMeteorological\Transformer\LocationTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use HistoricalMeteorological\Entity\Location;
use HistoricalMeteorological\Collection\CollectionInterface;
use HistoricalMeteorological\Collection\LocationCollection;
use HistoricalMeteorological\Collection\EntryCollection;

class ResponseService
{
    public function createEntryCollectionResponse(EntryCollection $collection)
    {
        $summary = EntryCollectionSummaryCalculator::summariseEntryCollection($collection, new EntrySummary());

        return new JsonResponse([
            'data' => array_map(array(EntryTransformer::class, 'transformEntryToArray'), $collection->toArray()),
            'meta' => EntrySummaryTransformer::transformEntryToArray($summary),
            'links' => []
        ]);
    }

    public function createLocationCollectionResponse(LocationCollection $collection)
    {
        return new JsonResponse([
            'data' => array_map(array(LocationTransformer::class, 'transformLocationToArray'), $collection->toArray())
        ]);
    }

    public function createLocationResponse(Location $location)
    {
        return $this->createSingularResponse(LocationTransformer::transformLocationToArray($location));
    }

    private function createSingularResponse(array $array)
    {
        return new JsonResponse(['data' => $array]);
    }

    private function createPluralResponse(CollectionInterface $collection)
    {
        return new JsonResponse([
            'data' => $collection->toArray(),
            'meta' => [],
            'links' => []
        ]);
    }
}
