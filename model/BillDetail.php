<?php
class BillDetail
{

    private $billID;
    private $productID;
    private $productQuantity;
    private $productCost;

    public function __construct()
    {
    }
    public function GetProductID()
    {
        return $this->productID;
    }
    public function SetProductID($productID)
    {
        $this->productID = strtoupper($productID);
    }
    public function GetBillID()
    {
        return $this->billID;
    }
    public function SetBillID($billID)
    {
        $this->billID = strtoupper($billID);
    }
    public function GetProductQuantity()
    {
        return $this->productQuantity;
    }
    public function SetProductQuantity($productQuantity)
    {
        $this->productQuantity = strtoupper($productQuantity);
    }
    public function GetProductCost()
    {
        return $this->productCost;
    }
    public function SetProductCost($productCost)
    {
        $this->productCost = strtoupper($productCost);
    }
}
