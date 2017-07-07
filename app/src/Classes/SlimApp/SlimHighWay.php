<?php

namespace HighWay\Classes\SlimApp;

use HighWay\Abstractions\HighWayAbstract;
use HighWay\Classes\RouteSchema\Schema;
use Solis\Breaker\TException;

/**
 * Class SlimHighWay
 *
 * @package HighWay\Classes\SlimApp
 */
class SlimHighWay extends HighWayAbstract
{
    /**
     * make
     *
     * @param array $routes
     * @param array $middleware
     *
     * @return static
     *
     * @throws TException
     */
    public static function make($routes = null, $middleware = [])
    {
        $schema = null;
        if (!empty($routes)) {
            $schema = Schema::make($routes);
            if (empty($schema)) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    'error creating route schema',
                    500
                );
            }
        }

        $instance = new static(
            RouteWrapper::make(
                $schema,
                SlimMiddleware::make($middleware)
            ),
            $schema
        );

        return $instance;
    }
}
