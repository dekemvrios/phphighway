<?php

namespace HighWay\Action;

use HighWay\Request\RequestContract;
use HighWay\Response\ResponseContract;

/**
 * Interface ActionContract
 *
 * @package HighWay\Action
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