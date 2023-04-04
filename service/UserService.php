<?php

require_once('../model/User.php');
require_once('../phpconnectmongodb.php');

class UserService
{
    private  $dbcollectiontoy;

    public function __construct()
    {
        $this->dbcollectiontoy  = Getmongodb("dbwebtoystore", "User");
    }

    public function getAll()
    {
        $result = $this->dbcollectiontoy->find([]);
        return $result;
    }

    public function countUser()
    {
        $result = $this->dbcollectiontoy->countDocuments();
        return $result;
    }

    // C
    public function findOneById($id)
    {
        $toy = $this->dbcollectiontoy->findOne(["userID" => (int)$id]);
        return $toy;
    }

    public function findOneByEmail($email)
    {
        $toy = $this->dbcollectiontoy->findOne(["userEmail" => $email]);
        return $toy;
    }

    public function getNextID()
    {
        try {
            $lastProduct = $this->dbcollectiontoy->findOne([], ['sort' => ['userID' => -1]]);
            $lastProductId = 1;

            if ($lastProduct !== null) {
                $lastProductId = $lastProduct['userID'];
            }

            return $lastProductId + 1;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function create($product)
    {
        $product['userID'] = $this->getNextID();
        $result = $this->dbcollectiontoy->insertOne($product);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->dbcollectiontoy->deleteOne(["userID" => (int)$id]);
        return $result;
    }

    public function update($id, $updateData)
    {
        $result = $this->dbcollectiontoy->updateOne(
            ["userID" => (int)$id],
            ['$set' => $updateData]
        );
        return $result;
    }
}
