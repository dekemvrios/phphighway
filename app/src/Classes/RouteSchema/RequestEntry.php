<?php

namespace HighWay\Classes\RouteSchema;

use HighWay\Contracts\Schema\ControllerEntryContract;
use HighWay\Contracts\Schema\RequestEntryContract;
use Solis\Breaker\TException;

/**
 * Class RequestEntry
 *
 * @package HighWay\Classes\RouteSchema
 */
class RequestEntry implements RequestEntryContract
{

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    /**
     * @var ControllerEntryContract
     */
    private $controllerEntry;

    /**
     * RequestEntry constructor.
     *
     * @param string                  $uri
     * @param string                  $method
     * @param ControllerEntryContract $controllerEntry
     */
    public function __construct($uri, $method, $controllerEntry)
    {
        $this->setUri($uri);
        $this->setMethod($method);
        $this->setControllerEntry($controllerEntry);
    }

    /**
     * @param array $params
     *
     * @return static
     * @throws TException
     */
    public static function make($params)
    {
        if (!array_key_exists('uri', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'uri entry has not been found creating request schema entry',
                400);
        }

        if (!array_key_exists('method', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'method entry has not been found creating request schema entry',
                400);
        }

        if (!array_key_exists('controller', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'controller entry has not been found creating request schema entry',
                400);
        }

        return new static($params['uri'], $params['method'], ControllerEntry::make($params['controller']));
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return ControllerEntryContract
     */
    public function getControllerEntry()
    {
        return $this->controllerEntry;
    }

    /**
     * @param ControllerEntryContract $controllerEntry
     */
    public function setControllerEntry($controllerEntry)
    {
        $this->controllerEntry = $controllerEntry;
    }
}
