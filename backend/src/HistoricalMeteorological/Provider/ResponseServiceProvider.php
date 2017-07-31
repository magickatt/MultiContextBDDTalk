<?php

namespace HistoricalMeteorological\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use HistoricalMeteorological\Service\ResponseService;

class ResponseServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['response'] = new ResponseService();
    }
}
