<?php

namespace HighWay\Schema\Route\Entry;

use HighWay\Schema\Route\Contracts\ControllerEntryContract;
use HighWay\Schema\Route\Contracts\HeadersEntryContract;
use HighWay\Schema\Route\Contracts\RequestEntryContract;
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
     * @var string
     */
    private $type;

    /**
     * @var ControllerEntryContract
     */
    private $controllerEntry;

    /**
     * @var ArgumentEntry[]
     */
    private $arguments = [];

    /**
     * @var HeadersEntryContract[]
     */
    private $headers;

    /**
     * RequestEntry constructor.
     *
     * @param string                  $uri
     * @param string                  $method
     * @param ControllerEntryContract $controllerEntry
     */
    public function __construct(
        $uri,
        $method,
        $controllerEntry
    ) {
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
        if (!array_key_exists(
            'uri',
            $params
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'uri entry has not been found creating request schema entry',
                400
            );
        }

        if (!array_key_exists(
            'method',
            $params
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'method entry has not been found creating request schema entry',
                400
            );
        }

        if (!array_key_exists(
            'controller',
            $params
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'controller entry has not been found creating request schema entry',
                400
            );
        }

        $instance = new static(
            $params['uri'],
            $params['method'],
            ControllerEntry::make($params['controller'])
        );

        if (array_key_exists(
            'arguments',
            $params
        )) {
            $arguments = !is_array($params['arguments']) ? [$params['arguments']] : $params['arguments'];

            foreach ($arguments as $arg) {
                $instance->addArgument(ArgumentEntry::make($arg));
            }
        }

        if (array_key_exists(
            'headers',
            $params
        )) {
            $headers = !is_array($params['headers']) ? [$params['headers']] : $params['headers'];

            foreach ($headers as $header) {
                $instance->addHeader(HeadersEntry::request($header));
            }
        }

        $requestType = 'legacy';
        if (array_key_exists(
            'type',
            $params
        )
        ) {
            $validTypes = ['legacy', 'rest'];
            if (!in_array(
                $params['type'],
                $validTypes
            )
            ) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    $params['type'] . ' is not a valid request type',
                    400
                );
            }
            $requestType = $params['type'];
        }
        $instance->setType($requestType);

        return $instance;
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

    /**
     * @param ArgumentEntry $argument
     */
    public function addArgument($argument)
    {
        $this->arguments[] = $argument;
    }

    /**
     * @return ArgumentEntry[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param ArgumentEntry[] $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param HeadersEntryContract $header
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    /**
     * @return HeadersEntryContract[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param HeadersEntryContract[] $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }
}
