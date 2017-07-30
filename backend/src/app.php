<?php

use HistoricalMeteorological\Application\ApplicationBuilder;

// Configure the Silex application
$builder = new ApplicationBuilder();
$application = $builder->buildApplication(new Silex\Application());

return $application;