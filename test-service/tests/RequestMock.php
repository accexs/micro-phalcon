<?php

namespace Test;

class RequestMock extends \Phalcon\Http\Request
{
    /**
     * @var string|null Holds the raw body to be used for tests
     */
    static protected $raw_body = null;

    /**
     * Override the method to allow us to get a raw body, set for tests
     *
     * @return string
     */
    public function getRawBody()
    {
        return self::$raw_body;
    }

    /**
     * Sets the raw body to be used in tests
     *
     * @param string $raw_body The raw body to be set and used for tests
     */
    public function setRawBody($raw_body)
    {
        self::$raw_body = $raw_body;
    }

    /**
     * Override the request header
     */
    /*public function getHeader()
    {
        return self::$header;
    }*/

    /**
     * Sets header to be used in tests
     *
     * @param string $header
     */
    /*public function setHeader($header)
    {
        self::$header = $header;
    }*/
}
