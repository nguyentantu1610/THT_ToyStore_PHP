<?php
require_once('../controller/ProductController.php');
require_once('../controller/CategoryController.php');
require_once('../controller/PublisherController.php');

$controller = new CategoryController();
$categories = $controller->getAllCategory();

$controller = new PublisherController();
$publishers = $controller->getAllPublisher();

$controller = new ProductController();
$controller->createProduct();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>THT ToyStore - Form</title>
    <meta name="description" content="THT ToyStore - Form">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="/resources/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/resources/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
</head>

<body>

    <?php include 'header.php' ?>

    <div class="content" style="background-color: inherit;">
        <div class="animated fadeIn">

            <div class="row">
                <div class="card" style="width: 100%; margin: 14px;">
                    <div class="card-header">
                        <strong>Thêm sản phẩm</strong>
                    </div>
                    <form method="post" id="insert-form" accept-charset="UTF-8">
                        <div class="card-body card-block">
                            <div class="form-group" style="width: 45%; float: left; margin-right: 5%;">
                                <label for="productName" class=" form-control-label">Tên sản phẩm</label>
                                <label style="color: red;">(*)</label>
                                <input type="text" name="productName" id="productName" placeholder="Vui lòng nhập tên sản phẩm" class="form-control" required>
                            </div>
                            <div class="form-group" style="width: 45%; float: left; margin-right: 5%;">
                                <label for="productPrice" class=" form-control-label">Giá</label>
                                <label style="color: red;">(*)</label>
                                <input type="number" name="productPrice" id="productPrice" placeholder="Vui lòng nhập giá" class="form-control" required>
                            </div>
                            <div class="form-group" style="width: 45%; float: left; margin-right: 5%;">
                                <label for="productStock" class=" form-control-label">Số lượng tồn</label>
                                <label style="color: red;">(*)</label>
                                <input type="number" name="productStock" id="productStock" placeholder="Vui lòng nhập số lượng tồn" class="form-control" required>
                            </div>
                            <div class="form-group" style="width: 45%; float: left; margin-right: 5%;">
                                <label for="categoryID" class=" form-control-label">Danh mục</label>
                                <label style="color: red;">(*)</label>
                                <select name="categoryID" id="categoryID" class="form-control">
                                    <?php
                                    foreach ($categories as $item) {
                                        echo '<option value="' . $item['categoryID'] . '">' . $item['categoryName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="width: 45%; float: left; margin-right: 5%;">
                                <label for="productDescription" class=" form-control-label">Mô tả</label>
                                <label style="color: red;">(*)</label>
                                <textarea name="productDescription" id="productDescription" rows="9" placeholder="Content..." class="form-control">

                                </textarea>
                            </div>
                            <div class="form-group" style="width: 45%; float: left; margin-right: 5%;">
                                <label for="publisherID" class=" form-control-label">Nhà cung cấp</label>
                                <label style="color: red;">(*)</label>
                                <select name="publisherID" id="publisherID" class="form-control">
                                    <?php
                                    foreach ($publishers as $item) {
                                        echo '<option value="' . $item['publisherID'] . '">' . $item['publisherName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                    <div class="form-group" style="margin-left: 3%;">
                        <form method="post" action="/view/excel.php" enctype="multipart/form-data">
                            <label for="file" class=" form-control-label">Chọn file excel &nbsp;</label>
                            <input type="file" name="file" id="file" accept=".csv">
                            <br /> <br />
                            <button type="submit" class="btn btn-success">
                                Thêm Excel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="/resources/js/main.js"></script>

</body>

</html>