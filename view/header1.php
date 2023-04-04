<?php
require_once('../controller/CategoryController.php');
require_once('../controller/ProductController.php');

$controller = new CategoryController();
$result = $controller->getAllCategory();

if (isset($_GET['name'])) {
	if ($_GET['name'] == 'logout') {
		session_start();
		session_destroy();
		session_unset();
		header('Location:../view/signin.php');
	}
}

if (isset($_GET['q'])) {

	$productController = new ProductController();
	$result1 = $productController->getAllProduct();

	$q = $_GET['q'];
	if ($q !== "") {
		$q = strtolower($q);
		$len = strlen($q);
		foreach ($result1 as $product) {
			if (stristr($q, substr($product['productName'], 0, $len))) {
				echo '<a href="/view/product-details.php?productID=' . $product['productID'] . '">'
					. '<img style="width:10vw; height:10vh;" src="' . $product['productImage'][0] . '"/>'
					. $product['productName']
					. '</a>';
			}
		}
	}
	die;
}
?>
<div class="hero_area" style="min-height: auto;">
	<!-- header section strats -->
	<header class="header_section">
		<div class="header_top">
			<div class="container-fluid">
				<div class="top_nav_container">
					<div class="contact_nav">
						<a href="/view/index.php" style="margin-right: 35px;">
							<span> Trang chủ </span>
						</a>
						<div class="dropdown1">
							<button class="dropbtn1">
								Danh mục <i class="fa fa-caret-down"></i>
							</button>
							<div class="dropdown1-content">
								<?php
								foreach ($result as $category) {
									echo '<a href="/view/index.php?categoryID=' . $category['categoryID'] . '">' . $category['categoryName'] . '</a>';
								}
								?>
							</div>
						</div>
					</div>
					<div class="dropdown1">
						<input type="text" id="search" name="search" onkeyup="searchFunction(this.value)" style="width: 500px;" class="form-control" placeholder="Nhập tên cuốn sách bạn muốn tìm...">
						<div class="dropdown1-content" id="search-content">

						</div>
					</div>

					<div class="user_option_box">
						<?php
						if (!isset($_SESSION["user"])) { ?>
							<a href="/view/signin.php" class="account-link">
								<i class="fa fa-user" aria-hidden="true"></i>
								<span> Tài khoản </span> </a>
						<?php } ?>
						<?php
						if (isset($_SESSION["user"])) { ?>
							<div class="dropdown1">
								<button class="dropbtn1">
									<i class="fa fa-user" aria-hidden="true"></i>
									<?php
									$user = unserialize($_SESSION["user"]);
									echo ($user['userEmail']);
									?> <i class="fa fa-caret-down"></i>
								</button>
								<div class="dropdown1-content">
									<a href="/view/account.php">Thông tin</a>
									<a href="/view/header1.php?name=logout">Đăng xuất</a>
								</div>
							</div>
						<?php } ?>
						<a href="/view/cart.php" class="cart-link">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							<span> Giỏ hàng </span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end header section -->
</div>
<script>
	function searchFunction(str) {
		if (str == "") {
			document.getElementById("search-content").innerHTML = "";
			return;
		}
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("search-content").innerHTML = this.responseText;
			}
		}
		xmlhttp.open("GET", "/view/header1.php?q=" + str, true);
		xmlhttp.send();
	}
</script>