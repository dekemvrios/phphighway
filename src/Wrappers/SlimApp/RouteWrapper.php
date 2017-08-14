<?php

namespace HighWay\Wrappers\SlimApp;

use HighWay\Schema\Route\Contracts\SchemaContract;
use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use HighWay\Wrappers\SlimApp\HttpDelete\DeleteBuilder;
use HighWay\Wrappers\SlimApp\HttpGet\GetBuilder;
use HighWay\Wrappers\RouteWrapperContract;
use HighWay\Schema\Route\Schema;
use HighWay\Wrappers\SlimApp\HttpPatch\PatchBuilder;
use HighWay\Wrappers\SlimApp\HttpPost\PostBuilder;
use HighWay\Wrappers\SlimApp\HttpPut\PutBuilder;
use Solis\Breaker\TException;
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
     * @var GetBuilder
     */
    protected $httpGetBuilder;

    /**
     * @var PostBuilder
     */
    protected $httpPostBuilder;

    /**
     * @var DeleteBuilder
     */
    protected $httpDeleteBuilder;

    /**
     * @var PutBuilder
     */
    protected $httpPutBuilder;

    /**
     * @var PatchBuilder
     */
    protected $httpPatchBuilder;

    /**
     * RouteWrapper constructor.
     *
     * @param App            $slim
     * @param SlimMiddleware $middleware
     */
    protected function __construct(
        $slim,
        $middleware = null
    ) {
        $this->setApp($slim);
        if (!empty($middleware)) {
            $this->setMiddleware($middleware);
        }
        $this->httpGetBuilder = new GetBuilder();
        $this->httpPostBuilder = new PostBuilder();
        $this->httpDeleteBuilder = new DeleteBuilder();
        $this->httpPutBuilder = new PutBuilder();
        $this->httpPatchBuilder = new PatchBuilder();
    }

    /**
     * make
     *
     * @param SchemaContract $schema
     * @param SlimMiddleware $middleware
     *
     * @return static
     */
    public static function make(
        $schema = null,
        $middleware = null
    ) {

        $aConfig = $GLOBALS['aConfig'];

        $app = !is_null($aConfig) ? new App(['settings' => $aConfig]) : new App();

        $instance = new static(
            $app,
            $middleware
        );

        if (!empty($schema)) {
            $instance->compileRouteFromSchema($schema);
        }

        return $instance;
    }

    /**
     * run
     */
    public function run()
    {
        $this->app->run();
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

        $arraySchema = json_decode(
            $jsonSchema,
            true
        );
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
                case 'PUT':
                    $this->put($route);

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
    public function get($route)
    {
        $this->httpGetBuilder->get(
            $this->getApp(),
            $route,
            $this->getMiddleware()
        );
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function post($route)
    {
        $this->httpPostBuilder->post(
            $this->getApp(),
            $route,
            $this->getMiddleware()
        );
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function put($route)
    {
        $this->httpPutBuilder->put(
            $this->getApp(),
            $route,
            $this->getMiddleware()
        );
    }

    /**
     * @param SchemaEntryContract $route
     */
    public function delete($route)
    {
        switch ($route->getRequestEntry()->getType()) {
            case 'legacy' :
                $this->httpPostBuilder->post(
                    $this->getApp(),
                    $route,
                    $this->getMiddleware()
                );

                break;
            case 'rest':
                $this->httpDeleteBuilder->delete(
                    $this->getApp(),
                    $route,
                    $this->getMiddleware()
                );

                break;
        }
    }

    /**
     * @param SchemaEntryContract $route
     *
     * @deprecated método patch será removido na versão v1.0.0 em favor do método post
     */
    public function patch($route)
    {
        switch ($route->getRequestEntry()->getType()) {
            case 'legacy' :
                $this->httpPostBuilder->post(
                    $this->getApp(),
                    $route,
                    $this->getMiddleware()
                );

                break;
            case 'rest':
                $this->httpPatchBuilder->patch(
                    $this->getApp(),
                    $route,
                    $this->getMiddleware()
                );

                break;
        }
    }
}