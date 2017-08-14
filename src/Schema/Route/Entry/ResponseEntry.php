<?php

namespace HighWay\Schema\Route\Entry;

use HighWay\Schema\Route\Contracts\ResponseEntryContract;
use Solis\Breaker\TException;

/**
 * Class ResponseEntry
 *
 * @package HighWay\Classes\RouteSchema
 */
class ResponseEntry implements ResponseEntryContract
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var HeadersEntry[]
     */
    private $headers = [];

    /**
     * ResponseEntry constructor.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->setType($type);
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
            'sType',
            $params
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'sType entry has not been found creating controller schema',
                400
            );
        }

        $instance = new static($params['sType']);
        if (array_key_exists(
            'headers',
            $params
        )) {
            $headers = !is_array(
                $params['headers']
            ) ? [$params['headers']] : $params['headers'];

            foreach ($headers as $header) {
                $instance->addHeader(HeadersEntry::response($header));
            }
        }

        return $instance;
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
     * @param HeadersEntry $header
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    /**
     * @return HeadersEntry[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param HeadersEntry[] $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }
}
