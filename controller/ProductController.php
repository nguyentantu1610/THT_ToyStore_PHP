<?php

require_once('../model/Product.php');
require_once('../service/ProductService.php');
require_once('../phpconnectmongodb.php');

class ProductController
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function getAllProduct()
    {
        return $this->productService->getAll();
    }

    public function getProductPage($pageNum, $categoryID)
    {
        $_SESSION['currentPage'] = $pageNum;
        return $this->productService->getPage($pageNum, $categoryID);
    }

    public function getTotalProductPage($categoryID) {
        $pageSize = 2;
        $count = 0;
        if ($categoryID != null) {
            $result = $this->productService->getAllByCategoryID($categoryID);
        }
        else {
            $result = $this->productService->getAll();
        }
        foreach ($result as $r) {
            $count++;
        }
        return ceil($count / $pageSize);
    }

    public function getProductById($id)
    {
        return $this->productService->findOneByID($id);
    }

    public function deleteProductById($id)
    {
        header('Location:../view/list-product.php');
        return $this->productService->delete($id);
    }

    public function updateProductById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = array('http://localhost:3000/resources/images/default-product-image.png');
            $data = array(
                'productName' => ($_POST['productName']),
                'productPrice' => $_POST['productPrice'],
                'productImage' =>  $image,
                'productDescription' => $_POST['productDescription'],
                'productStock' => $_POST['productStock'],
                'categoryID' => (int)$_POST['categoryID'],
                'publisherID' => (int)$_POST['publisherID']
            );
            header('Location:../view/list-product.php');
            // Update thông tin sản phẩm vào MongoDB
            return  $this->productService->update($id, $data);
        }
    }

    public function updateProductImageById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = $this->productService->findOneByID($id);
            $removeImages = explode('@', $_POST['removeImages']);
            $newImages = explode('@', $_POST['newImages']);
            $images = [];
            if ($newImages != null && $newImages != "") {
                for ($i = 0; $i < count($newImages) - 1; $i++) {
                    array_push($images, $newImages[$i]);
                }
            }
            if ($removeImages != null && $removeImages != "") {
                foreach ($product['productImage'] as $image) {
                    if (!in_array($image, $removeImages)) {
                        array_push($images, $image);
                    }
                }
            } else {
                foreach ($product['productImage'] as $image) {
                    array_push($images, $image);
                }
            }
            $data = array(
                'productName' => $product['productName'],
                'productPrice' => $product['productPrice'],
                'productImage' =>  $images,
                'productDescription' => $product['productDescription'],
                'productStock' => $product['productStock'],
                'categoryID' => (int)$product['categoryID'],
                'publisherID' => (int)$product['publisherID']
            );
            header('Location:../view/list-product.php');
            // Update thông tin sản phẩm vào MongoDB
            return  $this->productService->update($id, $data);
        }
    }

    public function createProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $image = array('http://localhost:3000/resources/images/default-product-image.png');
            $product = array(
                'productName' => ($_POST['productName']),
                'productPrice' => $_POST['productPrice'],
                'productImage' => $image,
                'productDescription' => trim($_POST['productDescription']),
                'productStock' => $_POST['productStock'],
                'categoryID' => (int)$_POST['categoryID'],
                'publisherID' => (int)$_POST['publisherID']
            );
            header('Location:../view/list-product.php');
            return  $this->productService->create($product);
        }
    }
    
    public function getStockIn()
    {
        return $this->productService->getTopProducts();
    }

    public function createProductWithExcel($product)
    {
        return  $this->productService->create($product);
    }
}
