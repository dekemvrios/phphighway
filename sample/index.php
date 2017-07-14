<?php

require '../vendor/autoload.php';

use HighWay\Wrappers\SlimApp\SlimHighWay;
use Solis\Breaker\TException;

try {

    include_once 'src/Includes/config.php';

    $routes = json_decode(
        file_get_contents('src/Routes/sample.json'),
        true
    );

    $app = SlimHighWay::make(
        $routes
    );

    $app->run();

} catch (TException $exception) {
    echo $exception->toJson();
}