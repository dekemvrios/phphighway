<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Interface SchemaContract
 *
 * @package HighWay\Schema\Route\Contracts
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