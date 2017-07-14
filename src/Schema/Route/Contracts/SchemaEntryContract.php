<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Class SchemaEntryContract
 *
 * @package HighWay\Schema\Route\Contracts
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