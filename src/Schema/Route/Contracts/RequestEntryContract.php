<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Interface RequestEntryContract
 *
 * @package HighWay\Schema\Route\Contracts
 */
interface RequestEntryContract
{
    /**
     * @return string
     */
    public function getUri();

    /**
     * @param string $uri
     */
    public function setUri($uri);

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param string $method
     */
    public function setMethod($method);

    /**
     * @return ControllerEntryContract
     */
    public function getControllerEntry();

    /**
     * @param ControllerEntryContract $controllerEntry
     */
    public function setControllerEntry($controllerEntry);

    /**
     * @param ArgumentEntryContract $argument
     */
    public function addArgument($argument);

    /**
     * @return ArgumentEntryContract[]
     */
    public function getArguments();

    /**
     * @param ArgumentEntryContract[] $arguments
     */
    public function setArguments($arguments);

    /**
     * @param HeadersEntryContract $header
     */
    public function addHeader($header);

    /**
     * @return HeadersEntryContract[]
     */
    public function getHeaders();

    /**
     * @param HeadersEntryContract[] $headers
     */
    public function setHeaders($headers);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);
}