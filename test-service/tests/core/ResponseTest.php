<?php

namespace Test\Core;

/**
 * Class to test Response classes
 */
class ResponseTest extends \Test\TestCase
{
    public function testResponse()
    {
        $records = array(['v1' => 1], ['v2' => 2]);
        $response = new \App\Responses\JSONResponse($this->di);
        $this->assertInstanceOf(
            'App\Responses\JSONResponse',
            $response->useEnvelope(false)->convertSnakeCase(true)
                                         ->send($records)
        );
    }

    public function testResponseEnvelope()
    {
        $records = array();
        $response = new \App\Responses\JSONResponse($this->di);
        $this->assertInstanceOf('App\Responses\JSONResponse', $response);
        $this->assertInstanceOf(
            'App\Responses\JSONResponse',
            $response->useEnvelope(true)->convertSnakeCase(true)
                                        ->send($records)
        );
    }

    public function testResponseHeadSnake()
    {
        $_SERVER["REQUEST_METHOD"] = "HEAD";

        $records = ['Test' => [1 => 2]];
        $response = new \App\Responses\JSONResponse($this->di);
        $this->assertInstanceOf('App\Responses\JSONResponse', $response);
        $this->assertInstanceOf(
            'App\Responses\JSONResponse',
            $response->useEnvelope(true)->convertSnakeCase(true)
                                        ->send($records)
        );
    }

    public function testResponseCsv()
    {
        $_SERVER["REQUEST_METHOD"] = "HEAD";
        $_SERVER["QUERY_STRING"] = "_url=/v1/addons/HBO/TTL600864&type=csv";
        $_SERVER["REQUEST_URI"] = "/v1/addons/HBO/TTL600864?type=csv";
        $_SERVER["argv"] = [0 => "_url=/v1/addons/HBO/TTL600864&type=csv"];
        $_SERVER["argc"] = 1;
        $_GET["_url"] = "/v1/addons/HBO/TTL600864&type=csv";

        $records = ['Test' => [1 => 2]];
        $response = new \App\Responses\JSONResponse($this->di);
        $this->assertInstanceOf('App\Responses\JSONResponse', $response);
        $this->assertInstanceOf(
            'App\Responses\JSONResponse',
            $response->useEnvelope(true)->convertSnakeCase(true)
                                        ->send($records)
        );
    }
}
