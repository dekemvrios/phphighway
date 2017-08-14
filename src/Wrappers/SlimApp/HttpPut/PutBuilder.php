<?php

namespace HighWay\Wrappers\SlimApp\HttpPut;

use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use HighWay\Wrappers\SlimApp\Helpers\SchemaResponse;
use HighWay\Wrappers\SlimApp\Helpers\SchemaRequest;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use HighWay\Wrappers\SlimApp\SlimMiddleware;
use Slim\App;

/**
 * Class PostBuilder
 *
 * @package HighWay\Wrappers\SlimApp\HttpPost
 */
class PutBuilder
{

    /**
     * @param App $App
     * @param SchemaEntryContract $route
     * @param SlimMiddleware|null $middleware
     */
    public function put(
        &$App,
        $route,
        $middleware = null
    ) {
        $closure = function (Request $oRequest, Response $oResponse) use ($route) {
            return SchemaResponse::processResponse(
                $oResponse,
                $route,
                SchemaRequest::processRequest($oRequest, $route)
            );
        };

        $method = false;
        if (!empty($middleware) && !empty($route->getMiddleware())) {
            $method = $middleware->getEntry($route->getMiddleware()[0]);
        }

        empty($method) ? $App->put(
            $route->getRequestEntry()->getUri(),
            $closure
        ) : $App->put(
            $route->getRequestEntry()->getUri(),
            $closure
        )->add($method);
    }
}
