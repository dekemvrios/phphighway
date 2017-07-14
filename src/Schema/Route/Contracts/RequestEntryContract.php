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
}