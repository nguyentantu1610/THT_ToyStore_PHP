<?php

require_once('../model/BillDetail.php');
require_once('../service/BillDetailService.php');
require_once('../phpconnectmongodb.php');

class BillDetailController
{
    private $billDetailService;

    public function __construct()
    {
        $this->billDetailService = new BillDetailService();
    }

    public function getAllBillDetail()
    {
        return $this->billDetailService->getAll();
    }

    public function countTop10Product()
    {
        return $this->billDetailService->countTopProducts();
    }
}
