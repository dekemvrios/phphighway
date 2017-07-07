<?php
/**
 * Config Path and URL
 */
{
    $aConfig = [];

    // root path
    $aConfig['absPath'] = dirname(__FILE__) . '/..';
}

/**
 * Define Logger settings
 */
{
    $aConfig['logger']['name'] = "ms-servicos"; // App name to show in logs
    $aConfig['logger']['path'] = $aConfig['absPath'] . '/Logs/app.log'; // log directory
    // Log level must change in production (Recommended for production: ERROR, or at least NOTICE)
    $aConfig['logger']['level'] = \Monolog\Logger::NOTICE; // Log level -- See Monolog documentation for more information https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels
}