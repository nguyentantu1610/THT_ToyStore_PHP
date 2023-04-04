<?php
class Category
{
    private $categoryID;
    private $categoryName;
    public function __construct()
    {
    }
    public function GetCategoryName()
    {
        return $this->categoryName;
    }
    public function SetCategoryName($categoryName)
    {
        $this->categoryName = strtoupper($categoryName);
    }
    public function GetCategoryID()
    {
        return $this->categoryID;
    }
    public function SetCategoryID($categoryID)
    {
        $this->categoryID = strtoupper($categoryID);
    }
}
