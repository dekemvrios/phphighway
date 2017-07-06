<?php

namespace HighWay\Contracts\Schema;

/**
 * Interface SchemaContract
 *
 * @package HighWay\Contracts\Schema
 */
interface SchemaContract
{
    /**
     * @return SchemaEntryContract[]
     */
    public function getSchemaEntry();

    /**
     * @param SchemaEntryContract[] $schemaEntry
     */
    public function setSchemaEntry($schemaEntry);

    /**
     * @param SchemaEntryContract $schema
     */
    public function addSchemaEntry($schema);
}