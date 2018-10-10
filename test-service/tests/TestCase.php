<?php

namespace Test;

use Phalcon\Di;

abstract class TestCase extends \Phalcon\Test\UnitTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp()
    {
        parent::setUp();

        /**
         * Sets the environment
         */
        if (empty($_SERVER['ENV'])) {
            $env = 'dev';
        } else {
            $env = $_SERVER['ENV'];
        }
        $config = require __DIR__.'/../app/config/config.'. $env .'.php';

        $di = Di::getDefault();

        // Get any DI components here. If you have a config, be sure to pass it to the parent

        $di->set('request', new RequestMock());
        $di->set('response', new \Phalcon\Http\Response);
        $di->set('config', $config);

        /**
         * Mongo mock instance
         */
        $di->setShared('mongodb', function () use ($config) {
            $mongo = new MongoMock();
            return $mongo;
        });

        /**
         * Helper to convert bson documents to array.
         */
        $di->setShared('mongoHelper', function () {
            return new \App\Services\MongoHelper();
        });

        /**
         * Logger instance
         */
        $di->setShared('logger', function () use ($config) {
            $logger = new \Phalcon\Logger\Adapter\File($config->logger->dir .'/app.log');
            return $logger;
        });

        /**
         * collections
         */
        $di->set('collections', function () {
            return require(__DIR__.'/../app/boostrap/routeLoader.php');
        });

        /**
         * Set validator as part of the DI
         */
        $di->setShared('validator', function () {
            return new \Accexs\Validator;
        });

        $this->setDi($di);

        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError(
                "Please run parent::setUp()."
            );
        }
    }
}
