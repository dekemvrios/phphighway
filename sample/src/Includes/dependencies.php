<?php

/**
 * Monolog
 *
 * $container = $oApp->getContainer();
 */
$container = $app->getWrapper()->getApp()->getContainer();
$container['logger'] = function ($c) {

    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\WebProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};