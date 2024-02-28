<?php


//existing session getting resumed
session_start();


//collecting output generated and storing it in a buffer
ob_start();

//evaluating the required files

require '../functions/image_template.php';
require '../functions/admin_section_left.php';
require '../functions/addAdmin_template.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/css/styles.css"/>
		<title>Claires's Cars - Home</title>
	</head>
	<body>
		<?php
		//including the header part from header file 
		require('../header/header.php');
		?>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
    			<li><a href="cars.php">Showroom</a></li>
    			<li><a href="caliresCareers.php">Jobs</a></li>
    			<li><a href="about.html">About Us</a></li>
    			<li><a href="contact.php">Contact us</a></li>
    			<li><a href="logout.php">Log out</a></li>
			</ul>
		</nav>
		<!--using shorthand syntax for getting the value of $image-->
		<?=$image;?>
		<main class="admin">
			<?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				?>
				<?=$section;?>
				<?=$form;?>
				<?php
				}
				else {
					header('Location: ../login.php');
					?>
					<?php
					}
					?>
					</main>
					<?php
					require('../footer/footer.php');
					?>
	</body>
</html>