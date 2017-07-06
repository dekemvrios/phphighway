<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return [
    'auth' => function (Request $oRequest, Response $oResponse, $next) {

        $sSecretKey = "l99IhVg9429yzv18QLF7GTJM6PUO8L3f";

        // $_SERVER variables get the IP and Name of the localhost server running
        $aWhitelistDomains = [
            "127.0.0.1",  "localhost", "::1", $_SERVER["SERVER_NAME"]
        ];

        $sRequestKey = $oRequest->getHeaderLine('Authorization');

        $sRemoteAddress = $oRequest->getServerParams()["REMOTE_ADDR"];

        // check if the host who requested the page is whitelisted and the auth key is valid
        if (!in_array($sRemoteAddress, $aWhitelistDomains) && !($sSecretKey === $sRequestKey)) {
            return $oResponse
                ->withJson(['status' => 403, 'reason' => "Auth failed"]);
        }

        //$this->logger->notice("KEY: " . $sRequestKey);

        return !empty($next) ? $next($oRequest, $oResponse) : $oResponse->withJson(
            ['status' => 500, 'reason' => 'Internal Server Error']
        );
    },
];
