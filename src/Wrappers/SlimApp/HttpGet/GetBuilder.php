<?php

namespace HighWay\Wrappers\SlimApp\HttpGet;

use HighWay\Wrappers\SlimApp\Helpers\SchemaRequest;
use HighWay\Wrappers\SlimApp\Helpers\SchemaResponse;
use HighWay\Wrappers\SlimApp\SlimMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use Slim\App;

/**
 * Class GetBuilder
 *
 * @package HighWay\Wrappers\SlimApp\HttpGet
 */
class GetBuilder
{

    /**
     * Gera a closure a ser executada quando o método http for GET.
     *
     * Gera dinamicamente a closure a ser executada a partir das especificações
     * existentes no schema para determinada rota.
     *
     * @param App                 $App        Referencia para instancia do \Slim\App
     * @param SchemaEntryContract $route      Entrada representando configuração de rota
     * @param SlimMiddleware|null $middleware Definições de Middleware disponíveis
     */
    public function get(
        &$App,
        $route,
        $middleware
    ) {

        // Geração da closure utilizada como callback para o slim método get()
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

        empty($method) ? $App->get(
            $route->getRequestEntry()->getUri(),
            $closure
        ) : $App->get(
            $route->getRequestEntry()->getUri(),
            $closure
        )->add($method);
    }
}