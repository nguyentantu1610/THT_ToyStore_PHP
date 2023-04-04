
    <?php

    require_once '../vendor/Classes/PHPExcel.php';
    require_once('../controller/ProductController.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_FILES["file"] != null) {
            $file =  $_FILES["file"]["tmp_name"];
            $reader = PHPExcel_IOFactory::createReaderForFile($file);

            $workbook = $reader->load($file);

            $worksheet = $workbook->getSheet('0');

            $lastRow = $worksheet->getHighestRow();

            for ($i = 2; $i <= $lastRow; $i++) {
                $image = array('http://localhost:3000/resources/images/default-product-image.png');
                $product = array(
                    'productName' => $worksheet->getCell('D' . $i)->getValue(),
                    'productPrice' => $worksheet->getCell('E' . $i)->getValue(),
                    'productImage' => $image,
                    'productDescription' => $worksheet->getCell('G' . $i)->getValue(),
                    'productStock' => $worksheet->getCell('F' . $i)->getValue(),
                    'categoryID' => (int)$worksheet->getCell('C' . $i)->getValue(),
                    'publisherID' => (int)$worksheet->getCell('B' . $i)->getValue()
                );
                $controller = new ProductController();
                $controller->createProductWithExcel($product);
            }
        }
        header('Location:../view/list-product.php');
    }
    ?>