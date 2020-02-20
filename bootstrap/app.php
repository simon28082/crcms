<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

//$_ENV['APP_SERVICES_CACHE'] = $app->storagePath().'/services.php';
//$_ENV['APP_PACKAGES_CACHE'] = $app->storagePath().'/packages.php';
//var_dump(\Illuminate\Support\Env::get("APP_BASE_PATH1") ?? "abc");
//var_dump(\Illuminate\Support\Env::get("APP_SERVICES_CACHE"));
//echo PHP_EOL;
//echo PHP_EOL;
//echo PHP_EOL;
//echo PHP_EOL;
//echo PHP_EOL;
//putenv("APP_SERVICES_CACHE={$_ENV['APP_BASE_PATH']}".$app->storagePath().'/services.php');
//putenv("APP_PACKAGES_CACHE=".$app->storagePath().'/packages.php');
//dd(getenv("APP_SERVICES_CACHE")) ;

//\Illuminate\Support\Env::enablePutenv();
//putenv("APP_SERVICES_CACHE=123");
//putenv("APP_PACKAGES_CACHE=".$app->storagePath().'/packages.php');
//var_dump(getenv("APP_BASE_PATH"),$_ENV['APP_BASE_PATH']);
//echo PHP_EOL;
//echo PHP_EOL;
//echo PHP_EOL;
//echo PHP_EOL;
$app = new Illuminate\Foundation\Application(
    Illuminate\Support\Env::get('APP_BASE_PATH') ?? dirname(__DIR__)
);

//putenv("APP_SERVICES_CACHE=".$app->storagePath().'/services.php');
//putenv("APP_PACKAGES_CACHE=".$app->storagePath().'/packages.php');
//$_ENV['APP_SERVICES_CACHE'] = $app->storagePath().'/services.php';
//$_ENV['APP_PACKAGES_CACHE'] = $app->storagePath().'/packages.php';

    /*
    |--------------------------------------------------------------------------
    | Bind Important Interfaces
    |--------------------------------------------------------------------------
    |
    | Next, we need to bind some important interfaces into the container so
    | we will be able to resolve them when needed. The kernels serve the
    | incoming requests to this application from both the web and CLI.
    |
    */

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    Application\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Application\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Application\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
