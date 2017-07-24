<?php

// Register the autoloader (which in turns loads everything else)
require_once __DIR__.'/../vendor/autoload.php';

// Create a Silex framework application
$application = require __DIR__.'/../src/app.php';

// Run the application (handle the request, return a response, etc.)
$application->run();