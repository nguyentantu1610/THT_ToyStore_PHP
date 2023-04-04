<?php
require_once('../controller/UserController.php');
require_once('../controller/ProductController.php');

$controller = new ProductController();

if (isset($_GET['name'])) {
	session_start();
	unset($_SESSION['cart']);
	header('Location:../view/cart.php');
}

if (isset($_GET['cartID'])) {
	session_start();
	$qty = $_GET['qty'];
	$product = $controller->getProductById($_GET['cartID']);

	foreach ($_SESSION['cart'] as $key => &$value) {
		if ($value['productID'] == $_GET['cartID']) {
			$state = true;
			$plus = ($value['productQuantity'] + $qty);
			if ($plus <= $product['productStock'] && $plus > 0) {
				$value['productQuantity'] += $qty;
			} elseif ($plus >= $product['productStock']) {
				$value['productQuantity'] = $product['productStock'];
			}
			break;
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="description" content="THTV BookStore - Cart">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
	<title>THT ToyStore - Cart</title>
	<meta name="description" content="THT ToyStore - Cart">


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

		<!-- ****** Cart Area Start ****** -->
		<div class="cart_area section_padding_100 clearfix">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="cart-table clearfix">
							<table class="table table-responsive">
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th>Giá</th>
										<th>Số lượng</th>
										<th>Tổng tiền</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (isset($_SESSION['cart'])) {
										$count = 0;
										foreach ($_SESSION['cart'] as $item) {
									?>
											<tr>
												<td class="cart_product_img d-flex align-items-center">
													<a href="#">
														<img src="<?php echo $item['productImage']; ?>" alt="Product">
													</a>
													<h6><?php echo $item['productName']; ?></h6>
												</td>
												<td class="price">
													<span>
														<?php echo number_format($item['productPrice'], 2, ",", ".") . ' đ'; ?>
													</span>
												</td>
												<td class="qty">
													<div class="quantity">
														<span class="qty-minus" style="width: 20px;" onclick="addToCart(-1,<?php echo $count; ?>, <?php echo $item['productID']; ?>, <?php echo $item['productPrice']; ?>)">
															<i class="fa fa-minus" aria-hidden="true"></i>
														</span>
														<input type="number" class="qty-text" id="qty<?php echo $count; ?>" step="1" min="1" max="99" style="width: 40px;" name="quantity" style="width: 40px;" value="<?php echo $item['productQuantity']; ?>">
														<span class="qty-plus" style="width: 20px;" onclick="addToCart(1,<?php echo $count; ?>, <?php echo $item['productID']; ?>, <?php echo $item['productPrice']; ?>)">
															<i class="fa fa-plus" aria-hidden="true"></i></span>
													</div>
												</td>
												<td class="total_price">
													<span id="total<?php echo $count; ?>">
														<?php echo number_format($item['productPrice'] * $item['productQuantity'], 2, ",", ".") . ' đ'; ?>
													</span>
												</td>
											</tr>
									<?php
											++$count;
										}
									}
									?>
								</tbody>
							</table>
						</div>

						<div class="cart-footer d-flex mt-30">
							<div class="back-to-shop w-50">
								<a href="/view/index.php">Tiếp tục mua sắm</a>
							</div>
							<div class="update-checkout w-50 text-right">
								<a href="/view/cart.php?name=delete">Xoá giỏ hàng</a>
							</div>
						</div>

					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-4">
						<div class="cart-total-area mt-70">
							<?php
							if (isset($_SESSION['cart'])) { ?>
								<a href="/view/checkout.php" class="btn karl-checkout-btn" style="background-color: #ff084e; color: white; padding-top: 15px; font-weight: bold;">
									Thanh Toán</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ****** Cart Area End ****** -->

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
		function addToCart(num, index, id, price) {
			var effect = document.getElementById('qty' + index);
			let qty = effect.value;
			let x = num + parseInt(qty, 10);
			if (!isNaN(x) && x > 0) {
				effect.value = x;
				let total = document.getElementById('total' + index);
				total.innerHTML = (x * price) + "đ";
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", "/view/cart.php?cartID=" + id + "&&qty=" + num, true);
				xmlhttp.send();
			}
		}
	</script>
</body>

</html>