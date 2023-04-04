<?php
require_once('../controller/UserController.php');
$controller = new UserController();
$controller->forgotPassword();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="https://res.cloudinary.com/ddt8drwas/image/upload/v1679934580/TVT_n5hd3g.png">
	<title>THT ToyStore - Forgot Pasword</title>
	<meta name="description" content="THT ToyStore - Forgot Pasword">

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
				<div class="signin-content" style="padding-top: 50px; padding-left: 200px;">

					<div class="signin-form">
						<h2 class="form-title">Đổi mật khẩu</h2>
						<c:if test="${param.error != null}">
							<p id="err" style="color: red; font-size: 12px;">
								<?php
								if (isset($_SESSION['error_message'])) {
									echo  $_SESSION['error_message'];
									unset($_SESSION['error_message']);
								}
								?>
							</p>
						</c:if>
						<p id="err" style="color: red; font-size: 12px; margin-bottom: 10px;"></p>
						<div class="form-group">
							<form method="POST" class="register-form" id="checkMail">
								<label for="your_email">
									<i class="zmdi zmdi-account material-icons-name"></i>
								</label>
								<input type="email" name="userEmail" id="your_email" style="width: 70%; float: left;" placeholder="Nhập vào email của bạn" <?php
																																							if (isset($_SESSION['userEmail'])) {
																																								echo 'readonly';
																																								echo ' value="' . $_SESSION['userEmail'] . '"';
																																							}
																																							?> />
								<input type="button" onclick="submitForm1()" style="width: 10%; float: left; background: white; color: green;
								<?php
								if (isset($_SESSION['form'])) {
									echo 'display:none;';
								}
								?>" value="Gửi" />
							</form>
						</div>

						<div class="form-group">
							<form method="POST" class="register-form" id="checkCode" <?php
																						if (isset($_SESSION['form'])) {
																							if ($_SESSION['form'] != 'form2') {
																								echo 'style="display: none;"';
																							}
																						} else {
																							echo 'style="display: none;"';
																						}
																						?>>
								<label for=" your_code">
									<i class="zmdi zmdi-account material-icons-name"></i>
								</label>
								<input type="text" name="code" id="your_code" style="width: 70%; float: left;" placeholder="Nhập vào mã xác minh" />
								<input type="button" onclick="submitForm2()" style="width: 10%; float: left; background: white; color: green; padding-right: 58px;" value="Xác nhận" />
							</form>
						</div>

						<form method="POST" class="register-form" id="changePassword" <?php
																						if (isset($_SESSION['form'])) {
																							if ($_SESSION['form'] != 'form3') {
																								echo 'style="display: none;"';
																							}
																						} else {
																							echo 'style="display: none;"';
																						}
																						?>>
							<div class="form-group">
								<label for="your_pass">
									<i class="zmdi zmdi-lock"></i>
								</label>
								<input type="password" name="userPassword" id="your_pass" style="width: 70%;" placeholder="Nhập vào mật khẩu mới" />
							</div>
							<div class="form-group">
								<label for="rePassword">
									<i class="zmdi zmdi-lock"></i>
								</label>
								<input type="password" name="rePassword" id="rePassword" style="width: 70%;" placeholder="Nhập lại mật khẩu" />
							</div>
							<div class="form-group">
								<div class="form-group form-button">
									<input type="button" onclick="submitForm3()" name="signin" id="signin" class="form-submit" value="Thay đổi" />
								</div>
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
		function submitForm1() {
			var email = document.getElementById('your_email').value.trim();
			if (email != "") {
				document.getElementById('checkMail').submit();
			} else {
				document.getElementById('err').innerHTML = "*Vui lòng điền đầy đủ thông tin*";
			}
		}

		function submitForm2() {
			var code = document.getElementById('your_code').value.trim();
			if (code != "") {
				document.getElementById('checkCode').submit();
			} else {
				document.getElementById('err').innerHTML = "*Vui lòng điền đầy đủ thông tin*";
			}
		}

		function submitForm3() {
			var pass = document.getElementById('your_pass').value.trim();
			var rePass = document.getElementById('rePassword').value.trim();
			if (pass != "" && rePass != "" && pass == rePass) {
				document.getElementById('changePassword').submit();
			} else {
				document.getElementById('err').innerHTML = "*Vui lòng điền đầy đủ thông tin*";
			}
		}
	</script>
</body>

</html>