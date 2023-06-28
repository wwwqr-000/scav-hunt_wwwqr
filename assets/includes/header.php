	<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Scav Hunt</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="/~fp241754/scav-hunt/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="/~fp241754/scav-hunt/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="/~fp241754/scav-hunt/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/~fp241754/scav-hunt/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="/~fp241754/scav-hunt/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="/~fp241754/scav-hunt/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="/~fp241754/scav-hunt/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<script src="https://kit.fontawesome.com/51b9333b7a.js" crossorigin="anonymous"></script>

	<!-- Main CSS File -->
	<link href="/~fp241754/scav-hunt/assets/css/style.css" rel="stylesheet">
</head>

<body>
	<div id="box"> <?php include_once("/~fp241754/scav-hunt/filedir.php") ?> </div>
	<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

	<div class="header-box"></div>

	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-1">
					<a href="/~fp241754/scav-hunt/"><img src="/~fp241754/scav-hunt/assets/img/1234.png" alt="" class="img-fluid rounded-circle"></a>
				</div>

				<div class="col-md-2">
					<div class="profile">
						<h1 class="text-light"><a href="/~fp241754/scav-hunt/">Scav Hunt</a></h1>
						<div class="social-links mt-3 text-center">
							<a href="" target="_blank"><i class="fa fa-info" aria-hidden="true"></i></a>
							<a href="" target="_blank"><i class="fa fa-address-book" aria-hidden="true"></i></a>
							<a href="" target="_blank"><i class="fa fa-map" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
				<div class="col-md-9 vert">
						<?php session_start(); ?>
					<nav id="navbar" class="nav-menu navbar">
						<ul class="nav-menu">
							<li><a href="/~fp241754/scav-hunt/" class="nav-link scrollto hover-sound"><i class="bx bx-home"></i> Home</a></li>
							<?php
							if (isset($_SESSION['docent'])) {
								// echo <<< bar
								echo '<li><a href="/~fp241754/scav-hunt/docent/"><i class="bx bx-user"></i> Docent</a></li>';
								echo '<li class="dropdown"><a href="#"><i class="bx bx-user"></i> Beheren <i class="bx bx-chevron-down"></i></a>';
								echo 	'<ul>';
								echo 		'<li><a href="/~fp241754/scav-hunt/docent/groepje-tonen.php"><i class="bx bx-group"></i> Groepjes</a></li>';
								echo 		'<li><a href="/~fp241754/scav-hunt/docent/winnaar-tonen.php"><i class="bx bx-trophy"></i> Winnaar</a></li>';
								echo 		'<li><a href="/~fp241754/scav-hunt/docent/koter_analyzer.php"><i class="bx bx-map"></i> Locaties</a></li>';
								echo 		'<li><a href="/~fp241754/scav-hunt/docent/vragen-aanpassen.php"><i class="bx bx-edit"></i> Vragen bijwerken</a></li>';
								echo 		'<li><a href="/~fp241754/scav-hunt/docent/code-tonen.php"><i class="bx bx-code"></i> Code tonen</a></li>';
								if (isset($_SESSION['admin']))
									echo	'<li><a href="docent_toevoegen.php"><i class="bx bx-user"></i> Docent toevoegen</a></li>';
								echo 	'</ul>';
								echo '</li>';
								// echo '<li><a href="/~fp241754/scav-hunt/login/logout.php"><i class="bx bx-user"></i> Uitloggen</a></li>';
								// bar;
							} else if ($_SESSION['pagina'] == 'home') {
								echo '<li><a href="/~fp241754/scav-hunt/login" class="nav-link scrollto hover-sound"><i class="bx bx-user"></i> Docent login</a></li>';
								echo '<li><a href="/~fp241754/scav-hunt/student_code.php" class="nav-link scrollto hover-sound"><i class="bx bx-user"></i> Student login</a></li>';
							}
							?>
							<li><a href="/~fp241754/scav-hunt/about.php" class="nav-link scrollto hover-sound"><i class="bx bx-user"></i> About</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>