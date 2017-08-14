<?php

namespace Sample\Classes\Rest;

use Sample\Classes\Data\Contracts\RestRecordHandler;
use Sample\Classes\Data\Mocks\MockDataRepository;
use Sample\Classes\Data\Concerns\HasDataRepository;

/**
 * Class RestSample
 *
 * @package Sample\Classes\Rest
 */
class RestSample implements RestRecordHandler
{

    use HasDataRepository;

    /**
     * RestSample constructor.
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
        $records = $this->getRepository()->all();

        return [
            'data'    => array_values($records),
            'headers' => [
                'totalContent' => count($records),
                'statusCode'   => 200,
                'dateTime'     => Date('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function findOne(
        array $params
    ) {

        $records = $this->getRepository()->find($params['requestArguments']['recordId']);

        return [
            'data'    => array_values($records),
            'headers' => [
                'totalContent' => count($records),
                'dateTime'     => Date('Y-m-d H:i:s'),
                'statusCode'   => 200,
                'pageRange'    => '0/10-100',
            ],
        ];
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
                'received' => $params,
                'message'  => 'record deleted',
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