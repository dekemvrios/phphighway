<?php

namespace HighWay\Schema\Route;

use HighWay\Schema\Route\Contracts\SchemaContract;
use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use HighWay\Schema\Route\Entry\SchemaEntry;

/**
 * Class Schema
 *
 * @package HighWay\Classes\RouteSchema
 */
class Schema implements SchemaContract
{

    /**
     * @var SchemaEntryContract[]
     */
    private $schemaEntry = [];

    /**
     * @param array $routes
     *
     * @return static
     */
    public static function make($routes)
    {

        $instance = new static();
        foreach ($routes as $route) {
            $schemaEntry = SchemaEntry::make($route);

            $instance->addSchemaEntry($schemaEntry);
        }

        return $instance;
    }

    /**
     * @return SchemaEntryContract[]
     */
    public function getSchemaEntry()
    {
        return $this->schemaEntry;
    }

    /**
     * @param SchemaEntryContract[] $schemaEntry
     */
    public function setSchemaEntry($schemaEntry)
    {
        $this->schemaEntry = $schemaEntry;
    }

    /**
     * @param SchemaEntryContract $schema
     */
    public function addSchemaEntry($schema)
    {
        array_push(
            $this->schemaEntry,
            $schema
        );
    }
}
