<?php

namespace Sample\Classes\Data\Concerns;

use Sample\Classes\Data\Contracts\DataRepository;

/**
 * Trait HasDataRepository
 *
 * @package Sample\Classes\Rest\Concerns
 */
trait HasDataRepository
{
    /**
     * @var DataRepository
     */
    protected $repository;

    /**
     * @return DataRepository
     */
    public function getRepository(): DataRepository
    {
        return $this->repository;
    }

    /**
     * @param DataRepository $repository
     */
    public function setRepository(DataRepository $repository)
    {
        $this->repository = $repository;
    }
}