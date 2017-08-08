<?php

namespace HistoricalMeteorological\Service;

use HistoricalMeteorological\Calculator\EntryCollectionSummaryCalculator;
use HistoricalMeteorological\Calculator\Summary\EntrySummary;
use HistoricalMeteorological\Collection\Summary\EntryAggregateSummaryCollection;
use HistoricalMeteorological\Collection\Summary\EntryComparisonSummaryCollection;
use HistoricalMeteorological\Collection\YearCollection;
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
    const HEADERS = [
        'Access-Control-Allow-Origin' => '*'
    ];

    public function createEntryAggregateSummaryCollectionResponse(EntryAggregateSummaryCollection $summaryCollection)
    {
        $collection = $summaryCollection->getCollection();
        $summary = EntryCollectionSummaryCalculator::summariseEntryCollection($collection, new EntrySummary());

        return new JsonResponse([
            'data' => array_map(array(EntryTransformer::class, 'transformEntryToArray'), $collection->toArray()),
            'meta' => EntrySummaryTransformer::transformEntrySummaryToArray($summary),
            'links' => []
        ]);
    }

    public function createEntryComparisonSummaryCollectionResponse(EntryComparisonSummaryCollection $comparisonCollection)
    {
        $collection1 = $comparisonCollection->getFirstCollection();
        $collection2 = $comparisonCollection->getSecondCollection();
        $summaryComparison = EntryCollectionSummaryCalculator::compareEntryCollections($collection1, $collection2);

        return new JsonResponse([
            'data' => array_map(array(EntryTransformer::class, 'transformEntryToArray'), $collection1->merge($collection2)->toArray()),
            'meta' => EntrySummaryTransformer::transformEntrySummaryComparisonToArray($summaryComparison),
            'links' => []
        ]);
    }

    public function createLocationCollectionResponse(LocationCollection $collection)
    {
        return new JsonResponse([
            'data' => array_map(array(LocationTransformer::class, 'transformLocationToArray'), $collection->toArray())
        ]);
    }

    public function createYearsResponse(YearCollection $collection)
    {
        return new JsonResponse(['data' => $collection->toArray()]);
    }

    public function createLocationResponse(Location $location, int $responseCode = 200)
    {
        return $this->createSingularResponse(LocationTransformer::transformLocationToArray($location), $responseCode);
    }

    private function createSingularResponse(array $array, int $responseCode = 200)
    {
        return new JsonResponse(['data' => $array], $responseCode);
    }

    private function createPluralResponse(CollectionInterface $collection, int $responseCode = 200)
    {
        return new JsonResponse(
            [
                'data' => $collection->toArray(),
                'meta' => [],
                'links' => []
            ],
            $responseCode
        );
    }
}
