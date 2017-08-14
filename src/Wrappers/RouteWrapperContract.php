<?php

namespace HighWay\Wrappers;

use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use HighWay\Schema\Route\Contracts\SchemaContract;
use Solis\Breaker\TException;

/**
 * Interface RouteWrapperContract
 *
 * @package HighWay\Contracts
 */
interface RouteWrapperContract
{
    /**
     * run
     */
    public function run();

    /**
     * @param string $jsonSchema
     *
     * @throws TException
     */
    public function compileRouteFromString($jsonSchema);

    /**
     * @param SchemaContract $schema
     */
    public function compileRouteFromSchema($schema);

    /**
     * @param SchemaEntryContract $route
     */
    public function get($route);

    /**
     * @param SchemaEntryContract $route
     */
    public function post($route);

    /**
     * @param SchemaEntryContract $route
     */
    public function put($route);

    /**
     * @param SchemaEntryContract $route
     */
    public function patch($route);

    /**
     * @param SchemaEntryContract $route
     */
    public function delete($route);
}