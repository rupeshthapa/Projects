<?php

//connecting into database
 $pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

 //resuming the session
session_start();

//starting the output buffer
ob_start();

//including the files used for templates

require '../functions/image_template.php';
require '../functions/admin_section_left.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/css/styles.css"/>
		<title>Claires's Cars - Home</title>
	</head>
	<body>
		<?php
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
		<?=$image;?>
		<main class="admin">
			<?php
			//if logged in true 
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				?>
				<?=$section;?>
				<section class="right">
					<h1> Enquiries:</h1
					<?php
					$enquiries_select_sql = $pdo->prepare('SELECT * FROM enquiries'); // selecting records of enquiries table from the database
					$enquiries_select_sql->execute(); // database executing the query 
					foreach ($enquiries_select_sql as $enquiries) { //looping values of an array
						//getting the details from the database
						echo '<h3>' . $enquiries['name'] . '</h3>';	
						echo '<h3>' . $enquiries['email'] . '</h3>';	
						echo '<h3>' . $enquiries['enquiry'] . '</h3><br>';
					}
					?>
					</section>
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