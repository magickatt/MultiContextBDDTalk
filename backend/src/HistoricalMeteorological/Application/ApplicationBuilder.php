<?php

namespace HistoricalMeteorological\Application;

use HistoricalMeteorological\Controller\DefaultControllerProvider;
use HistoricalMeteorological\Controller\LocationControllerProvider;
use HistoricalMeteorological\Provider\EntryServiceProvider;
use HistoricalMeteorological\Provider\LocationServiceProvider;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

class ApplicationBuilder
{
    /**
     * Configure the application as required
     * @param Application $application
     * @return Application
     */
    public function buildApplication(Application $application):Application
    {
        $this->registerControllerProviders($application);
        $this->registerConsoleProvider($application);
        $this->registerDatabaseProvider($application);
        $this->registerServiceProviders($application);

        return $application;
    }

    private function registerControllerProviders(Application $application):Application
    {
        $application->mount('/', new DefaultControllerProvider());
        $application->mount('/locations', new LocationControllerProvider());
        //$application->mount('/entries', new DefaultControllerProvider());
        return $application;
    }

    /**
     * Register the Silex console provider
     * @param Application $application
     * @return Application
     */
    private function registerConsoleProvider(Application $application):Application
    {
        return $application->register(new ConsoleServiceProvider());
    }

    private function registerServiceProviders(Application $application):Application
    {
        $application['locations'] = $application->register(new LocationServiceProvider());
        $application['entries'] = $application->register(new EntryServiceProvider());

        return $application;
    }

    /**
     * Register the Doctrine DBAL provider
     * @param Application $application
     * @return Application
     */
    private function registerDatabaseProvider(Application $application):Application
    {
        return $this->registerDatabaseObjectRelationalMapperProvider(
            $application->register(new DoctrineServiceProvider(), [
                'db.options' => [
                    'driver'   => 'pdo_sqlite',
                    'path'     => __DIR__.'/../../../../database/historicalmeteorological.db',
                ],
            ])
        );
    }

    /**
     * Register the Doctrine ORM provider
     * @param Application $application
     * @return Application
     */
    private function registerDatabaseObjectRelationalMapperProvider(Application $application):Application
    {
        return $application->register(new DoctrineOrmServiceProvider(), array(
            'orm.proxies_dir' => __DIR__.'/../../../data/proxies',
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type' => 'annotation',
                        'namespace' => 'HistoricalMeteorological\Entity',
                        'path' => __DIR__.'/src/HistoricalMeteorological/Entity',
                    ]
                ],
            ],
        ));
    }
}
