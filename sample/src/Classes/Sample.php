<?php

namespace Sample\Classes;

/**
 * Class Sample
 *
 * @package Sample\Classes
 */
class Sample
{
    /**
     * find
     *
     * @param array $aParams
     *
     * @return array
     */
    public function find($aParams = null)
    {
        $aParams = !empty($aParams) ? $aParams : [];

        return [
            'id'     => uniqid(rand()),
            'method' => 'find',
            'name'   => array_key_exists(
                'name',
                $aParams
            ) ? $aParams['name'] : 'sample',
            'date'   => date("Y-m-d H:i:s"),
        ];
    }

    /**
     * put
     *
     * @param array $aParams
     *
     * @return array
     */
    public function put($aParams = null)
    {

        $aParams = !empty($aParams) ? $aParams : [];

        return [
            'id'     => uniqid(rand()),
            'method' => 'put',
            'name'   => array_key_exists(
                'proDescricao',
                $aParams
            ) ? $aParams['proDescricao'] : 'sample',
            'obs'    => array_key_exists(
                'randData',
                $aParams
            ) ? $aParams['randData'] : 'sample',
            'date'   => date("Y-m-d H:i:s"),
        ];
    }

    /**
     * del
     *
     * @param array $aParams
     *
     * @return array
     */
    public function del($aParams = [])
    {
        $aParams = !empty($aParams) ? $aParams : [];

        return [
            'id'     => uniqid(rand()),
            'method' => 'del',
            'name'   => array_key_exists(
                'randData',
                $aParams
            ) ? $aParams['randData'] : 'sample',
            'date'   => date("Y-m-d H:i:s"),
        ];
    }

}