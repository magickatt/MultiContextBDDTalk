<?php

namespace HistoricalMeteorological\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use HistoricalMeteorological\Service\LocationService;

class LocationServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['locations'] = new LocationService(
            $this->getDatabaseObjectRelationalMapperFromContainer($container)
        );
    }

    /**
     * @param Container $container
     * @return EntityManagerInterface
     */
    private function getDatabaseObjectRelationalMapperFromContainer(Container $container):EntityManagerInterface
    {
        return $container['orm.em'];
    }
}
