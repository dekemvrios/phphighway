<?php

namespace HighWay\Contracts\Schema;

/**
 * Class SchemaEntryContract
 *
 * @package HighWay\Contracts\Schema
 */
interface SchemaEntryContract
{
    /**
     * @return RequestEntryContract
     */
    public function getRequestEntry();

    /**
     * @param RequestEntryContract $requestEntry
     */
    public function setRequestEntry($requestEntry);

    /**
     * @return ResponseEntryContract
     */
    public function getResponseEntry();

    /**
     * @param ResponseEntryContract $responseEntry
     */
    public function setResponseEntry($responseEntry);

    /**
     * @return array
     */
    public function getMiddleware();

    /**
     * @param array $middleware
     */
    public function setMiddleware($middleware);

    /**
     * @param string $middleware
     */
    public function addMiddleware($middleware);
}