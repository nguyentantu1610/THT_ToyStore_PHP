<?php
require_once('../controller/ProductController.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';

$controller = new ProductController();
$result = $controller->getProductById((int)$id);

$controller->updateProductImageById((int)$id);
?>
<!DOCTYPE html>
<html class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>THT ToyStore - Image</title>
	<meta name="description" content="THT ToyStore - Image">
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

	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="card" style="width: 100%; margin: 14px;">
					<div class="card-header">
						<strong>Quản lý hình ảnh</strong>
					</div>
					<form method="post" id="form-image" accept-charset="UTF-8">
						<div class="card-body card-block">
							<input type="hidden" name="productID" id="productID" value="<?php echo $result['productID'] ?>">
							<input type="hidden" name="removeImages" id="removeImages">
							<input type="hidden" name="newImages" id="newImages">
							<div class="row">
								<div class="col-lg-3">
									<img src="<?php echo $result['productImage'][0] ?>" alt="image" style="width: 12vw; height: 30vh;">
								</div>
								<div class="col-lg-6">
									<h2><?php echo $result['productName'] ?></h2>
									<div style="margin-top: 40px;">
										<div class="btn btn-warning" style="color: white;" onclick="myClick()">
											<input style="display: none;" multiple id="inputFile" onchange="changeSrc()" type="file" value="" />
											<i class="fa fa-folder"></i> Chọn ảnh
										</div>
										<button type="button" class="btn btn-warning" onclick="upload()" style="color: white;">
											<i class="fa fa-cloud-upload"></i> Cập nhật
										</button>
									</div>
								</div>
							</div>
							<hr />
							<div class="row" style="margin-bottom: 200px;" id="allImages">

								<?php
								for ($i = 0; $i < count($result['productImage']); $i++) {
									echo '<div style="width: 30%; margin-left: 2%; margin-bottom: 25%;" id="div-' . $i . '">
										<img src="' . $result['productImage'][$i] . '" alt="image" style="width: 12vw; height: 30vh; position: absolute;">
										<i class="fa fa-times-circle" onclick="hideImage(' . $i . ')" style="color: red; font-size: 30px; position: absolute;"></i>
									</div>';
								}
								?>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
		<!-- .animated -->
	</div>
	<!-- .content -->

	<div class="clearfix"></div>

	<?php include 'footer.php' ?>

	</div>
	<!-- /#right-panel -->

	<!-- Right Panel -->

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
	<script src="../resources/js/main.js"></script>

	<script>
		const parentDiv = document.getElementById('allImages');
		const inputFile = document.getElementById('inputFile');
		const CLOUDINARY_URL = 'https://api.cloudinary.com/v1_1/dkjiah88e/upload';
		const CLOUDINARY_UPLOAD_PRESET = 'tantu456';
		const image = document.querySelector('#inputFile');

		function myClick() {
			document.getElementById('inputFile').click();
		}

		function hideImage(position) {
			var div = document.getElementById("div-" + position);
			if (div != null) {
				div.style.display = "none";
			}
			var ri = document.getElementById('removeImages');
			ri.value += div.children[0].src + '@';
		}

		function createElementFromHTML(html) {
			const template = document.createElement("template");
			template.innerHTML = html.trim();
			return template.content.firstElementChild;
		}

		function changeSrc() {
			removeOldFile();
			for (var i = 0; i < inputFile.files.length; i++) {
				var image = URL.createObjectURL(inputFile.files[i]);
				var index = 'div-' + (parentDiv.childElementCount);
				var newDiv = '<div style="width:30%;margin-left:2%;margin-bottom:25%;" id="' +
					index +
					'" name="newImage">' +
					'<img src="' + image + '" alt="image" style="width: 12vw; height: 30vh; position: absolute; loading="lazy"">' +
					'<i class="fa fa-times-circle" onclick="removeFileFromFileList(' +
					i +
					',' +
					parentDiv.childElementCount +
					')"' +
					'style="color: red; font-size: 30px; position: absolute;"></i> </div>';
				const n = createElementFromHTML(newDiv);
				parentDiv.appendChild(n);
			}
		}

		function removeOldFile() {
			for (var i = 0; i < parentDiv.childElementCount; i++) {
				if (parentDiv.children[i].getAttribute('name') == 'newImage') {
					parentDiv.removeChild(parentDiv.children[i]);
					i--;
				}
			}
		}

		function removeFileFromFileList(index, id) {
			const dt = new DataTransfer();
			parentDiv.removeChild(parentDiv.children[id]);
			for (var i = 0; i < inputFile.files.length; i++) {
				if (index !== i) {
					dt.items.add(inputFile.files[i]);
				}
			}
			inputFile.files = dt.files;
		}

		function upload() {
			if (inputFile.files.length == 0) {
				document.getElementById('form-image').submit();
			} else {
				for (var i = 0; i < inputFile.files.length; i++) {
					const formData = new FormData();
					formData.append('file', inputFile.files[i]);
					formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);
					fetch(CLOUDINARY_URL, {
							method: 'POST',
							body: formData,
						})
						.then(response => response.json())
						.then((data) => {
							if (data.secure_url !== '') {
								const uploadedFileUrl = data.secure_url;
								localStorage.setItem('passportUrl', uploadedFileUrl)
								var url = data.secure_url;
								document.getElementById('newImages').value += url + "@";
								if (i == inputFile.files.length) {
									setTimeout(function() {
										document.getElementById('form-image').submit();
									}, 4000);
								}
							} else {
								alert('upload thất bại');
							}
						})
						.catch(err => console.error(err));
				}
			}
		}
	</script>

</body>

</html>