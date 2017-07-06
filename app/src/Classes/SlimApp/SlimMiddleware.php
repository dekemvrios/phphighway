<?php

namespace HighWay\Classes\SlimApp;

/**
 * Class SlmiMiddleware
 *
 * @package HighWay\Classes\SlimApp
 */
class SlimMiddleware
{

    /**
     * @var array
     */
    private $available;

    /**
     * SlimMiddleware constructor.
     *
     * @param $available
     */
    public function __construct($available)
    {
        $this->setAvailable($available);
    }

    /**
     * make
     */
    public static function make($params)
    {
        return new static($params);
    }

    /**
     * @return array
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param array $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * @return array|mixed
     */
    public function getEntry($name)
    {
        if (!array_key_exists($name, $this->available)) {
            return false;
        }

        return $this->available[$name];
    }
}
