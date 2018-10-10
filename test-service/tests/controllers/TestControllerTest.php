<?php

namespace Test\Controllers;

/**
 * Class to test a controller
 */
class TestControllerTest extends \Test\TestCase
{
    public function testListAll()
    {
        $this->assertInternalType('array', $this->di->get('App\Controllers\TestController')->listAll());
    }

    public function testInsertData()
    {
        $json = '{
            "name": "C. Ronaldo",
            "country": "POR"
        }';
        $request_array = json_decode($json, false);
        $this->di->get('request')->setRawBody(json_encode($request_array));
        $this->assertInternalType('array', $this->di->get('App\Controllers\TestController')->insertData());
    }
}
