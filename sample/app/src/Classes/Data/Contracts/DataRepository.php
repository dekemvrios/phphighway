<?php

namespace Sample\Classes\Data\Contracts;

/**
 * Interface DataRepository
 *
 * @package Sample\Classes
 */
interface DataRepository
{

    /**
     * @return array
     */
    public function all();

    /**
     * @param $id
     *
     * @return array|boolean
     */
    public function find($id);
}