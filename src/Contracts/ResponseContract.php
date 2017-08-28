<?php

namespace HighWay\Contracts;

/**
 * Interface ResponseContract
 *
 * @package HighWay\Contracts
 */
interface ResponseContract
{
    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function addHeader(
        $name,
        $value
    );

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return string
     */
    public function toJson();
}