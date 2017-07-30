<?php

namespace HistoricalMeteorological\Controller;

use HistoricalMeteorological\Service\LocationService;
use Silex\Application;
use Silex\ControllerCollection;

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
            $service = $this->getLocationService($application);
            return 'List';
        });
    }

    private function addViewRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/{name}', function (Application $application) {
            $service = $this->getLocationService($application);
            return 'View';
        });
    }

    /**
     * @param Application $application
     * @return LocationService
     */
    private function getLocationService(Application $application):LocationService
    {
        return $application['locations'];
    }
}