<?php

namespace HighWay\Wrappers\SlimApp\HttpDelete;

use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use HighWay\Wrappers\SlimApp\Helpers\SchemaResponse;
use HighWay\Wrappers\SlimApp\Helpers\SchemaRequest;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use HighWay\Wrappers\SlimApp\SlimMiddleware;
use Slim\App;

/**
 * Class DeleteBuilder
 *
 * @package HighWay\Wrappers\SlimApp\HttpPost
 */
class DeleteBuilder
{

    /**
     * @param App $App
     * @param SchemaEntryContract $route
     * @param SlimMiddleware|null $middleware
     */
    public function delete(
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

        empty($method) ? $App->delete(
            $route->getRequestEntry()->getUri(),
            $closure
        ) : $App->delete(
            $route->getRequestEntry()->getUri(),
            $closure
        )->add($method);
    }
}
