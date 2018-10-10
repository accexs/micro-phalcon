<?php

namespace Test\Core;

/**
 * Class to test Loader
 */
class LoaderTest extends \Test\TestCase
{
    protected $loader;

    public function testLoad()
    {
        $this->loader = require __DIR__.'/../../app/boostrap/loader.php';
        $this->assertInstanceOf('Phalcon\Loader', $this->loader);
    }
}
