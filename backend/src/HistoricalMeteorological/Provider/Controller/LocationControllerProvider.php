<?php

namespace HistoricalMeteorological\Provider\Controller;

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
        return $collection;
    }

    private function addListRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/', function (Application $application) {

            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $locations = $locationService->getLocationList();
            return $responseService->createLocationCollectionResponse($locations);

        });
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
