<?php

namespace HistoricalMeteorological\Provider\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\Api\ControllerProviderInterface;

abstract class AbstractControllerProvider implements ControllerProviderInterface
{
    /**
     * @param Application $application
     * @return ControllerCollection
     */
    public function connect(Application $application)
    {
        return $this->registerControllerRoutes($application, $this->getControllerCollection($application));
    }

    /**
     * @param Application $application
     * @return ControllerCollection
     */
    private function getControllerCollection(Application $application):ControllerCollection
    {
        return $application['controllers_factory'];
    }

    /**
     * @param Application $application
     * @param ControllerCollection $collection
     * @return ControllerCollection
     */
    abstract protected function registerControllerRoutes(Application $application, ControllerCollection $collection):ControllerCollection;
}
