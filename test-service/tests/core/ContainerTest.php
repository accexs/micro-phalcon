<?php

namespace Test\Core;

/**
 * Class to test Loader
 */
class ContainerTest extends \Test\TestCase
{
    public function testContainer()
    {
        $config = $this->di->get('config');
        $di = require __DIR__.'/../../app/boostrap/container.php';
        $this->assertInstanceOf('Phalcon\Di', $this->di);
        foreach ($di->get('collections') as $collection) {
            $this->assertInstanceOf('Phalcon\Mvc\Micro\Collection', $collection);
        }
        $this->assertInstanceOf('Phalcon\Db\Adapter\MongoDB\Client', $di->get('mongodb'));
        $this->assertInstanceOf('Phalcon\Config', $di->get('config'));
        $this->assertInstanceOf('Phalcon\Logger\Adapter\File', $di->get('logger'));
        $this->assertInstanceOf('App\Services\MongoHelper', $di->get('mongoHelper'));
        $this->assertInstanceOf('Phalcon\Http\Response', $di->get('response'));
        $this->assertInstanceOf('Accexs\Validator', $di->get('validator'));
    }
}
