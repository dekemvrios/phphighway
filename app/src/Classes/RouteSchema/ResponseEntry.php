<?php

namespace HighWay\Classes\RouteSchema;

use HighWay\Contracts\Schema\ResponseEntryContract;
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
        if (!array_key_exists('sType', $params)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'sType entry has not been found creating controller schema',
                400);
        }

        return new static($params['sType']);
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
}
