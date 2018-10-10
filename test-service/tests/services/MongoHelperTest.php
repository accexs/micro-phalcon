<?php

namespace Test\Services;

/**
 * Class to test Mongo helper
 */
class MongoHelperTest extends \Test\TestCase
{
    public function testMongoHelper()
    {
        $this->assertInternalType('array', $this->di->get('mongoHelper')->bsonToArray([]));
    }
}
