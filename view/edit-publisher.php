<?php
require_once('../controller/PublisherController.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';
$controller = new PublisherController();
$result = $controller->getPublisherById((int)$id);
$controller->updatePublisherById((int)$id);
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

<body>

    <?php include 'header.php' ?>

    <div class="content" style="background-color: inherit;">
        <div class="animated fadeIn">
            <div class="row">
                <div class="card" style="width: 100%; margin: 14px;">
                    <div class="card-header">
                        <strong>Cập nhật nhà sản xuất</strong>
                    </div>
                    <form method="post" id="insert-form" accept-charset="UTF-8">
                        <input readonly value="<?php echo $result['publisherID'] ?>" type="hidden" name="publisherID" id="publisherID" class="form-control">
                        <div class="card-body card-block">
                            <div class="form-group" style="width: 40%;">
                                <label for="publisherName" class=" form-control-label">
                                    Tên nhà sản xuất
                                </label>
                                <label style="color: red;">(*)</label>
                                <input type="text" name="publisherName" id="publisherName" class="form-control" 
                                   value=" <?php echo $result['publisherName'] ?> "
                                    placeholder="Vui lòng nhập tên nhà sản xuất"  required>
                            </div>
                            <button type="submit" class="btn btn-warning">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <?php include 'footer.php' ?>
</body>

</html>