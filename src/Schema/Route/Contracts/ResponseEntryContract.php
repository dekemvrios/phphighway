<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Interface ResponseEntryContract
 *
 * @package HighWay\Schema\Route\Contracts
 */
interface ResponseEntryContract
{

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);
}