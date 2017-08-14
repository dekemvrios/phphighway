<?php

namespace Sample\Classes\Legacy;

use Sample\Classes\Data\Concerns\HasDataRepository;
use Sample\Classes\Data\Contracts\RestRecordHandler;
use Sample\Classes\Data\Mocks\MockDataRepository;

/**
 * Class LegacySample
 *
 * @package Sample\Classes
 */
class LegacySample implements RestRecordHandler
{
    use HasDataRepository;

    /**
     * LegacySample constructor.
     */
    public function __construct()
    {
        $this->setRepository(MockDataRepository::make());
    }

    /**
     * @return array
     */
    public function listAll()
    {
        return $this->getRepository()->all();
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function findOne(
        array $params
    ) {
        if (!array_key_exists(
            'recordId',
            $params
        )
        ) {
            return [
                'message' => 'you must supply a recordId',
            ];
        }

        return $this->getRepository()->find($params['recordId']);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function delete(
        array $params
    ) {
        return [
            'data' => [
                'message'  => 'record deleted',
                'received' => $params,
            ],
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function update(
        array $params
    ) {
        return [
            'data' => [
                'message'  => 'record updated',
                'received' => $params,
            ],
        ];
    }
}