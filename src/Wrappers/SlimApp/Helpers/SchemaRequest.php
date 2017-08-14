<?php

namespace HighWay\Wrappers\SlimApp\Helpers;

use Psr\Http\Message\ServerRequestInterface as Request;
use HighWay\Schema\Route\Contracts\RequestEntryContract;
use HighWay\Schema\Route\Contracts\SchemaEntryContract;

/**
 * Class SchemaRequest
 *
 * @package HighWay\Wrappers\SlimApp\Helpers
 */
class SchemaRequest
{
    /**
     * @param RequestEntryContract $requestEntry
     *
     * @return mixed
     */
    public static function instantiateRequestHandler($requestEntry)
    {
        $class = $requestEntry->getControllerEntry()->getClass();

        $constructor = $requestEntry->getControllerEntry()->getConstructor();

        if($constructor == 'default'){
            return new $class();
        }

        return call_user_func_array([$class, $constructor], []);
    }

    /**
     * @param Request $request
     *
     * @return array|boolean
     */
    public static function getQueryParams($request)
    {
        $queryParams = $request->getQueryParams();
        if (empty($queryParams)) {
            return false;
        }
        return !empty($queryParams) ? $queryParams : false;
    }

    /**
     * @param Request             $request
     * @param SchemaEntryContract $route
     *
     * @return array|boolean
     */
    public static function getRequestArguments(
        $request,
        $route
    ) {
        if (empty($route->getRequestEntry()->getArguments())) {
            return false;
        }

        $requestAttributes = $request->getAttributes();

        $requestArguments = [];
        foreach ($route->getRequestEntry()->getArguments() as $argument) {
            $requestArguments[$argument->getName()] = $requestAttributes[$argument->getName()];
        }
        return !empty($requestArguments) ? $requestArguments : false;
    }

    /**
     * @param Request             $request
     * @param SchemaEntryContract $route
     *
     * @return array|boolean
     */
    public static function getRequestHeaders(
        $request,
        $route
    ) {
        if (empty($route->getRequestEntry()->getHeaders())) {
            return false;
        }

        $headers = [];
        foreach ($route->getRequestEntry()->getHeaders() as $header) {
            $value = $request->getHeaderLine($header->getName());
            if (!is_null($value)) {
                $headers[$header->getName()] = $value;
            }
        }
        return !empty($headers) ? $headers : false;
    }

    /**
     * Processa a requisição a partir das definições do schema da respectiva rota
     *
     * @param Request             $request
     * @param SchemaEntryContract $route
     *
     * @return array
     */
    public static function processRequest(
        $request,
        $route
    ) {
        // Instancia o objeto responsável por tratar a requisição dentro da aplicação
        $requestHandler = SchemaRequest::instantiateRequestHandler($route->getRequestEntry());

        // Captura o métood a ser executado pelo objeto dentro da aplicação
        $action = $route->getRequestEntry()->getControllerEntry()->getMethod();

        // captura os query params de modo a serem utilizados como argumento para o método do controlador
        $queryParams = SchemaRequest::getQueryParams($request);

        // captura os argumentos de request de modo a serem utilizados como argumento para o método do controlador
        $requestArguments = SchemaRequest::getRequestArguments(
            $request,
            $route
        );

        // captura os headers de request de modo a serem utilizados como argumento para o método do controlador
        $requestHeaders = SchemaRequest::getRequestHeaders(
            $request,
            $route
        );

        $parsedBody = $request->getParsedBody();

        $arguments = [
            'queryParams'      => !empty($queryParams) ? $queryParams : [],
            'requestArguments' => !empty($requestArguments) ? $requestArguments : [],
            'parsedBody'       => !empty($parsedBody) ? $parsedBody : [],
            'requestHeaders'   => !empty($requestHeaders) ? $requestHeaders : [],
        ];

        /**
         * |--------------------------------------------------------------------
         * | Implementação para compatibilidade com versão v0.1.x (legacy)
         * |--------------------------------------------------------------------
         * |
         * | Caso a determinada rota utilizar request com tipo legacy, considera
         * | como argumento somente os valores especificos para get ou post
         * |
         */
        if ($route->getRequestEntry()->getType() == 'legacy') {
            switch ($route->getRequestEntry()->getMethod()) {
                case 'GET':
                    $arguments = $arguments['queryParams'];
                    break;
                case 'POST':
                    $arguments = $arguments['parsedBody'];
                    break;
            }
        }

        // processa a requisição de acordo com o controlador especificado no schema
        return $requestHandler->{$action}(
            $arguments
        );
    }
}