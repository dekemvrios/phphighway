<?php

namespace HighWay\Schema\Route\Entry;

use HighWay\Schema\Route\Contracts\RequestEntryContract;
use HighWay\Schema\Route\Contracts\ResponseEntryContract;
use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use Solis\Breaker\TException;

/**
 * Class Schema
 *
 * @package HighWay\Classes\RouteSchema
 */
class SchemaEntry implements SchemaEntryContract
{

    /**
     * @var RequestEntryContract
     */
    private $requestEntry;

    /**
     * @var ResponseEntryContract
     */
    private $responseEntry;

    /**
     * @var array
     */
    private $middleware = [];

    /**
     * Schema constructor.
     *
     * @param RequestEntryContract  $requestEntry
     * @param ResponseEntryContract $responseEntry
     */
    public function __construct($requestEntry, $responseEntry)
    {
        $this->setRequestEntry($requestEntry);
        $this->setResponseEntry($responseEntry);
    }

    /**
     * @param $params
     *
     * @return static
     * @throws TException
     */
    public static function make($params)
    {
        if (!array_key_exists('request', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'request entry has not been found creating schema',
                400);
        }

        if (!array_key_exists('response', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'request entry has not been found creating schema',
                400);
        }
        $instance = new static(RequestEntry::make($params['request']), ResponseEntry::make($params['response']));

        if (array_key_exists('middleware', $params)) {
            $instance->setMiddleware(
                !is_array($params['middleware']) ? [$params['middleware']] : $params['middleware']
            );
        }

        return $instance;
    }

    /**
     * @return RequestEntryContract
     */
    public function getRequestEntry()
    {
        return $this->requestEntry;
    }

    /**
     * @param RequestEntryContract $requestEntry
     */
    public function setRequestEntry($requestEntry)
    {
        $this->requestEntry = $requestEntry;
    }

    /**
     * @return ResponseEntryContract
     */
    public function getResponseEntry()
    {
        return $this->responseEntry;
    }

    /**
     * @param ResponseEntryContract $responseEntry
     */
    public function setResponseEntry($responseEntry)
    {
        $this->responseEntry = $responseEntry;
    }

    /**
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * @param array $middleware
     */
    public function setMiddleware($middleware)
    {
        $this->middleware = $middleware;
    }

    /**
     * @param string $middleware
     */
    public function addMiddleware($middleware)
    {
        array_push($this->middleware, $middleware);
    }
}
