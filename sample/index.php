<?php

require '../vendor/autoload.php';

use HighWay\Classes\SlimApp\SlimHighWay;
use Solis\Breaker\TException;

try {

    $routes = json_decode(
        file_get_contents('src/Routes/sample.json'),
        true
    );

    $middleware = require_once 'src/Includes/middleware.php';

    $app = SlimHighWay::make($routes, $middleware);

    include_once 'src/Includes/dependencies.php';

    $app->run();

} catch (TException $exception) {
    echo $exception->toJson();
}