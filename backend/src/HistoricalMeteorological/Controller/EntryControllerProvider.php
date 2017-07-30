<?php

namespace HistoricalMeteorological\Controller;

use HistoricalMeteorological\Service\LocationService;
use Silex\Application;
use Silex\ControllerCollection;
use HistoricalMeteorological\Service\EntryService;
use HistoricalMeteorological\Service\ResponseService;

class EntryControllerProvider extends AbstractControllerProvider
{
    protected function registerControllerRoutes(Application $application, ControllerCollection $collection):ControllerCollection
    {
        $this->addListAllRoute($application, $collection);
        $this->addListByLocationRoute($application, $collection);
        //$this->addListByLocationAndYearRoute($application, $collection);
        return $collection;
    }

    private function addListAllRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/', function (Application $application) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $entries = $entryService->getEntryList();
            return $responseService->createPluralResponse($entries);

        });
    }

    private function addListByLocationRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/{locationSlug}', function (Application $application, $locationSlug) {

            $entryService = $this->getEntryServiceFromContainer($application);
            $locationService = $this->getLocationServiceFromContainer($application);
            $responseService = $this->getResponseServiceFromContainer($application);

            $location = $locationService->getLocationByName($locationSlug);
            $entries = $entryService->getEntryListByLocation($location);
            return $responseService->createPluralResponse($entries);

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
