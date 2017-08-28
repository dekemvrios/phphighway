<?php

namespace HighWay\Contracts;

/**
 * Interface ActionContract
 *
 * @package HighWay\Contracts
 */
interface ActionContract
{

    /**
     * @param RequestContract  $request
     * @param ResponseContract $response
     *
     * @return ResponseContract
     */
    public function execute(
        RequestContract $request,
        ResponseContract $response
    ): ResponseContract;
}