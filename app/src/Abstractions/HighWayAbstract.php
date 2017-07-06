<?php

namespace HighWay\Abstractions;

use HighWay\Contracts\RouteWrapperContract;
use HighWay\Contracts\Schema\SchemaContract;

/**
 * Class HighWayAbstract
 *
 * @package HighWay\Abstractions
 */
abstract class HighWayAbstract
{
    /**
     * @var RouteWrapperContract
     */
    protected $wrapper;

    /**
     * @var SchemaContract
     */
    protected $schema;

    /**
     * HighWayAbstract constructor.
     *
     * @param RouteWrapperContract $wrapper
     * @param SchemaContract       $schema
     */
    protected function __construct($wrapper, $schema)
    {
        $this->setWrapper($wrapper);
        $this->setSchema($schema);
    }

    /**
     * run
     */
    public function run()
    {
        $this->getWrapper()->run();
    }

    /**
     * @return RouteWrapperContract
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * @param RouteWrapperContract $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @return SchemaContract
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param SchemaContract $schema
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
    }
}
