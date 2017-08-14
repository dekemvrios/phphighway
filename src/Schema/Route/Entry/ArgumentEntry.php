<?php

namespace HighWay\Schema\Route\Entry;

use HighWay\Schema\Route\Contracts\ArgumentEntryContract;
use Solis\Breaker\TException;

/**
 * Class ArgumentEntry
 *
 * @package HighWay\Schema\Route\Entry
 */
class ArgumentEntry implements ArgumentEntryContract
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @param array $dados
     *
     * @return static
     * @throws TException
     */
    public static function make($dados)
    {
        $instance = new static();
        if (!array_key_exists(
            'name',
            $dados
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'name entry has not been found for arguments entry in schema',
                400
            );
        }

        $instance->setName($dados['name']);

        return $instance;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}