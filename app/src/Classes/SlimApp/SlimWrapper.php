<?php

namespace HighWay\Classes\SlimApp;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use HighWay\Contracts\Schema\SchemaEntryContract;
use Slim\App;

/**
 * Class SlimWrapper
 *
 * @package HighWay\Classes\SlimApp
 */
final class SlimWrapper
{

    /**
     * __GET
     *
     * @param App                 $App
     * @param SchemaEntryContract $route
     * @param SlimMiddleware      $middleware
     */
    public static function ___GET(&$App, $route, $middleware = null)
    {
        $closure = function (Request $oRequest, Response $oResponse) use ($route) {

            $class = $route->getRequestEntry()->getControllerEntry()->getClass();

            $method = $route->getRequestEntry()->getControllerEntry()->getMethod();

            $responseType = $route->getResponseEntry()->getType();

            return $oResponse->$responseType(
                (new $class)->$method($oRequest->getQueryParams())
            );
        };

        $method = false;
        if (!empty($middleware) && !empty($route->getMiddleware())) {
            $method = $middleware->getEntry($route->getMiddleware()[0]);
        }

        empty($method) ? $App->get(
            $route->getRequestEntry()->getUri(),
            $closure
        ) : $App->get(
            $route->getRequestEntry()->getUri(),
            $closure
        )->add($method);
    }

    /**
     * __POST
     *
     * @param App                 $App
     * @param SchemaEntryContract $route
     * @param SlimMiddleware      $middleware
     */
    public static function ___POST(&$App, $route, $middleware = null)
    {
        $closure = function (Request $oRequest, Response $oResponse) use ($route) {

            $class = $route->getRequestEntry()->getControllerEntry()->getClass();

            $method = $route->getRequestEntry()->getControllerEntry()->getMethod();

            $responseType = $route->getResponseEntry()->getType();

            return $oResponse->$responseType(
                (new $class)->$method($oRequest->getParsedBody())
            );
        };

        $method = false;
        if (!empty($middleware) && !empty($route->getMiddleware())) {
            $method = $middleware->getEntry($route->getMiddleware()[0]);
        }

        empty($method) ? $App->post(
            $route->getRequestEntry()->getUri(),
            $closure
        ) : $App->post(
            $route->getRequestEntry()->getUri(),
            $closure
        )->add($method);
    }
}