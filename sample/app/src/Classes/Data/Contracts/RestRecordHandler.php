<?php

namespace Sample\Classes\Data\Contracts;

/**
 * Interface RestRecordHandler
 *
 * @package Sample\Classes\Rest\Contracts
 */
interface RestRecordHandler
{
    /**
     * @return array
     */
    public function listAll();

    /**
     * @param array $params
     *
     * @return array
     */
    public function findOne(
        array $params
    );

    /**
     * @param array $params
     *
     * @return array
     */
    public function delete(
        array $params
    );

    /**
     * @param array $params
     *
     * @return array
     */
    public function update(
        array $params
    );
}