<?php

define('LARAVEL_START', microtime(true));

require realpath(__DIR__.'/../'.DIRECTORY_SEPARATOR.'vendor/autoload.php');

\CrCms\Foundation\Start::run(
    new \CrCms\Foundation\Application(
        __DIR__.'/../'
    ),
    \CrCms\Foundation\StartFactory::factory($argv[1] ?? \CrCms\Foundation\StartFactory::TYPE_WEB_SERVER)
);