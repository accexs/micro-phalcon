<?php

use Phalcon\Mvc\Micro\Collection;
use App\Services\AuthService;

/**
 * Sets the environment
 */
if (empty($_SERVER['ENV'])) {
    $env = 'dev';
} else {
    $env = $_SERVER['ENV'];
}

$config = require __DIR__.'/../app/config/config.'. $env .'.php';

$loader = require __DIR__.'/../app/boostrap/loader.php';

/**
 * composer autoload
 */
require_once(__DIR__.'/../vendor/autoload.php');

$di = require  __DIR__.'/../app/boostrap/container.php';

$app = new Phalcon\Mvc\Micro();
$app->setDI($di);
$app->getRouter()->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$app->logger->info('App started');

/**
 * set exception handler
 */
new Whoops\Provider\Phalcon\WhoopsServiceProvider($di);

/**
 * Mount collections, make routes active
 */
foreach ($di->get('collections') as $collection) {
    $app->mount($collection);
}

/**
 * For documentation purposes, list all methods.
 */
$app->get('/', function () use ($app) {
    $routes = $app->getRouter()->getRoutes();
    $routeDefinitions = array('GET'=>array(), 'POST'=>array(), 'PUT'=>array(), 'PATCH'=>array(), 'DELETE'=>array(), 'HEAD'=>array(), 'OPTIONS'=>array());
    foreach ($routes as $route) {
        $method = $route->getHttpMethods();
        $routeDefinitions[$method][] = $route->getPattern();
    }
    return $routeDefinitions;
});

/**
 * This functions sends the response to the client, depends of the type (JSON, csv)
 */
$app->after(function () use ($app) {

    // OPTIONS have no body, send the headers, exit
    if ($app->request->getMethod() == 'OPTIONS') {
        $app->response->setStatusCode('200', 'OK');
        $app->response->send();
        return;
    }

    // Respond by default as JSON
    if (!$app->request->get('type') || $app->request->get('type') == 'json') {
        // Results returned from the route's controller.  All Controllers should return an array
        $records = $app->getReturnedValue();
        $response = new \App\Responses\JSONResponse();
        $response->useEnvelope(true) //this is default behavior
            ->convertSnakeCase(false) //this is also default behavior
            ->send($records);

        return;
    } elseif ($app->request->get('type') == 'csv') {
        $records = $app->getReturnedValue();
        $response = new \App\Responses\CSVResponse();
        $response->useHeaderRow(true)->send($records);

        return;
    } else {
        throw new Exception(
            'Could not return results in specified format. Choose either "csv" or "json"',
            403
        );
    }
});

/**
 * Default handler function that runs when no route was matched.
 * We set a 404 here unless there's a suppress error codes.
 */
$app->notFound(function () use ($app) {
    throw new \App\Exceptions\HttpExceptions\Http404Exception(
        'URL Not Found.',
        404,
        new \Exception('URL not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
    );
});

/**
 * Auth handler
 */
$token = $app->request->getHeader('Authorization');
$auth =  AuthService::authenticate($token, $config);

$app->handle();
$app->logger->info('App ended');

$app->error(
    function ($exception) {
        echo json_encode(
            [
                'code'    => $exception->getCode(),
                'status'  => 'error',
                'message' => $exception->getMessage(),
            ]
        );
    }
);
