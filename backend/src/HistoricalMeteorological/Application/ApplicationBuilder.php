<?php

namespace HistoricalMeteorological\Application;

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Knp\Provider\ConsoleServiceProvider;
use JDesrosiers\Silex\Provider\CorsServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use HistoricalMeteorological\Provider\Controller\DefaultControllerProvider;
use HistoricalMeteorological\Provider\Controller\EntryControllerProvider;
use HistoricalMeteorological\Provider\Controller\LocationControllerProvider;
use HistoricalMeteorological\Provider\EntryServiceProvider;
use HistoricalMeteorological\Provider\LocationServiceProvider;
use HistoricalMeteorological\Provider\ResponseServiceProvider;

class ApplicationBuilder
{
    /**
     * Configure the application as required
     * @param Application $application
     * @return Application
     */
    public function buildApplication(Application $application):Application
    {
        $application['debug'] = true;

        $this->registerControllerProviders($application);
        $this->registerConsoleProvider($application);
        $this->registerDatabaseProvider($application);
        $this->registerServiceProviders($application);

        return $application;
    }

    /**
     * Register each controller provider based on different URL route prefixes
     * @param Application $application
     * @return Application
     */
    private function registerControllerProviders(Application $application):Application
    {
        $application->mount('/', new DefaultControllerProvider());
        $application->mount('/locations', new LocationControllerProvider());
        $application->mount('/entries', new EntryControllerProvider());

        $this->registerCorsProvider($application);

        return $application;
    }

    private function registerCorsProvider(Application $application):Application
    {
        $application->register(new CorsServiceProvider(), ['cors.allowOrigin' => '*']);
        $application["cors-enabled"]($application);

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
        $application->register(new LocationServiceProvider());
        $application->register(new EntryServiceProvider());
        $application->register(new ResponseServiceProvider());

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
                    'path'     => __DIR__.'/../../../data/database/historicalmeteorological.db',
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
            'orm.auto_generate_proxies' => true,
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type' => 'annotation',
                        'namespace' => 'HistoricalMeteorological\Entity',
                        'path' => __DIR__.'/src/HistoricalMeteorological/Entity',
                    ]
                ],
                'default_cache' => [
                    'driver' => 'filesystem',
                    'path' => __DIR__.'/../../../data/cache',
                ]
            ],
        ));
    }
}
