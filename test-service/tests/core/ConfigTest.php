<?php

namespace Tests\Core;

//use \UnitTestCase as UnitTestCase;

/**
 * Class to test Config files
 */
class ConfigTest extends \Test\TestCase
{
    protected $test = 'test';
    protected $dev = 'dev';
    protected $prod = 'prod';

    public function testConfig()
    {

        $configDev = require __DIR__.'/../../app/config/config.'. $this->dev .'.php';
        $configTest = require __DIR__.'/../../app/config/config.'. $this->test .'.php';
        $configProd = require __DIR__.'/../../app/config/config.'. $this->prod .'.php';

        $this->assertInstanceOf('Phalcon\Config', $configDev);
        $this->assertInstanceOf('Phalcon\Config', $configTest);
        $this->assertInstanceOf('Phalcon\Config', $configProd);
    }
}
