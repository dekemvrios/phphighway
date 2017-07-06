<?php

namespace HighWay\Classes\RouteSchema;

use HighWay\Contracts\Schema\ControllerEntryContract;
use Solis\Breaker\TException;

/**
 * Class ControllerEntry
 *
 * @package HighWay\Classes\RouteSchema
 */
class ControllerEntry implements ControllerEntryContract
{

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $method;

    /**
     * ControllerEntry constructor.
     *
     * @param $class
     * @param $method
     */
    public function __construct($class, $method)
    {
        $this->setClass($class);
        $this->setMethod($method);
    }

    /**
     * @param array $params
     *
     * @throws TException
     *
     * @return static
     */
    public static function make($params)
    {
        if (!array_key_exists('class', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'class entry has not been found creating controller schema',
                400
            );
        }

        if (!class_exists($params['class'])) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'class [ ' . $params['class'] . ' ] has not been defined for creating controller entry in route schema',
                400
            );
        }

        if (!array_key_exists('method', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'class entry has not been found creating controller schema',
                400
            );
        }

        if (!method_exists($params['class'], $params['method'])) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                ' method [ ' . $params['method'] . ' ] for class [ ' . $params['class'] . ' ] has not been defined for creating controller entry in route schema',
                400
            );
        }

        return new static($params['class'], $params['method']);
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
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
}
