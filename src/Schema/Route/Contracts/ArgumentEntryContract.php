<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Interface ArgumentEntryContract
 *
 * @package HighWay\Schema\Route\Contracts
 */
interface ArgumentEntryContract
{

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);
}