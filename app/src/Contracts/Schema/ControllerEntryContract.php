<?php

namespace HighWay\Contracts\Schema;

/**
 * Interface ControllerEntryContract
 *
 * @package HighWay\Contracts\Schema
 */
interface ControllerEntryContract
{

    /**
     * @return string
     */
    public function getClass();

    /**
     * @param string $class
     */
    public function setClass($class);

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @param string $method
     */
    public function setMethod($method);
}