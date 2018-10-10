<?php

return call_user_func(function () {

    $exampleCollection = new \Phalcon\Mvc\Micro\Collection();

    $exampleCollection
        // VERSION NUMBER SHOULD BE FIRST URL PARAMETER, ALWAYS
        ->setPrefix('/v1/test')
        // Must be a string in order to support lazy loading
        ->setHandler('\App\Controllers\TestController')
        ->setLazy(true);

    // First paramter is the route, which with the collection prefix here would be GET /example/
    // Second paramter is the function name of the Controller.
    $exampleCollection->get('/', 'listAll');
    $exampleCollection->post('/', 'insertData');
    $exampleCollection->get('/{id}', 'getbyId');
    #$exampleCollection->get('/{name}', 'getbyName');
    $exampleCollection->patch('/{id}', 'updateData');
    $exampleCollection->delete('/{id}', 'deleteData');
    
    // This is exactly the same execution as GET, but the Response has no body.
    $exampleCollection->head('/', 'listAll');

    return $exampleCollection;
});
