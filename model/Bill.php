<?php
class Bill
{

    private $billID;
    private $billDate;
    private $billNote;
    private $billPaymentMethod;
    private $total;
    private $userID;
    private $billPhoneNumber;
    private $billState;
    private $billDeliveryAddress;

    public function __construct()
    {
    }
    public function GetBillID()
    {
        return $this->billID;
    }
    public function SetBillID($billID)
    {
        $this->billID = strtoupper($billID);
    }
    public function GetBillDate()
    {
        return $this->billDate;
    }
    public function SetBillDate($billDate)
    {
        $this->billDate = strtoupper($billDate);
    }
    public function GetBillNote()
    {
        return $this->billNote;
    }
    public function SetBillNote($billNote)
    {
        $this->billNote = strtoupper($billNote);
    }
    public function GetBillPaymentMethod()
    {
        return $this->billPaymentMethod;
    }
    public function SetBillPaymentMethod($billPaymentMethod)
    {
        $this->billPaymentMethod = strtoupper($billPaymentMethod);
    }
    public function GetTotal()
    {
        return $this->total;
    }
    public function SetTotal($total)
    {
        $this->total = strtoupper($total);
    }
    public function GetUserID()
    {
        return $this->userID;
    }
    public function SetUserID($userID)
    {
        $this->userID = strtoupper($userID);
    }
    public function GetBillPhoneNumber()
    {
        return $this->billPhoneNumber;
    }
    public function SetBillPhoneNumber($billPhoneNumber)
    {
        $this->billPhoneNumber = strtoupper($billPhoneNumber);
    }
    public function GetBillState()
    {
        return $this->billState;
    }
    public function SetBillState($billState)
    {
        $this->billState = strtoupper($billState);
    }
    public function GetBillDeliveryAddress()
    {
        return $this->billDeliveryAddress;
    }
    public function SetBillDeliveryAddress($billDeliveryAddress)
    {
        $this->billDeliveryAddress = strtoupper($billDeliveryAddress);
    }
}
