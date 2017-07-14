<?php

namespace HighWay\Wrappers\SlimApp;

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
     * @param array $available
     */
    public function __construct($available)
    {
        $this->setAvailable($available);
    }

    /**
     * make
     *
     * @param array $params
     *
     * @return static
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
     * @param string $name
     *
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
