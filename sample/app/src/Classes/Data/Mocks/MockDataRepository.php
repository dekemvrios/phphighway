<?php

namespace Sample\Classes\Data\Mocks;

use Sample\Classes\Data\Contracts\DataRepository;

/**
 * Class MockDataRepository
 *
 * @package Sample\Classes
 */
class MockDataRepository implements DataRepository
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @return static
     */
    public static function make()
    {
        $instance = new static();

        $records = [];

        $quantity = rand(
            5,
            10
        );
        for ($iterator = 1; $iterator < $quantity; $iterator++) {
            $record = [
                'id'   => $iterator,
                'name' => "record_[{$iterator}]" . uniqid(rand()),
            ];

            $records[] = $record;
        }

        $instance->setData($records);

        return $instance;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->getData();
    }

    /**
     * @param $id
     *
     * @return array|boolean
     */
    public function find($id)
    {
        $record = array_filter(
            $this->getData(),
            function ($record) use
            (
                $id
            ) {
                return $record['id'] == $id ? true : false;
            }
        );

        return !empty($record) ? $record : false;
    }
}