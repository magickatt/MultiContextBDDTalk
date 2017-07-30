<?php

namespace HistoricalMeteorological\Provider;

use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Service\LocationService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LocationServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     * @return LocationService
     */
    public function register(Container $container)
    {
        return new LocationService(
            $this->getDatabaseObjectRelationalMapperFromContainer($container)
        );
    }

    /**
     * @param Container $container
     * @return ObjectManager
     */
    private function getDatabaseObjectRelationalMapperFromContainer(Container $container):ObjectManager
    {
        return $container['orm.em'];
    }
}
