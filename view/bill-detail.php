<?php
// Import productController class
require_once('../controller/BillController.php');
require_once('../controller/BillDetailController.php');
require_once('../controller/UserController.php');
require_once('../controller/productController.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';
$controller = new BillController();
$result = $controller->getBillDetail((int)$id);

$controller = new BillDetailController();
$result1 = $controller->getAllBillDetail();

$controller1 = new UserController();

$controller = new ProductController();
$result3 = $controller->getAllProduct();
?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>THT ToyStore - Detail</title>
    <meta name="description" content="THT ToyStore - Detail">
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
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .card-body {
            padding: 2rem;
        }

        .container.mb-5.mt-3 {
            margin-top: 1.5rem;
            margin-bottom: 3rem;
        }

        .text-muted {
            color: #7e8d9f;
        }

        .text-muted span {
            color: #8f8061;
        }

        .text-center {
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .product-info {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .product-img {
            width: 100px;
            height: 100px;
        }

        .product-details {
            display: flex;
            flex-direction: column;
        }

        hr {
            border-top: 1px solid #dee2e6;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .ms-3 {
            margin-left: 1rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .float-start {
            float: left;
        }

        .text-black {
            color: #000;
        }

        .fw-bold {
            font-weight: bold;
        }

        .badge {
            border-radius: 15px;
            font-size: 0.8rem;
            padding: 0.5rem;
        }

        .bg-warning {
            background-color: #ffc107;
            color: #000;
        }

        ul.list-unstyled li {
            margin-bottom: 1rem;
        }

        ul.list-unstyled li:last-child {
            margin-bottom: 0;
        }
    </style>

</head>

<body>

    <?php include 'header.php' ?> <?php ?>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline" style="margin-bottom: 20px;">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Mã hóa đơn:
                            <strong><?php echo $result['billID'] ?></strong>
                        </p>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8">
                            <?php
                            $user = $controller1->getUserById($result['userID']);
                            echo '<ul class="list-unstyled">';
                            echo '<li class="text-muted">Họ và tên khách hàng:  <span style="color:#8f8061 ;">' . $user['userName'] . '</span></li>';
                            echo '<li class="text-muted"> Địa chỉ: ' . $result['billDeliveryAddress'] . '</li>';
                            echo '<li class="text-muted"> Phương thức thanh toán: ' . $result['billPaymentMethod'] . '</li>';
                            echo '</ul>';

                            $billDate = $result['billDate'];
                            $dateTime = (new DateTime())->setTimestamp($billDate->toDateTime()->getTimestamp());
                            $formattedDate = $dateTime->format('d/m/Y');
                            ?>
                        </div>
                        <div class="col-xl-4">

                            <ul class="list-unstyled">
                                <li class="text-muted">
                                    <i class="fa fa-circle" style="color:#8f8061 ;"></i>
                                    <span class="fw-bold">Ngày tạo hóa đơn: </span>
                                    <?php echo $formattedDate  ?>
                                </li>
                                <li class="text-muted">
                                    <i class="fa fa-circle" style="color:#8f8061 ;"></i>
                                    <span class="fw-bold">SĐT: </span>
                                    <?php echo $result['billPhoneNumber'] ?>
                                </li>
                                <li class="text-muted">
                                    <i class="fa fa-circle" style="color:#8f8061;"></i>
                                    <span class="me-1 fw-bold">Trạng thái:</span>
                                    <?php
                                    if ($result['billState'] == 'Chưa duyệt') {
                                        echo '<span class="badge badge-pending">' . $result['billState'] . '</span>';
                                    } else {
                                        echo '<span class="badge badge-complete">' . $result['billState'] . '</span>';
                                    }
                                    ?>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <?php foreach ($result1 as $document1) { ?>
                            <?php foreach ($result3 as $document3) { ?>
                                <?php if ($document1['productID'] == $document3['productID'] && $document1['billID'] == $result['billID']) { ?>
                                    <div class="card mb-3">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-md-4">
                                                <img src="<?php echo $document3['productImage'][0]; ?>" class="card-img" alt="Elegant shoes and shirt" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $document3['productName']; ?></h5>
                                                    <p class="card-text mb-0">
                                                        <span class="text-muted">Giá:</span> 
                                                        <?php echo  number_format($document3['productPrice'], 2, ",", "."). ' đ'; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php break; ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3"><strong>Ghi chú:</strong></p>
                            <p class="ms-3"><?php echo $result['billNote']  ?></p>
                        </div>
                        <div class="col-xl-3">
                            <p class="text-black float-start">
                                <span class="text-black me-3" style="margin-bottom:10px;"> Tổng tiền</span>
                                <?php echo number_format($result['total'], 2, ",", ".") . ' đ'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

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