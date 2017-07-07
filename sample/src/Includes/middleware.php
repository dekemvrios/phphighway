<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return [
    'auth' => function (Request $oRequest, Response $oResponse, $next) {

        $sSecretKey = "1471036882595f79abf16587.70188608";

        // $_SERVER variables get the IP and Name of the localhost server running
        $aWhitelistDomains = [
            "127.0.0.1",
            "localhost",
            "::1",
            $_SERVER["SERVER_NAME"],
        ];

        $sRequestKey = $oRequest->getHeaderLine('Authorization');

        $sRemoteAddress = $oRequest->getServerParams()["REMOTE_ADDR"];

        // check if the host who requested the page is whitelisted and the auth key is valid
        if (!in_array($sRemoteAddress, $aWhitelistDomains) && !($sSecretKey === $sRequestKey)) {

            $this->logger->error("MSG: invalid network address" . " KEY: " . $sRequestKey);

            return $oResponse
                ->withJson(['status' => 403, 'reason' => "Auth failed"]);
        }

        $this->logger->notice("MSG: authentication success" . " KEY: " . $sRequestKey);

        return !empty($next) ? $next($oRequest, $oResponse) : $oResponse->withJson(
            ['status' => 500, 'reason' => 'Internal Server Error']
        );
    },
];
