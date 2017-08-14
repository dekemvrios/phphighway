<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Interface ControllerEntryContract
 *
 * @package HighWay\Schema\Route\Contracts
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

    /**
     * @return string
     */
    public function getConstructor();

    /**
     * @param string $constructor
     */
    public function setConstructor($constructor);
}