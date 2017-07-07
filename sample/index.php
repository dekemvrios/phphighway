<?php

require '../vendor/autoload.php';

use HighWay\Classes\SlimApp\SlimHighWay;
use Solis\Breaker\TException;

try {

    include_once 'src/Includes/config.php';

    $middleware = require_once 'src/Includes/middleware.php';

    $app = SlimHighWay::make($routes = null, $middleware);

    include_once 'src/Includes/dependencies.php';

    $app->getWrapper()->compileRouteFromString(file_get_contents('src/Routes/sample.json'));

    $app->run();

} catch (TException $exception) {
    echo $exception->toJson();
}