<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Monolog
 *
 */
$container = $app->getWrapper()->getApp()->getContainer();
$container['logger'] = function ($c) {

    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\WebProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

/**
 * Configurarions
 *
 */
$app->getWrapper()->getApp()->add(function (Request $oRequest, Response $oResponse, $next) {
    // Log the access as debug level
    $this->logger->debug("ACCESS");

    // After log the access, continue to the route
    $oResponse = $next($oRequest, $oResponse);

    // Log the result as info level
    $this->logger->info("RESULT", ["result" => $oResponse]);

    // Return the response
    return $oResponse
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});