<?php

namespace Test\Services;

/**
 * Class to test Auth
 */
class AuthServiceTest extends \Test\TestCase
{
    public function testAuthService()
    {
        $token = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlRFU1QtUEhBTENPTiIsImlhdCI6MTUxNjIzOTAyMn0._hJ3s4C0snRT7oBFA7CDDxTggOAZf7ZxR1DzKYQOVxQ';
        $config = $this->di->get('config');
        $this->assertInternalType('bool', \App\Services\AuthService::authenticate($token, $config));
    }

    public function testNoToken()
    {
        $this->expectException('Exception');
        $token = '';
        $config = $this->di->get('config');
        $this->assertInternalType('bool', \App\Services\AuthService::authenticate($token, $config));
    }
}
