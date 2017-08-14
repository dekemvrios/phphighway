<?php

namespace HighWay\Schema\Route\Contracts;

/**
 * Interface HeadersEntryContract
 *
 * @package HighWay\Schema\Route\Contracts
 */
interface HeadersEntryContract
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getExpected();

    /**
     * @param string $expected
     */
    public function setExpected(string $expected);

    /**
     * @return string
     */
    public function getDefault();

    /**
     * @param string $default
     */
    public function setDefault(string $default);

    /**
     * @return string
     */
    public function getUseStatic();

    /**
     * @param string $useStatic
     */
    public function setUseStatic(string $useStatic);
}