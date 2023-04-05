<?php
require_once('../controller/UserController.php');
require_once('../controller/ProductController.php');
require_once('../controller/PublisherController.php');

$id = isset($_GET['productID']) ? $_GET['productID'] : '';

$controller = new ProductController();
$product = $controller->getProductById($id);

$products = $controller->getAllProduct();

if (isset($_GET['cartID'])) {
	session_start();
	$qty = $_GET['qty'];
	$product = $controller->getProductById($_GET['cartID']);
	if ($qty > $product['productStock']) {
		$qty = $product['productStock'];
	} elseif ($qty <= 0) {
		$qty = 1;
	}
	$data = array(
		'productID' => $_GET['cartID'],
		'productName' => $product['productName'],
		'productImage' => $product['productImage'][0],
		'productPrice' => $product['productPrice'],
		'productQuantity' => $qty
	);
	if (empty($_SESSION['cart'])) {
		$_SESSION['cart'][] = $data;
	} else {
		$state = false;
		foreach ($_SESSION['cart'] as $key => &$value) {
			if ($value['productID'] == $_GET['cartID']) {
				$state = true;
				if (($value['productQuantity'] + $qty) <= $product['productStock']) {
					$value['productQuantity'] += $qty;
				} else {
					$value['productQuantity'] = $product['productStock'];
				}
				break;
			}
		}
		if (!$state) {
			$array = $_SESSION['cart'];
			array_push($array, $data);
			$_SESSION['cart'] = $array;
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
	<title>THT ToyStore - Product Detail</title>
	<meta name="description" content="THT ToyStore - Product Detail">

	<!-- Core Style CSS -->
	<link rel="stylesheet" href="/resources/css/core-style.css">
	<link rel="stylesheet" href="/resources/style.css">

	<!-- Responsive CSS -->
	<link href="/resources/css/responsive1.css" rel="stylesheet">

	<!-- bootstrap core css -->
	<link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.css" />
	<!-- fonts style -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- font awesome style -->
	<link href="/resources/css/font-awesome.min.css" rel="stylesheet" />
	<!-- Custom styles for this template -->
	<link href="/resources/css/style2.css" rel="stylesheet" />
	<!-- responsive style -->
	<link href="/resources/css/responsive.css" rel="stylesheet" />
	<style>
		.dropdown1 {
			float: left;
			overflow: hidden;
		}

		.dropdown1 .dropbtn1 {
			font-size: 16px;
			border: none;
			outline: none;
			color: white;
			background-color: inherit;
			font-family: inherit;
			margin: 0;
		}

		.dropdown1:hover .dropbtn1 {
			color: #f3c93e;
		}

		.dropdown1-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		.dropdown1-content a {
			float: none;
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
		}

		.dropdown1-content a:hover {
			background-color: #ddd;
			color: black;
		}

		.dropdown1:hover .dropdown1-content {
			display: block;
		}

		.mySlides1 {
			display: none
		}

		.mySlides1>img {
			border-radius: 8px;
			box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
		}

		/* Slideshow container */
		.slideshow-container1 {
			max-width: 1000px;
			position: relative;
			margin: auto;
		}

		/* Next & previous buttons */
		.prev1,
		.next1 {
			cursor: pointer;
			position: absolute;
			top: 50%;
			width: auto;
			padding: 16px;
			margin-top: -22px;
			color: white !important;
			font-weight: bold;
			font-size: 18px;
			transition: 0.6s ease;
			border-radius: 0 3px 3px 0;
			user-select: none;
		}

		/* Position the "next button" to the right */
		.next1 {
			right: 0;
			border-radius: 3px 0 0 3px;
		}

		/* On hover, add a black background color with a little bit see-through */
		.prev1:hover,
		.next1:hover {
			background-color: rgba(0, 0, 0, 0.8);
		}

		/* Number text (1/3 etc) */
		.numbertext1 {
			color: #f2f2f2;
			font-size: 12px;
			padding: 8px 12px;
			position: absolute;
			top: 0;
		}

		/* The dots/bullets/indicators */
		.dot1 {
			cursor: pointer;
			height: 15px;
			width: 15px;
			margin: 0 2px;
			background-color: #bbb;
			border-radius: 50%;
			display: inline-block;
			transition: background-color 0.6s ease;
		}

		.active1,
		.dot1:hover {
			background-color: #717171;
		}

		/* Fading animation */
		.fade1 {
			animation-name: fade;
			animation-duration: 1.5s;
		}
	</style>
</head>

<body>

	<div id="wrapper">

		<?php include 'header1.php' ?>

		<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
		<div class="breadcumb_area">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<ol class="breadcrumb d-flex align-items-center">
							<li class="breadcrumb-item"><a href="/view/index.php">Trang chủ
								</a></li>
							<li class="breadcrumb-item active"><?php echo $product['productName']; ?></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

		<!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
		<section class="single_product_details_area section_padding_0_100">
			<div class="container">
				<div class="row">

					<div class="col-12 col-md-6">
						<div class="single_product_thumb">
							<div id="product_details_slider" class="carousel slide" data-ride="carousel">

								<ol class="carousel-indicators">
									<?php
									$i = 0;
									foreach ($product['productImage'] as $image) {
										if ($i == 0) {
									?>
											<li class="active" data-target="#product_details_slider" data-slide-to="<?php echo $i ?>" style="background-image: url(<?php echo $product['productImage'][$i] ?>);"></li>
										<?php
										} else { ?>

											<li data-target="#product_details_slider" data-slide-to="<?php echo $i ?>" style="background-image: url(<?php echo $product['productImage'][$i] ?>);"></li>

									<?php
										}
										++$i;
									} ?>
								</ol>

								<div class="carousel-inner">
									<?php
									$i = 0;
									foreach ($product['productImage'] as $image) {
										if ($i == 0) {
									?>
											<div class="carousel-item active">
												<a class="gallery_img" href="<?php echo $product['productImage'][$i] ?>">
													<img class="d-block w-100" src="<?php echo $product['productImage'][$i] ?>" alt="First slide">
												</a>
											</div>
										<?php
										} else { ?>
											<div class="carousel-item">
												<a class="gallery_img" href="<?php echo $product['productImage'][$i] ?>">
													<img class="d-block w-100" src="<?php echo $product['productImage'][$i] ?>" alt="First slide">
												</a>
											</div>
									<?php
										}
										++$i;
									} ?>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-6">
						<div class="single_product_desc">
							<h2 style="font-weight: bold; margin-bottom: 30px;">
								<?php echo $product['productName'] ?>
							</h2>

							<div>
								<strong>Nhà cung cấp:</strong>
								<?php
								$publisherController = new PublisherController();
								$publisher = $publisherController->getPublisherById($product['publisherID']);
								echo $publisher['publisherName'];
								?>
							</div>

							<div>
								<h4 class="price" style="margin-top: 30px;">
									Giá: <?php echo number_format($product['productPrice'], 2, ",", ".") . ' đ'; ?>
								</h4>
							</div>

							<div class="single_product_ratings mb-15">
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>

							<!-- Add to Cart Form -->
							<form class="cart clearfix mb-50 d-flex" method="post" style="margin-bottom: 20px;" action="/webcomic/cart/?add">
								<input type="hidden" value="${product.productID}" name="productID">
								<div class="quantity">
									<span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) && qty != 1) effect.value--;return false;">
										<i class="fa fa-minus" aria-hidden="true"></i>
									</span>
									<input type="number" class="qty-text" id="qty" step="1" min="1" max="<?php echo $product['productStock']; ?>" name="quantity" value="1">
									<span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;">
										<i class="fa fa-plus" aria-hidden="true"></i></span>
								</div>
								<button type="button" onclick="addToCart(<?php echo $product['productID'] ?>)" name="addtocart" value="5" style="width: 200px;" class="btn cart-submit d-block">Thêm
									vào giỏ hàng</button>
							</form>

							<p class="available">
								Có sẵn: <span class="text-muted">
									<?php echo $product['productStock'] ?>
								</span>
							</p>

							<div id="accordion" role="tablist">
								<div class="card">
									<div class="card-header" role="tab" id="headingOne">
										<h6 class="mb-0">
											<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Nội dung
											</a>
										</h6>
									</div>

									<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
											<?php echo $product['productDescription'] ?>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

		<section class="you_may_like_area clearfix">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section_heading text-center">
							<h2>Các sản phẩm liên quan</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="you_make_like_slider owl-carousel">

							<?php
							foreach ($products as $item) {
							?>

								<!-- Single gallery Item -->
								<div class="single_gallery_item" style="width: 20vw;">
									<!-- Product Image -->
									<div class="product-img">
										<a href="/view/product-details.php?productID=<?php echo $item['productID'] ?>">
											<img src="<?php echo $item['productImage'][0]; ?>" style="width:30vw; height: 30vh;" alt="image">
										</a>
									</div>
									<!-- Product Description -->
									<div class="product-description">
										<h4 class="product-price"><?php echo number_format($item['productPrice'], 2, ",", ".") . ' đ'; ?></h4>
										<a href="/view/product-details.php?productID=<?php echo $item['productID'] ?>"><?php echo $item['productName'] ?></a>

										<a onclick="addToCart1(<?php echo $product['productID'] ?>)" class="add-to-cart-btn" style="margin-top: 15px;color: #ff084e; cursor:pointer;">
											Thêm vào giỏ hàng
										</a>
									</div>
								</div>
							<?php
							}
							?>

						</div>
					</div>
				</div>
			</div>
		</section>

		<?php include 'footer1.php' ?>
	</div>
	<!-- /.wrapper end -->

	<!-- jQuery (Necessary for All JavaScript Plugins) -->
	<script src="/resources/js/jquery/jquery-2.2.4.min.js"></script>
	<!-- Popper js -->
	<script src="/resources/js/popper.min.js"></script>
	<!-- Bootstrap js -->
	<script src="/resources/js/bootstrap.min.js"></script>
	<!-- Plugins js -->
	<script src="/resources/js/plugins.js"></script>
	<!-- Active js -->
	<script src="/resources/js/active.js"></script>

	<script>
		function addToCart(id) {
			var qty = document.getElementById('qty').value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "/view/product-details.php?cartID=" + id + "&&qty=" + qty, true);
			xmlhttp.send();
		}

		function addToCart1(id) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "/view/product-details.php?cartID=" + id + "&&qty=" + 1, true);
			xmlhttp.send();
		}
	</script>
</body>

</html>