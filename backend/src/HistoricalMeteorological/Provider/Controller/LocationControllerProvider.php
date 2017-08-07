<?php

namespace HistoricalMeteorological\Provider\Controller;

use HistoricalMeteorological\Service\EntryService;
use Silex\Application;
use Silex\ControllerCollection;
use HistoricalMeteorological\Service\LocationService;
use HistoricalMeteorological\Service\ResponseService;

class LocationControllerProvider extends AbstractControllerProvider
{
    protected function registerControllerRoutes(Application $application, ControllerCollection $collection):ControllerCollection
    {
        $this->addListRoute($application, $collection);
        $this->addViewRoute($application, $collection);
        $this->addListYearsAvailableRoute($application, $collection);
        return $collection;
    }

    private function addListRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('', function (Application $application) {

            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $locations = $locationService->getLocationList();
            return $responseService->createLocationCollectionResponse($locations);

        });
    }

    private function addListYearsAvailableRoute(Application $application, ControllerCollection $collection)
    {
        $yearsAvailableRoute = function (Application $application, $location1Id, $location2Id = null) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);
            $locationService = $this->getLocationServiceFromContainer($application);

            $location1 = $locationService->getLocationById($location1Id);
            $location2 = null;
            if ($location2Id) {
                $location2 = $locationService->getLocationById($location2Id);
            }
            $years = $entryService->getYearsAvailableByLocation($location1, $location2);
            return $responseService->createYearsResponse($years);

        };

        $collection->get('/{location1Id}/years-available', $yearsAvailableRoute);
        $collection->get('/{location1Id}/{location2Id}/years-both-available', $yearsAvailableRoute);
    }

    private function addViewRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/{id}', function (Application $application, $id) {

            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $location = $locationService->getLocationById($id);
            return $responseService->createLocationResponse($location);

        });
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
