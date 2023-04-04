<?php
class User
{
    private $userID;
    private $userName;
    private $userPhoneNumber;
    private $userAddress;
    private $userRole;
    private $userEmail;
    private $userPassword;

    public function __construct()
    {
    }
    public function GetUserID()
    {
        return $this->userID;
    }
    public function SetUserID($userID)
    {
        $this->userID = strtoupper($userID);
    }
    public function GetUserName()
    {
        return $this->userName;
    }
    public function SetUserName($userName)
    {
        $this->userName = strtoupper($userName);
    }
    public function GetUserPhoneNumber()
    {
        return $this->userPhoneNumber;
    }
    public function SetUserPhoneNumber($userPhoneNumber)
    {
        $this->userPhoneNumber = strtoupper($userPhoneNumber);
    }
    public function GetUserAddress()
    {
        return $this->userAddress;
    }
    public function SetUserAddress($userAddress)
    {
        $this->userAddress = strtoupper($userAddress);
    }
    public function GetUserRole()
    {
        return $this->userRole;
    }
    public function SetUserRole($userRole)
    {
        $this->userRole = strtoupper($userRole);
    }
    public function GetUserEmail()
    {
        return $this->userEmail;
    }
    public function SetUserEmail($userEmail)
    {
        $this->userEmail = strtoupper($userEmail);
    }
    public function GetUserPassword()
    {
        return $this->userPassword;
    }
    public function SetUserPassword($userPassword)
    {
        $this->userPassword = strtoupper($userPassword);
    }
}
