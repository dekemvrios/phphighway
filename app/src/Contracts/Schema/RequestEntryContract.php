<?php

namespace HighWay\Contracts\Schema;

/**
 * Interface RequestEntryContract
 *
 * @package HighWay\Contracts\Schema
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