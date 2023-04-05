<?php

require_once('../model/Bill.php');
require_once('../service/BillService.php');
require_once('../model/BillDetail.php');
require_once('../service/BillDetailService.php');
require_once('../phpconnectmongodb.php');

class BillController
{
    private $billService;
    private $billDetailService;

    public function __construct()
    {
        $this->billService = new BillService();
    }

    public function getAllBill()
    {
        return $this->billService->getAll();
    }

    public function getBillDetail($id)
    {
        return $this->billService->findOneByID($id);
    }

    public function totalMoney()
    {
        return $this->billService->calculateTotalAmount();
    }

    public function totalBill()
    {
        return $this->billService->countBillsThisMonth();
    }

    public function createBill()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = unserialize($_SESSION["user"]);
            $total = 0;
            $this->billDetailService  = new BillDetailService();
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['productQuantity'] * $item['productPrice'];
                $dt = array(
                    'billID' => $this->billService->getNextID(),
                    'productID' => (int)$item['productID'],
                    'productQuantity' => (int)$item['productQuantity'],
                    'productCost' => (int)$item['productPrice']
                );
                $this->billDetailService->create($dt);
            }
            date_default_timezone_set("Asia/Saigon");
            $data = array(
                'billPaymentMethod' => "Thanh toán khi giao hàng",
                'billNote' => "Cẩn thận, hàng dễ vỡ!!!",
                'billDate' => date('m/d/Y h:i:s a', time()),
                'total' => $total,
                'userID' => $user['userID'],
                'billPhoneNumber' => (int)$_POST['userPhoneNumber'],
                'billState' => "Chờ duyệt",
                'billDeliveryAddress' => $_POST['userAddress'],
            );
            unset($_SESSION['cart']);
            header('Location:../view/index.php');
            return  $this->billService->create($data);
        }
    }
}
