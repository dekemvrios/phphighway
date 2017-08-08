<?php

require '../vendor/autoload.php';

use HighWay\Wrappers\SlimApp\SlimHighWay;
use Solis\Breaker\TException;

try {

    include_once 'src/Includes/config.php';

    $routes = include_once 'src/auxRotas.php';

    $app = SlimHighWay::make($routes);

    $app->run();

} catch (TException $exception) {
    echo $exception->toJson();
}