<?php

namespace HistoricalMeteorological\Provider;

use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Service\EntryService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EntryServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     * @return EntryService
     */
    public function register(Container $container)
    {
        return new EntryService(
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
