<?php

namespace HighWay\Classes\SlimApp;

use HighWay\Classes\RouteSchema\Schema;
use HighWay\Contracts\Schema\SchemaContract;
use HighWay\Contracts\Schema\SchemaEntryContract;
use HighWay\Contracts\RouteWrapperContract;
use Slim\App;
use Solis\Breaker\TException;

/**
 * Class RouteWrapper
 *
 * @package HighWay\Classes\SlimApp
 */
class RouteWrapper implements RouteWrapperContract
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var SlimMiddleware
     */
    protected $middleware;

    /**
     * run
     */
    public function run()
    {
        $this->app->run();
    }

    /**
     * RouteWrapper constructor.
     *
     * @param App            $slim
     * @param SlimMiddleware $middleware
     */
    protected function __construct($slim, $middleware = null)
    {
        $this->setApp($slim);
        if (!empty($middleware)) {
            $this->setMiddleware($middleware);
        }
    }

    /**
     * make
     *
     * @param SchemaContract $schema
     * @param SlimMiddleware $middleware
     *
     * @return static
     */
    public static function make($schema = null, $middleware = null)
    {

        $aConfig = $GLOBALS['aConfig'];

        $app = !is_null($aConfig) ? new App(['settings' => $aConfig]) : new App();

        $instance = new static($app, $middleware);

        if (!empty($schema)) {
            $instance->compileRouteFromSchema($schema);
        }

        return $instance;
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param App $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @return SlimMiddleware
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * @param SlimMiddleware $middleware
     */
    public function setMiddleware($middleware)
    {
        $this->middleware = $middleware;
    }

    /**
     * @param string $jsonSchema
     *
     * @throws TException
     */
    public function compileRouteFromString($jsonSchema)
    {

        $arraySchema = json_decode($jsonSchema, true);
        if (empty($arraySchema)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'error decoding string json schema',
                500
            );
        }

        $schema = Schema::make($arraySchema);
        if (empty($schema)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'error creating route schema object',
                500
            );
        }

        $this->compileRouteFromSchema($schema);
    }

    /**
     * @param SchemaContract $schema
     */
    public function compileRouteFromSchema($schema)
    {
        foreach ($schema->getSchemaEntry() as $route) {

            switch (strtoupper($route->getRequestEntry()->getMethod())) {
                case 'GET':
                    $this->get($route);

                    break;
                case 'POST':
                    $this->post($route);

                    break;
                case 'DELETE':
                    $this->delete($route);

                    break;
                case 'PATCH':
                    $this->patch($route);

                    break;
            }
        }
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function post($route)
    {
        SlimWrapper::___POST($this->getApp(), $route, $this->getMiddleware());
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function delete($route)
    {
        SlimWrapper::___POST($this->getApp(), $route, $this->getMiddleware());
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function get($route)
    {
        SlimWrapper::___GET($this->getApp(), $route, $this->getMiddleware());
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function patch($route)
    {
        SlimWrapper::___POST($this->getApp(), $route, $this->getMiddleware());
    }
}