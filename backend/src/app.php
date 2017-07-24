<?php

use HistoricalMeteorological\Application\ApplicationBuilder;

// Configure the Silex application
$builder = new ApplicationBuilder();
$application = $builder->buildApplication(new Silex\Application());

$application->get('/', function() use($application) {
    return 'Hello World';
});

return $application;