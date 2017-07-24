<?php

namespace HistoricalMeteorological\Application;

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
        return $this->registerDatabaseProvider(
            $this->registerConsoleProvider($application)
        );
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
