<?php

namespace HistoricalMeteorological\Provider\Controller;

use HistoricalMeteorological\Collection\Summary\EntryAggregateSummaryCollection;
use HistoricalMeteorological\Collection\Summary\EntryComparisonSummaryCollection;
use Silex\Application;
use Silex\ControllerCollection;
use HistoricalMeteorological\Service\EntryService;
use HistoricalMeteorological\Service\ResponseService;
use HistoricalMeteorological\Service\LocationService;

class EntryControllerProvider extends AbstractControllerProvider
{
    protected function registerControllerRoutes(Application $application, ControllerCollection $collection):ControllerCollection
    {
        $this->addListAllRoute($application, $collection);
        $this->addListByLocationRoute($application, $collection);
        $this->addListByLocationAndYearRangeRoute($application, $collection);
        $this->addListByLocationPairAndYearRoute($application, $collection);
        return $collection;
    }

    private function addListAllRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/', function (Application $application) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $entries = $entryService->getEntryList();
            return $responseService->createEntryAggregateSummaryCollectionResponse(new EntryAggregateSummaryCollection($entries));

        });
    }

    private function addListByLocationRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/{locationId}', function (Application $application, $locationId) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $location = $locationService->getLocationById($locationId);
            $entries = $entryService->getEntryListByLocation($location);
            return $responseService->createEntryAggregateSummaryCollectionResponse(new EntryAggregateSummaryCollection($entries));

        });
    }

    private function addListByLocationAndYearRangeRoute(Application $application, ControllerCollection $collection)
    {
        $locationAndYearRangeRoute = function (Application $application, $locationId, $yearFrom, $yearTo = null) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $location = $locationService->getLocationById($locationId);
            $entries = $entryService->getEntryListByLocationAndYearRange($location, (int)$yearFrom, (!is_null($yearTo) ? (int)$yearTo : (int)$yearFrom));
            return $responseService->createEntryAggregateSummaryCollectionResponse(new EntryAggregateSummaryCollection($entries));

        };

        $collection->get('/{locationId}/{yearFrom}', $locationAndYearRangeRoute);
        $collection->get('/{locationId}/{yearFrom}/{yearTo}', $locationAndYearRangeRoute);
    }

    private function addListByLocationPairAndYearRoute(Application $application, ControllerCollection $collection)
    {
        $locationPairAndYearRoute = function (Application $application, $location1Id, $location2Id, $year) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $location1 = $locationService->getLocationById($location1Id);
            $location2 = $locationService->getLocationById($location2Id);
            $comparisonCollection = new EntryComparisonSummaryCollection(
                $entryService->getEntryListByLocationAndYearRange($location1, (int)$year),
                $entryService->getEntryListByLocationAndYearRange($location2, (int)$year)
            );
            return $responseService->createEntryComparisonSummaryCollectionResponse($comparisonCollection);

        };

        $collection->get('/{location1Id}/{location2Id}/{year}/compare', $locationPairAndYearRoute);
    }

    /**
     * @param Application $application
     * @return EntryService
     */
    private function getEntryServiceFromContainer(Application $application):EntryService
    {
        return $application['entries'];
    }

    /**
     * @param Application $application
     * @return LocationService
     */
    private function getLocationServiceFromContainer(Application $application):LocationService
    {
        return $application['locations'];
    }

    /**
     * @param Application $application
     * @return ResponseService
     */
    private function getResponseServiceFromContainer(Application $application):ResponseService
    {
        return $application['response'];
    }
}
