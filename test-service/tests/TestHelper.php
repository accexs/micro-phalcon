<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Request;

ini_set("display_errors", 1);
error_reporting(E_ALL);

//define("ROOT_PATH", __DIR__);

set_include_path(
    __DIR__ . PATH_SEPARATOR . get_include_path()
);

// Required for phalcon/incubator
include __DIR__ . "/../vendor/autoload.php";

// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
$loader = new Phalcon\Loader;
$loader->registerNamespaces(array(
    'Test'            => __DIR__,
    'App\Services'    => __DIR__ . '/../app/services/',
    'App\Controllers' => __DIR__ . '/../app/controllers/',
    'App\Exceptions'  => __DIR__ . '/../app/boostrap/exceptions/'
))->register();

/*$di = new FactoryDefault();

Di::reset();

// Add any needed services to the DI here

Di::setDefault($di);*/
