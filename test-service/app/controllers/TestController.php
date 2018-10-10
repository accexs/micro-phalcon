<?php
namespace App\Controllers;

use \App\Exceptions\AbstractHttpException;

class TestController extends RESTController
{
    public function listAll()
    {
        $this->logger->info('Listing all content');
        $db = $this->mongodb;
        $query = [];
        $result = $db->selectDatabase($this->config->database->dbname)
        ->selectCollection('players')
        ->find($query, array(
            'limit' => $this->limit,
            'skip'  => $this->offset
        ))
        ->toArray();
        return $this->mongoHelper->bsonToArray($result);
    }

    public function insertData()
    {
        $doc = $this->request->getJsonRawBody();
        $db = $this->mongodb;
        $result = $db->selectDatabase($this->config->database->dbname)
        ->selectCollection('players')
        ->insertOne($doc);
        return array('oid' => (string)$result->getInsertedId());
    }

    public function getbyId($id)
    {
        $query = array(
            '_id' => new \MongoDB\BSON\ObjectID($id)
        );
        $db = $this->mongodb;
        $result = $db->selectDatabase($this->config->database->dbname)
        ->selectCollection('players')->findOne($query);
        return $this->mongoHelper->bsonToArray($result);
    }

    public function updateData($id)
    {
        $query = array(
            '_id' => new \MongoDB\BSON\ObjectID($id)
        );
        $data = array(
            '$set' => $this->request->getJsonRawBody()
        );
        $db = $this->mongodb;
        $result = $db->selectDatabase($this->config->database->dbname)
        ->selectCollection('players')
        ->findOneAndUpdate($query, $data);

        if ($result === null) {
            return array('msg' => 'document not found');
        } else {
            return array('msg' => 'document found and updated');
        }
    }

    public function deleteData($id)
    {
        $query = array(
            '_id' => new \MongoDB\BSON\ObjectID($id)
        );
        $db = $this->mongodb;
        $result = $db->selectDatabase($this->config->database->dbname)
        ->selectCollection('players')
        ->deleteOne($query);

        if ($result->getDeletedCount() < 1) {
            return array('msg' => 'document not found');
        } else {
            return array('msg' => 'document found and updated');
        }
    }
}
