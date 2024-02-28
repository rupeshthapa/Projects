<?php

//evaluting files from another floder which includes the records for this file
require 'functions/contact_template.php';
require 'functions/image_template.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/styles.css"/>
		<title>Fotheby's Business - Home</title>
	</head>
	<body>
		<?php
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
		<!--getting image and form using shorthand syntax-->
		<?=$image;?>
		<?=$content;?>
		<?php
		include('footer/footer.php');
		?>
	</body>
</html>