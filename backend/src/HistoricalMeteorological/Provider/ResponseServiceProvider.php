<?php

namespace HistoricalMeteorological\Provider;

use HistoricalMeteorological\Service\ResponseService;
use JMS\Serializer\Serializer;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use HistoricalMeteorological\Service\EntryService;

class ResponseServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['response'] = new ResponseService(
            $this->getSerializerFromContainer($container)
        );
    }

    /**
     * @param Container $container
     * @return Serializer
     */
    private function getSerializerFromContainer(Container $container):Serializer
    {
        return $container['serializer'];
    }
}
