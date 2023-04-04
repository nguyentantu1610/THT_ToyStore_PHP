<?php
require_once('../controller/UserController.php');
require_once('../controller/ProductController.php');

$productController = new ProductController();

if (isset($_GET['categoryID'])) {
	$totalPage = $productController->getTotalProductPage($_GET['categoryID']);
	if (isset($_GET['pageNum'])) {
		$products = $productController->getProductPage($_GET['pageNum'], $_GET['categoryID']);
	} else {
		$products = $productController->getProductPage(1, $_GET['categoryID']);
	}
} else {
	$totalPage = $productController->getTotalProductPage(null);
	if (isset($_GET['pageNum'])) {
		$products = $productController->getProductPage($_GET['pageNum'], null);
	} else {
		$products = $productController->getProductPage(1, null);
	}
}

if (isset($_GET['cartID'])) {
	session_start();
	$product = $productController->getProductById($_GET['cartID']);
	$data = array(
		'productID' => $_GET['cartID'],
		'productName' => $product['productName'],
		'productImage' => $product['productImage'][0],
		'productPrice' => $product['productPrice'],
		'productQuantity' => 1
	);
	if (empty($_SESSION['cart'])) {
		$_SESSION['cart'][] = $data;
	} else {
		$state = false;
		foreach ($_SESSION['cart'] as $key => &$value) {
			if ($value['productID'] == $_GET['cartID']) {
				$state = true;
				if (($value['productQuantity'] + 1) <= $product['productStock']) {
					$value['productQuantity'] += 1;
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
	<!-- Basic -->
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
	<title>THT ToyStore - Home Page</title>
	<meta name="description" content="THT ToyStore - Home Page">

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

<body class="sub_page">

	<?php include 'header1.php' ?>

	<!-- product section -->
	<section class="product_section layout_padding" style="padding-top: 30px;">
		<div class="container">
			<div class="slideshow-container1">

				<div class="mySlides1 fade1">
					<div class="numbertext1">1 / 6</div>
					<img src="/resources/images/banner/banner1.jpg" style="width: 100%; height: 50vh;">
				</div>

				<div class="mySlides1 fade1">
					<div class="numbertext1">2 / 6</div>
					<img src="/resources/images/banner/banner2.jpg" style="width: 100%; height: 50vh;">
				</div>

				<div class="mySlides1 fade1">
					<div class="numbertext1">3 / 6</div>
					<img src="/resources/images/banner/banner3.jpg" style="width: 100%; height: 50vh;">
				</div>

				<div class="mySlides1 fade1">
					<div class="numbertext1">4 / 6</div>
					<img src="/resources/images/banner/banner4.jpg" style="width: 100%; height: 50vh;">
				</div>

				<div class="mySlides1 fade1">
					<div class="numbertext1">5 / 6</div>
					<img src="/resources/images/banner/banner5.jpg" style="width: 100%; height: 50vh;">
				</div>

				<div class="mySlides1 fade1">
					<div class="numbertext1">6 / 6</div>
					<img src="/resources/images/banner/banner6.jpg" style="width: 100%; height: 50vh;">
				</div>

				<a class="prev1" onclick="plusSlides(-1)">❮</a> <a class="next1" onclick="plusSlides(1)">❯</a>
			</div>
			<br>

			<div style="text-align: center">
				<span class="dot1" onclick="currentSlide(1)"></span> <span class="dot1" onclick="currentSlide(2)"></span> <span class="dot1" onclick="currentSlide(3)"></span> <span class="dot1" onclick="currentSlide(4)"></span> <span class="dot1" onclick="currentSlide(5)"></span> <span class="dot1" onclick="currentSlide(6)"></span>
			</div>

			<div class="heading_container heading_center" style="margin-top: 25px; margin-bottom: 0px;">
				<h2>Tất cả sản phẩm</h2>
			</div>

			<div class="row">

				<?php
				foreach ($products as $product) {
				?>
					<div class="col-sm-6 col-lg-3">
						<div class="box">
							<div class="img-box">
								<img src="<?php echo $product['productImage'][0] ?>" alt="image">
								<a onclick="addToCart(<?php echo $product['productID']; ?>)" class="add_cart_btn" style="cursor:pointer;">
									<span> Thêm vào giỏ hàng</span>
								</a>
							</div>
							<div class="detail-box">
								<h5>
									<a href="/view/product-details.php?productID=<?php echo $product['productID']; ?>">
										<?php echo $product['productName']; ?>
									</a>
								</h5>
								<div class="product_info">
									<h5>
										<span><?php echo number_format($product['productPrice'], 2, ",", ".") . ' đ'; ?></span>
									</h5>
									<div class="star_container">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
			<div class="btn_box">
				<ul class="pagination">
					<li class="page-item <?php echo $_SESSION['currentPage'] == 1 ? 'disabled' : '' ?>">
						<a class="page-link" href="?pageNum=<?php echo $_SESSION['currentPage'] - 1; ?>&&categoryID=<?php if (isset($_GET['categoryID'])) {
																														echo $_GET['categoryID'];
																													} ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>
					<li class="page-item active">
						<a class="page-link" href="?pageNum=<?php echo $_SESSION['currentPage']; ?>&&categoryID=<?php if (isset($_GET['categoryID'])) {
																													echo $_GET['categoryID'];
																												} ?>">
							<?php echo $_SESSION['currentPage']; ?>
						</a>
					</li>
					<li class="page-item <?php echo $_SESSION['currentPage'] == $totalPage ? 'disabled' : '' ?>">
						<a class="page-link" href="?pageNum=<?php echo $_SESSION['currentPage'] + 1; ?>&&categoryID=<?php if (isset($_GET['categoryID'])) {
																														echo $_GET['categoryID'];
																													} ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- end product section -->

	<?php include 'footer1.php' ?>
	<!-- jQery -->
	<script src="/resources/js/jquery-3.4.1.min.js"></script>
	<!-- bootstrap js -->
	<script src="/resources/js/bootstrap.js"></script>
	<!-- custom js -->
	<script src="/resources/js/custom.js"></script>

	<script>
		let slideIndex = 1;
		let slides = document.getElementsByClassName("mySlides1");
		let dots = document.getElementsByClassName("dot1");
		let i;
		showSlides(slideIndex);

		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			if (n > slides.length) {
				slideIndex = 1;
			}
			if (n < 1) {
				slideIndex = slides.length;
			}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active1", "");
			}
			slides[slideIndex - 1].style.display = "block";
			dots[slideIndex - 1].className += " active1";
		}

		function showSlides1() {
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			slideIndex++;
			if (slideIndex > slides.length) {
				slideIndex = 1
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active1", "");
			}
			slides[slideIndex - 1].style.display = "block";
			dots[slideIndex - 1].className += " active1";
			setTimeout(showSlides1, 5000); // Change image every 5 seconds
		}

		showSlides1();

		function addToCart(id) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "/view/index.php?cartID=" + id, true);
			xmlhttp.send();
		}
	</script>
</body>

</html>