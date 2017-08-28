<?php

namespace HighWay\Contracts;

/**
 * Interface RequestContract
 *
 * @package HighWay\Contracts
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