<?php
//including required files for this file
require 'functions/image_template.php';
require 'functions/jobs_template.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/styles.css"/>
		<title>Fotheby's Business - Home</title>
	</head>
	<body>
		<?php
		//including header part
		include('header/header.php');
		?>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="cars.php">Showroom</a></li>
				<li><a href="caliresCareers.php">Jobs</a></li>
    			<li><a href="about.html">About Us</a></li>
    			<li><a href="contact.php">Contact us</a></li>
    			<li><a href="login.php">Login</a></li>
			</ul>
		</nav>
		<!--gets data using shorthand syantax-->
		<?=$image;?>
		<main class="admin">
			<section class="left">

			</section>
			<?=$jobs;?>
		</main>
		<?php
		//including footer part
		include('footer/footer.php');
		?>
	</body>
</html>