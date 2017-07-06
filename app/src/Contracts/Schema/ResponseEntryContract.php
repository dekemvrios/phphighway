<?php

namespace HighWay\Contracts\Schema;

/**
 * Interface ResponseEntryContract
 *
 * @package HighWay\Contracts\Schema
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