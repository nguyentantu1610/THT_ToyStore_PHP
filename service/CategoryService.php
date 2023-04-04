<?php

require_once('../model/Category.php');
require_once('../phpconnectmongodb.php');

class CategoryService
{
    private  $dbcollectiontoy;

    public function __construct()
    {
        $this->dbcollectiontoy  = Getmongodb("dbwebtoystore", "Category");
    }
    public function getAll()
    {
        $result = $this->dbcollectiontoy->find([]);
        return $result;
    }

    // C
    public function findOneByID($id)
    {
        $toy = $this->dbcollectiontoy->findOne(["categoryID" => (int)$id]);
        return $toy;
    }

    public function getNextID()
    {
        try {
            $lastProduct = $this->dbcollectiontoy->findOne([], ['sort' => ['categoryID' => -1]]);
            $lastProductId = 1;

            if ($lastProduct !== null) {
                $lastProductId = $lastProduct['categoryID'];
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
        $category['categoryID'] = $this->getNextID();
        $result = $this->dbcollectiontoy->insertOne($category);
        return $result;
    }
    
    public function delete($id)
    {
        $result = $this->dbcollectiontoy->deleteOne(["categoryID" => (int)$id]);
        return $result;
    }

    public function update($id, $updateData)
    {
        $result = $this->dbcollectiontoy->updateOne(
            ["categoryID" => (int)$id],
            ['$set' => $updateData]
        );
        return $result;
    }
}
