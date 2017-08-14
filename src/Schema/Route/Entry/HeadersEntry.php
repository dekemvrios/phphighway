<?php

namespace HighWay\Schema\Route\Entry;

use HighWay\Schema\Route\Contracts\HeadersEntryContract;
use Solis\Breaker\TException;

/**
 * Class HeadersEntry
 *
 * @package HighWay\Schema\Route\Entry
 */
class HeadersEntry implements HeadersEntryContract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $default;

    /**
     * @var string
     */
    protected $expected;

    /**
     * @var string
     */
    protected $useStatic;

    /**
     * @param $dados
     *
     * @return static
     * @throws TException
     */
    public static function response($dados)
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
                'name entry has not been found for headers entry in schema',
                400
            );
        }
        $instance->setName($dados['name']);

        if (array_key_exists(
            'useStatic',
            $dados
        )
        ) {
            $instance->setUseStatic($dados['useStatic']);
        }

        if (array_key_exists(
            'default',
            $dados
        )
        ) {
            $instance->setDefault($dados['default']);
        }

        if (array_key_exists(
            'expected',
            $dados
        )) {
            $instance->setExpected($dados['expected']);
        }

        if (!array_key_exists(
            'expected',
            $dados
        )
        ) {
            if (empty($instance->getDefault()) && empty($instance->getUseStatic())) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    'expected entry has not been found for headers entry in schema',
                    400
                );
            }
        }

        return $instance;
    }

    /**
     * @param $dados
     *
     * @return static
     * @throws TException
     */
    public static function request($dados)
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
                'name entry has not been found for headers entry in schema',
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
    public function setName(string $name)
    {
        $this->name = str_replace(
            ' ',
            '-',
            $name
        );
    }

    /**
     * @return string
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * @param string $expected
     */
    public function setExpected(string $expected)
    {
        $this->expected = $expected;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $default
     */
    public function setDefault(string $default)
    {
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getUseStatic()
    {
        return $this->useStatic;
    }

    /**
     * @param string $useStatic
     */
    public function setUseStatic(string $useStatic)
    {
        $this->useStatic = $useStatic;
    }
}