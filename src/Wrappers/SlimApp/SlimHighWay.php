<?php

namespace HighWay\Wrappers\SlimApp;

use HighWay\HighWayAbstract;
use HighWay\Schema\Route\Schema;
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
            if (!is_array($routes)) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    'supplied route is not of expected type array',
                    400
                );
            }

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
                !empty($middleware) ? SlimMiddleware::make($middleware) : null
            ),
            $schema
        );

        return $instance;
    }
}
