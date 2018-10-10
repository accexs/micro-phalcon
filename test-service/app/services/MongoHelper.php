<?php

namespace App\Services;

class MongoHelper
{
    public function bsonToArray($document)
    {
        if (empty($document)) {
            $document = array('Not found');
        }
        $data = \MongoDB\BSON\toJSON(\MongoDB\BSON\fromPHP($document));
        $data = json_decode($data, true);
        return $data;
    }
}
