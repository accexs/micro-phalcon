<?php
return call_user_func(function () {
    $addonsCollection = new \Phalcon\Mvc\Micro\Collection();

    $addonsCollection
    // VERSION NUMBER SHOULD BE FIRST URL PARAMETER, ALWAYS
    ->setPrefix('/v1/addons')
    // Must be a string in order to support lazy loading
    ->setHandler('\App\Controllers\AddonsController')
    ->setLazy(true);

    $addonsCollection->get('/', 'listAll');
    $addonsCollection->get('/{provider}/content-type/{content_type}', 'listbyContType');
    $addonsCollection->get('/{provider}', 'listbyProvider');
    $addonsCollection->get('/{provider}/{id}', 'listbyId');
    $addonsCollection->get('/{provider}/{id}/ingest', 'ingest');

    $addonsCollection->patch('/{provider}/{id}', 'updatebyId');
    $addonsCollection->patch('/{provider}/{id}/reset', 'resetbyId');

    return  $addonsCollection;
});
