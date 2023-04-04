<?php
class Publisher
{
    private $publisherID;
    private $publisherName;

    public function __construct()
    {
    }
    public function GetPublisherName()
    {
        return $this->publisherName;
    }
    public function SetPublisherName($publisherName)
    {
        $this->publisherName = strtoupper($publisherName);
    }
    public function GetPublisherID()
    {
        return $this->publisherID;
    }
    public function SetPublisherID($publisherID)
    {
        $this->publisherID = strtoupper($publisherID);
    }
}
