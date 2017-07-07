<?php

require '../vendor/autoload.php';

use HighWay\Classes\SlimApp\SlimHighWay;
use HighWay\Classes\SlimApp\SlimMiddleware;
use Solis\Breaker\TException;

try {

    include_once 'src/Includes/config.php';

    $app = SlimHighWay::make();

    include_once 'src/Includes/dependencies.php';

    $middleware = require_once 'src/Includes/middleware.php';

    $app->getWrapper()->setMiddleware(SlimMiddleware::make($middleware));

    $app->getWrapper()->compileRouteFromString(file_get_contents('src/Routes/sample.json'));

    $app->run();

} catch (TException $exception) {
    echo $exception->toJson();
}