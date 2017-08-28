<?php

namespace HighWay\Request;

/**
 * Interface RequestContract
 *
 * @package HighWay\Request
 */
interface RequestContract
{
    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return array
     */
    public function getQueryParams();

    /**
     * @return array
     */
    public function getRequestArguments();

    /**
     * @return array
     */
    public function getParsedBody();
}