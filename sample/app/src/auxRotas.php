<?php

use Solis\Breaker\TException;

/**
 * getSchemaFileInfo
 *
 * @param $aJson
 * @param $filePath
 *
 * @return array
 */
function getSchemaFileInfo(
    $aJson,
    $filePath
) {
    $json = json_decode(
        file_get_contents($filePath),
        true
    );

    // Valida o Decode do JSON
    switch (json_last_error()) {
        // Sem Erros
        case JSON_ERROR_NONE:
            if (json_last_error() === 0) {
                $aJson[] = $json;
            }
            break;
        //Maximum stack depth exceeded
        case JSON_ERROR_DEPTH:
            //Underflow or the modes mismatch
        case JSON_ERROR_STATE_MISMATCH:
            //Unexpected control character found
        case JSON_ERROR_CTRL_CHAR:
            //Syntax error, malformed JSON
        case JSON_ERROR_SYNTAX:
            //Malformed UTF-8 characters, possibly incorrectly encoded
        case JSON_ERROR_UTF8:
            //Unknown error
        default:

            $msg = 'MSG: falha ao decodificar o JSON da rota ' . 'DETAILS: ' . json_last_error();

            error_log($msg);
            break;
    }

    return $aJson;
}

/**
 * Carrega as rotas dinamicamente através do PATH
 */
{
    $PATH = dirname(__FILE__) . '/Routes/';
    // Itera sobre os arquivos da pasta e Instancia as Rotas
    $files = new \DirectoryIterator($PATH);

    if (empty($files)) {
        throw new TException(
            __CLASS__,
            __METHOD__,
            'no files has been found at the routes directory',
            500
        );
    }

    $aJson = [];
    foreach ($files as $fileInfo) {

        if ($fileInfo->isDot()) {
            continue;
        }

        $aJson = getSchemaFileInfo(
            $aJson,
            $PATH . $fileInfo
        );
    }
}

return $aJson;