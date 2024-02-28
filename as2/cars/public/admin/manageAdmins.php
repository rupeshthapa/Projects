<?php
 $pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

session_start();
ob_start();

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
			if (isset($_POST['submit'])) {
				if ($_POST['password'] == 'opensesame') {
					$_SESSION['loggedin'] = true;	
				}
			}
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				?>
				<?=$section;?>
				<section class="right">
					<h2>Manage Admins</h2>
					<a href="addAdmins.php">Add Admins</a>
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