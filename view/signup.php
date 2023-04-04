<?php
require_once('../controller/UserController.php');
$controller = new UserController();
$controller->signUp();
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

		<!-- Sign up form -->
		<section class="signup">
			<div class="container">
				<div class="signup-content" style="padding-top: 50px;">
					<div class="signup-form">
						<h2 class="form-title">Đăng Ký</h2>
						<form method="POST" class="register-form" id="register-form">
							<p id="err" style="color: red; font-size: 12px;">
								<?php
								if (isset($_SESSION['error_message'])) {
									echo  $_SESSION['error_message'];
									unset($_SESSION['error_message']);
								}
								?>
							</p>
							<div class="form-group">
								<label for="name">
									<i class="zmdi zmdi-account material-icons-name"></i>
								</label>
								<input type="text" name="userName" id="name" placeholder="Nhập vào tên của bạn" />
							</div>
							<div class="form-group">
								<label for="email">
									<i class="zmdi zmdi-email"></i>
								</label>
								<input type="email" name="userEmail" id="email" placeholder="Nhập vào email của bạn" />
							</div>
							<div class="form-group">
								<label for="pass">
									<i class="zmdi zmdi-lock"></i>
								</label>
								<input type="password" name="userPassword" id="pass" placeholder="Nhập vào mật khẩu" />
							</div>
							<div class="form-group">
								<label for="re_pass">
									<i class="zmdi zmdi-lock-outline"></i>
								</label>
								<input type="password" name="rePassword" id="re_pass" placeholder="Nhập lại mật khẩu" />
							</div>
							<div class="form-group form-button">
								<input type="button" onclick="submitForm()" name="signup" id="signup" class="form-submit" style="background-color: #42b72a;" value="Đăng Ký" />
								<a href="/view/signin.php" class="form-submit" style="text-decoration: none; padding: 11px 45px;">Đăng
									nhập</a>
							</div>
						</form>
					</div>
					<div class="signup-image">
						<figure>
							<img src="/resources/images/signup-image.jpg" alt="sing up image">
						</figure>
					</div>
				</div>
			</div>
		</section>

	</div>

	<!-- JS -->
	<script src="/resources/vendor/jquery/jquery.min.js"></script>
	<script src="/resources/js/main.js"></script>
	<script>
		function submitForm() {
			var name = document.getElementById('name').value.trim();
			var email = document.getElementById('email').value.trim();
			var pass = document.getElementById('pass').value.trim();
			var repass = document.getElementById('re_pass').value.trim();
			if (name != "" && email != "" && pass != "" && repass != "" && pass == repass) {
				document.getElementById('register-form').submit();
			} else {
				document.getElementById('err').innerHTML = "*Vui lòng điền đầy đủ thông tin*";
			}
		}
	</script>
</body>

</html>