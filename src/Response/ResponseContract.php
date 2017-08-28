<?php

namespace HighWay\Response;

/**
 * Interface ResponseContract
 *
 * @package HighWay\Response
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