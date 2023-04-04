<?php

class Product
{

  private $productID;
  private $productName;
  private $productStock;
  private $productPrice;
  private $categoryID;
  private $productImage;
  private $productDescription;
  private $publisherID;
  
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
  public function GetProductName()
  {
    return $this->productName;
  }
  public function SetProductName($productName)
  {
    $this->productName = strtoupper($productName);
  }
  public function GetProductDescription()
  {
    return $this->productDescription;
  }
  public function SetProductDescription($productDescription)
  {
    $this->productDescription = strtoupper($productDescription);
  }
  public function GetProductImage()
  {
    return $this->productImage;
  }
  public function SetProductImage($productImage)
  {
    $this->productImage = strtoupper($productImage);
  }

  public function GetProductPrice()
  {
    return $this->productPrice;
  }
  public function SetProductPrice($productPrice)
  {
    $this->productPrice = strtoupper($productPrice);
  }
  public function GetProductStock()
  {
    return $this->productStock;
  }
  public function SetProductStock($productStock)
  {
    $this->productStock = strtoupper($productStock);
  }
  public function GetCategoryID()
  {
    return $this->categoryID;
  }
  public function SetCategoryID($categoryID)
  {
    $this->categoryID = strtoupper($categoryID);
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
