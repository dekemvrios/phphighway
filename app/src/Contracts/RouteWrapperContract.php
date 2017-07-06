<?php

namespace HighWay\Contracts;

use HighWay\Contracts\Schema\SchemaEntryContract;

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
    public function patch($route);

    /**
     * @param SchemaEntryContract $route
     */
    public function delete($route);
}