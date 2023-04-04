<?php
require_once('../controller/UserController.php');
$controller = new UserController();
$controller->signIn();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
	<title>THT ToyStore - SignIn</title>
	<meta name="description" content="THT ToyStore - SignIn">

	<!-- This templates was made by Colorlib (https://colorlib.com) -->

	<!-- Font Icon -->
	<link rel="stylesheet" href="/resources/fonts/material-icon/css/material-design-iconic-font.min.css">

	<!-- Main css -->
	<link rel="stylesheet" href="/resources/css/style1.css">
</head>

<body>

	<div class="main" style="padding: 22px 0;">

		<!-- Sing in  Form -->
		<section class="sign-in">
			<div class="container">
				<div class="signin-content" style="padding-top: 50px;">
					<div class="signin-image">
						<figure>
							<img src="/resources/images/signin-image.jpg" alt="sing up image">
						</figure>
					</div>

					<div class="signin-form">
						<h2 class="form-title">Đăng Nhập</h2>
						<form method="POST" class="register-form" id="login-form">
							<p id="err" style="color: red; font-size: 12px;">
								<?php
								if (isset($_SESSION['error_message'])) {
									echo  $_SESSION['error_message'];
									unset($_SESSION['error_message']);
								}
								?>
							</p>
							<p id="err" style="color: red; font-size: 12px;"></p>
							<div class="form-group">
								<label for="your_email">
									<i class="zmdi zmdi-account material-icons-name"></i>
								</label>
								<input type="email" name="userEmail" id="your_email" placeholder="Nhập vào email của bạn" />
							</div>
							<div class="form-group">
								<label for="your_pass">
									<i class="zmdi zmdi-lock"></i>
								</label>
								<input type="password" name="userPassword" id="your_pass" placeholder="Nhập vào password của bạn" />
							</div>
							<div class="form-group">
								<a href="/view/forgot-password.php" style="margin-left: 200px;">
									Quên mật khẩu?
								</a>
							</div>
							<div class="form-group form-button">
								<input type="button" onclick="submitForm()" name="signin" id="signin" class="form-submit" value="Đăng Nhập" />
								<a href="/view/signup.php" class="form-submit" style="text-decoration: none; padding: 11px 45px; background-color: #42b72a;">
									Đăng ký
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- JS -->
	<script src="/resources/vendor/jquery/jquery.min.js"></script>
	<script src="resources/js/main.js"></script>
	<script>
		function submitForm() {
			var email = document.getElementById('your_email').value.trim();
			var pass = document.getElementById('your_pass').value.trim();
			if (email != "" && pass != "") {
				document.getElementById('login-form').submit();
			} else {
				document.getElementById('err').innerHTML = "*Vui lòng điền đầy đủ thông tin*";
			}
		}
	</script>
</body>

</html>