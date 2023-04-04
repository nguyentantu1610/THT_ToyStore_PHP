<?php

require_once('../model/Publisher.php');
require_once('../phpconnectmongodb.php');

class PublisherService
{
    private  $dbcollectiontoy;

    public function __construct()
    {
        $this->dbcollectiontoy  = Getmongodb("dbwebtoystore", "Publisher");
    }
    public function getAll()
    {
        //$result = [];
        $result = $this->dbcollectiontoy->find([]);
        return $result;
    }

    // C
    public function findOneByID($id)
    {
        $toy = $this->dbcollectiontoy->findOne(["publisherID" => (int)$id]);
        return $toy;
    }

    public function getNextID()
    {
        try {
            $lastProduct = $this->dbcollectiontoy->findOne([], ['sort' => ['publisherID' => -1]]);
            $lastProductId = 1;

            if ($lastProduct !== null) {
                $lastProductId = $lastProduct['publisherID'];
            }

            return $lastProductId + 1;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function create($category)
    {
        $category['publisherID'] = $this->getNextID();
        $result = $this->dbcollectiontoy->insertOne($category);
        return $result;
    }
    public function delete($id)
    {
        $result = $this->dbcollectiontoy->deleteOne(["publisherID" => (int)$id]);
        return $result;
    }

    public function update($id, $updateData)
    {
        $result = $this->dbcollectiontoy->updateOne(
            ["publisherID" => (int)$id],
            ['$set' => $updateData]
        );
        return $result;
    }
}
