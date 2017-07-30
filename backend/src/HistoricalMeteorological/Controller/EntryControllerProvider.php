<?php

namespace HistoricalMeteorological\Controller;

use HistoricalMeteorological\Service\EntryService;
use Silex\Application;
use Silex\ControllerCollection;

class EntryControllerProvider extends AbstractControllerProvider
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
            $service = $this->getEntryService($application);
            $entries = $service->getEntryList();
            return print_r($entries, true);
        });
    }

    private function addViewRoute(Application $application, ControllerCollection $collection)
    {
        $collection->get('/{name}', function (Application $application) {
            $service = $this->getEntryService($application);
            return 'View';
        });
    }

    /**
     * @param Application $application
     * @return EntryService
     */
    private function getEntryService(Application $application):EntryService
    {
        return $application['entries'];
    }
}
