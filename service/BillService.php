<?php

require_once('../model/Bill.php');
require_once('../phpconnectmongodb.php');

class BillService
{
    private  $dbcollectiontoy;

    public function __construct()
    {
        $this->dbcollectiontoy  = Getmongodb("dbwebtoystore", "Bill");
    }
    public function getAll()
    {
        $result = $this->dbcollectiontoy->find([]);
        return $result;
    }

    public function findOneByID($id)
    {
        $Bill = $this->dbcollectiontoy->findOne(["billID" => (int)$id]);
        return $Bill;
    }

    public function calculateTotalAmount()
    {
        $totalAmount = 0;

        $cursor = $this->dbcollectiontoy->find([]);

        foreach ($cursor as $document) {
            $totalAmount += $document['total'];
        }

        return $totalAmount;
    }

    public function countBillsThisMonth()
    {
        $filter = [];

        // Count the number of Bills
        $count = $this->dbcollectiontoy->countDocuments($filter);

        return $count;
    }

    public function getNextID()
    {
        try {
            $lastProduct = $this->dbcollectiontoy->findOne([], ['sort' => ['billID' => -1]]);
            $lastProductId = 1;

            if ($lastProduct !== null) {
                $lastProductId = $lastProduct['billID'];
            }

            return $lastProductId + 1;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function create($bill)
    {
        $bill['billID'] = $this->getNextID();
        $result = $this->dbcollectiontoy->insertOne($bill);
        return $result;
    }
}
