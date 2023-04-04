<?php

require_once('../controller/ProductController.php');
require_once('../controller/CategoryController.php');

$controller = new ProductController();
$result = $controller->getAllProduct();

$controller = new CategoryController();
$result1 = $controller->getAllCategory();

if (isset($_GET['id'])) {
    $id =  $_GET['id'];
    $controller = new productController();
    $result2 = $controller->deleteProductById((int)$id);
}

if (isset($_GET["name"])) {
    if ($_GET["name"] == 'excel') {
        ob_clean();
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=products.csv');
        echo "\xEF\xBB\xBF";
        $file = fopen("php://output", "wb");
        $array = ['Mã sản phẩm', 'Mã nhà xuất bản', 'Mã danh mục', 'Tên sản phẩm', 'Giá', 'Số lượng tồn', 'Mô tả'];
        fputcsv($file, $array);
        foreach ($result as $product) {
            $array = [
                $product['productID'],
                $product['publisherID'],
                $product['categoryID'],
                $product['productName'],
                $product['productPrice'],
                $product['productStock'],
                $product['productDescription']
            ];
            fputcsv($file, $array);
        }

        fclose($file);
        //echo $array;
        die;
    }
}
?>

<!DOCTYPE html>

<html class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>THT ToyStore - Table</title>
    <meta name="description" content="THT ToyStore - Table">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="/resources/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/resources/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/resources/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

    <?php include 'header.php' ?>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Quản lý Sản phẩm</strong>
                            <div>
                                <a href="/view/create-product.php" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Thêm mới
                                </a>
                                <a href="/view/list-product.php?name=excel" class="btn btn-success btn-sm">
                                    <i class="fa fa-print"></i> In
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Danh mục</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $resultArray = $result->toArray();
                                    $resultArray1 = $result1->toArray();
                                    foreach ($resultArray as $document) {

                                        echo '<tr>';
                                        echo '<td>' . $document['productID'] . '</td>';
                                        echo '<td><img src="' . $document['productImage'][0] . '" width="100" height="100"></td>';
                                        echo '<td>' . $document['productName'] . '</td>';
                                        echo '<td>' . number_format($document['productPrice'], 0, ',', '.') . ' VND</td>';
                                        echo '<td>' . $document['productStock'] . '</td>';
                                        foreach ($resultArray1 as $document1) {
                                            if ($document['categoryID'] == $document1['categoryID']) {
                                                echo '<td>' . $document1['categoryName'] . '</td>';
                                                break;
                                            }
                                        }
                                        echo '<td>
                                            <a href="/view/edit-product-image.php?id=' . $document['productID'] . '"><i class="fa fa-picture-o"></i></a>
                                            <a href="/view/edit-product.php?id=' . $document['productID'] . '"><i class="fa fa-pencil"></i></a>
                                            <a href="/view/list-product.php?id=' . $document['productID'] . '">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>
    <?php include 'footer.php' ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="/resources/js/main.js"></script>
    <script src="/resources/js/lib/data-table/datatables.min.js"></script>
    <script src="/resources/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/resources/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/resources/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/resources/js/lib/data-table/jszip.min.js"></script>
    <script src="/resources/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/resources/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/resources/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/resources/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/resources/js/init/datatables-init.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>

</body>

</html>