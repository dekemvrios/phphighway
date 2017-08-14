<?php

namespace HighWay\Wrappers\SlimApp\HttpPost;

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
class PostBuilder
{

    /**
     * @param App $App
     * @param SchemaEntryContract $route
     * @param SlimMiddleware|null $middleware
     */
    public function post(
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

        empty($method) ? $App->post(
            $route->getRequestEntry()->getUri(),
            $closure
        ) : $App->post(
            $route->getRequestEntry()->getUri(),
            $closure
        )->add($method);
    }
}
