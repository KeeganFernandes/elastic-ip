<?php

namespace App\LogEater;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger("log-eater-catcher");

        $handler = new Handler();
        $logger->pushHandler($handler);

        $logger->pushHandler(new StreamHandler(storage_path('logs/laravel.log')), Logger::INFO);
        return $logger;
    }
}
