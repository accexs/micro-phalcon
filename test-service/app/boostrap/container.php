<?php

/**
* Define dependency injection container.
*/
$di = new Phalcon\Di;

/**
 * Router
 */
$di->set('router', new \Phalcon\Mvc\Router);

/**
 * Returns array of collections to be mounted into the app.
 */
$di->set('collections', function () {
    return require(__DIR__.'/routeLoader.php');
});

/**
 * This makes the config availible on the container.
 */
$di->setShared('config', function () use ($config) {
    return $config;
    //return new IniConfig("config/config.ini");
});

/**
 * Mongo instance
 */
// Instancia de MongoDB
$di->setShared('mongodb', function () use ($config) {
    $uri = $config->database->host;
    $mongodb = new \Phalcon\Db\Adapter\MongoDB\Client(
        'mongodb://'.$uri,
        array(
            "socketTimeoutMS" => $config->database->timeout
        )
    );
    return $mongodb;
});

/**
 * Logger instance
 */
$di->setShared('logger', function () use ($config) {
    $logger = new Phalcon\Logger\Adapter\File($config->logger->dir .'/app.log');
    return $logger;
});

/**
 * Overriding Response-object to set the Content-type header globally
 */
$di->setShared('response', function () {
        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'utf-8');
        return $response;
});

/**
 * request
 */
$di->setShared('request', new \Phalcon\Http\Request);

/**
 * Helper to convert bson documents to array.
 */
$di->setShared('mongoHelper', function () {
    return new App\Services\MongoHelper();
});

/**
 * Set validator as part of the DI
 */
$di->setShared('validator', function () {
    return new Accexs\Validator;
});

return $di;
