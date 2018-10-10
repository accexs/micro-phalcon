<?php

/**
* Namespaces PSR-4
*/
$loader = new Phalcon\Loader;
$loader->registerNamespaces(array(
    'App\Models'      => __DIR__ . '/../models/',
    'App\Controllers' => __DIR__ . '/../controllers/',
    'App\Exceptions'  => __DIR__ . '/../boostrap/exceptions/',
    'App\Responses'   => __DIR__ . '/../responses/',
    'App\Services'    => __DIR__ . '/../services/'
))->register();

return $loader;
