<?php

require_once('../model/Category.php');
require_once('../service/CategoryService.php');
require_once('../phpconnectmongodb.php');

class CategoryController
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new categoryService();
    }

    public function getAllCategory()
    {
        return $this->categoryService->getAll();
    }

    public function getCategoryById($id)
    {

        return $this->categoryService->findOneByID($id);
    }

    public function deleteCategoryById($id)
    {
        header('Location:../view/list-category.php');
        return $this->categoryService->delete($id);
    }

    public function updateCategoryById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'categoryName' => ($_POST['categoryName']),
            );
            header('Location:../view/list-category.php');
            return  $this->categoryService->update($id, $data);
        }
    }

    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'categoryName' => ($_POST['categoryName']),
            );
            header('Location:../view/list-category.php');
            return  $this->categoryService->create($data);
        }
    }
}
