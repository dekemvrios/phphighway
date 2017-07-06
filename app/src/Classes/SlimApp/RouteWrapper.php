<?php

namespace HighWay\Classes\SlimApp;

use HighWay\Contracts\Schema\SchemaContract;
use HighWay\Contracts\Schema\SchemaEntryContract;
use HighWay\Contracts\RouteWrapperContract;
use Slim\App;

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
        $this->app = $slim;
        $this->middleware = $middleware;
    }

    /**
     * make
     *
     * @param SchemaContract $schema
     * @param SlimMiddleware $middleware
     *
     * @return static
     */
    public static function make($schema, $middleware = null)
    {
        $instance = new static(new App, $middleware);

        foreach ($schema->getSchemaEntry() as $route) {

            switch (strtoupper($route->getRequestEntry()->getMethod())) {
                case 'GET':
                    $instance->get($route);

                    break;
                case 'POST':
                    $instance->post($route);

                    break;
                case 'DELETE':
                    $instance->delete($route);

                    break;
                case 'PATCH':
                    $instance->patch($route);

                    break;
            }
        }

        return $instance;
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function post($route)
    {
        SlimWrapper::___POST($this->app, $route, $this->middleware);
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function delete($route)
    {
        SlimWrapper::___POST($this->app, $route, $this->middleware);
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function get($route)
    {
        SlimWrapper::___GET($this->app, $route, $this->middleware);
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function patch($route)
    {
        SlimWrapper::___POST($this->app, $route, $this->middleware);
    }
}