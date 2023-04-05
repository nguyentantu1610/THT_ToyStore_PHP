 <?php

  require_once('../model/Product.php');
  require_once('../phpconnectmongodb.php');
  require_once '../vendor/autoload.php'; // path to PHPExcel library autoload file

  class ProductService
  {
    private  $dbcollectiontoy;

    public function __construct()
    {
      $this->dbcollectiontoy  = Getmongodb("dbwebtoystore", "Product");
    }

    public function getAll()
    {
      $result = $this->dbcollectiontoy->find([]);
      return $result;
    }

    public function getAllByCategoryID($categoryID)
    {
      $result = $this->dbcollectiontoy->find(['categoryID' => (int)$categoryID]);
      return $result;
    }

    public function getPage($pageNum, $categoryID)
    {
      $pageSize = 8;
      $start = ($pageNum - 1) * $pageSize;
      $options = [
        'skip' => $start,
        'limit' => $pageSize
      ];
      if ($categoryID != null) {
        $result = $this->dbcollectiontoy->find(['categoryID' => (int)$categoryID], $options);
        return $result;
      } else {
        $result = $this->dbcollectiontoy->find([], $options);
        return $result;
      }
    }

    public function getTopProducts($limit = 10)
    {
      $pipeline = [
        ['$sort' => ['productStock' => -1]],
        ['$limit' => $limit]
      ];
      $result = $this->dbcollectiontoy->aggregate($pipeline);
      return $result;
    }

    public function findOneByID($id)
    {
      $toy = $this->dbcollectiontoy->findOne(["productID" => (int)$id]);
      return $toy;
    }

    public function getNextID()
    {
      try {
        $lastProduct = $this->dbcollectiontoy->findOne([], ['sort' => ['productID' => -1]]);
        $lastProductId = 1;

        if ($lastProduct !== null) {
          $lastProductId = $lastProduct['productID'];
        }
        return $lastProductId + 1;
      } catch (Exception $e) {
        // Handle the exception here
        echo "Error: " . $e->getMessage();
        exit;
      }
    }

    public function create($product)
    {
      $product['productID'] = $this->getNextID();
      $result = $this->dbcollectiontoy->insertOne($product);
      return $result;
    }

    public function delete($id)
    {
      $result = $this->dbcollectiontoy->deleteOne(["productID" => (int)$id]);
      return $result;
    }

    public function update($id, $updateData)
    {
      $result = $this->dbcollectiontoy->updateOne(
        ["productID" => (int)$id],
        ['$set' => $updateData]
      );
      return $result;
    }
  }
  ?>

