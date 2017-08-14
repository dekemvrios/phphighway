<?php

namespace HighWay\Wrappers\SlimApp\Helpers;

use HighWay\Schema\Route\Contracts\SchemaEntryContract;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class SchemaResponse
 *
 * @package HighWay\Wrappers\SlimApp\Helpers
 */
class SchemaResponse
{

    /**
     * @param Response            $response
     * @param SchemaEntryContract $route
     * @param array               $data
     */
    public static function processResponse(
        $response,
        $route,
        $data
    ) {
        // aplica headers a resposta caso especificado no schema da respectiva rota
        $response = self::responseWithHeaders(
            $response,
            $route,
            $data
        );

        /**
         * |------------------------------------------------------------------
         * | Implementa��o para compatibilidade com vers�o v0.1.x (legacy)
         * |------------------------------------------------------------------
         * |
         * | Caso a determinada rota utilizar Respose com aplica��o de headers,
         * | ent�o considera-se que o retorno possuir� entradas headers e data.
         * |
         * | Aplica-se ao retorno apenas o conte�do da entrada data do retorno,
         * | visto que as demais informa��es s�o desnecess�rias.
         * |
         */
        if ($route->getRequestEntry()->getType() == 'rest') {
            $data = $data['data'];
        }

        // captura o tipo de resposta qual definir� o formato dos dados a serem retornados pela rota
        $responseType = $route->getResponseEntry()->getType();

        return $response->$responseType(
            $data
        );
    }

    /**
     * @param Response            $response
     * @param SchemaEntryContract $route
     * @param array               $data
     *
     * @return Response
     */
    public static function responseWithHeaders(
        $response,
        $route,
        $data
    ) {
        if (empty($route->getResponseEntry()->getHeaders())) {
            return $response;
        }

        if (!array_key_exists(
            'headers',
            $data
        )
        ) {
            return $response;
        }

        foreach ($route->getResponseEntry()->getHeaders() as $headerEntry) {

            /**
             * a utiliza��o do Status-Code exige a utiliza��o do m�todo
             * withStatus do ResponseInterface, justificando valida��o
             * a mais para aplica��o do seu respectivo valor.
             */
            if ($headerEntry->getName() == 'Status-Code') {
                if (array_key_exists(
                    'statusCode',
                    $data['headers']
                )) {
                    $response = $response->withStatus($data['headers']['statusCode']);
                }
                continue;
            }

            if (!empty($headerEntry->getUseStatic())) {
                $response = $response->withAddedHeader(
                    $headerEntry->getName(),
                    $headerEntry->getUseStatic()
                );
                continue;
            }

            $value = $data['headers'][$headerEntry->getExpected()];
            if (!is_null($value)) {
                $response = $response->withAddedHeader(
                    $headerEntry->getName(),
                    $value
                );
                continue;
            }

            if (!empty($headerEntry->getDefault())) {
                $response = $response->withAddedHeader(
                    $headerEntry->getName(),
                    $headerEntry->getDefault()
                );
                continue;
            }
        }

        return $response;
    }
}