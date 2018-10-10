<?php

namespace Test;

use \Helmich\MongoMock\MockCollection;
use \Helmich\MongoMock\MockDatabase;

class MongoMock
{
    public function __construct()
    {
        $db = new MockDatabase('ClaroVideoFinal');
        $this->db = $db;
    }

    public function selectDatabase()
    {
        return $this->db;
    }
}
