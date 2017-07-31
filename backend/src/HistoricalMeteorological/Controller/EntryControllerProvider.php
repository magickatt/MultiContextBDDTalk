<?php

namespace HistoricalMeteorological\Controller;

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
        return $collection;
    }

    private function addListAllRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/', function (Application $application) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $entries = $entryService->getEntryList();
            return $responseService->createEntryCollectionResponse($entries);

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
            return $responseService->createEntryCollectionResponse($entries);

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
            return $responseService->createEntryCollectionResponse($entries);

        };

        $collection->get('/{locationId}/{yearFrom}', $locationAndYearRangeRoute);
        $collection->get('/{locationId}/{yearFrom}/{yearTo}', $locationAndYearRangeRoute);
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
