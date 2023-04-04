 <?php
    require_once('../controller/BillController.php');
    require_once('../controller/UserController.php');

    $controller = new BillController();
    $result = $controller->getAllBill();

    $controller = new UserController();
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
                             <strong class="card-title">Quản lý đơn hàng</strong>
                         </div>
                         <div class="card-body">
                             <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Mã</th>
                                         <th>Khách hàng</th>
                                         <th>Ngày</th>
                                         <th>SĐT</th>
                                         <th>Tổng tiền</th>
                                         <th>Trạng thái</th>
                                         <th></th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        foreach ($result as $document) {
                                            echo '<tr>';
                                            echo '<td>' . $document['billID'] . '</td>';
                                            $user = $controller->getUserById($document['userID']);
                                            echo '<td>' . $user['userName'] . '</td>';
                                            $billDate = $document['billDate'];
                                            // Check if the date string is in the correct format
                                            $billDate = $document['billDate'];
                                            $dateTime = (new DateTime())->setTimestamp($billDate->toDateTime()->getTimestamp());
                                            $formattedDate = $dateTime->format('d/m/Y');
                                            echo '<td>' . $formattedDate . '</td>';
                                            echo '<td>' . $document['billPhoneNumber'] . '</td>';
                                            echo '<td>' . number_format($document['total'],2,",",".") . ' đ</td>';
                                            echo '<td>' . $document['billState'] . '</td>';
                                            echo '<td><a href="/view/bill-detail.php?id=' . $document['billID'] . '"><i class="fa fa-info-circle"></i></a> </td>';
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