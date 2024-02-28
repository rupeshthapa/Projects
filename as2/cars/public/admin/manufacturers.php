<?php
$pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

session_start();


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
		include('../header/header.php');
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
			<?=$section;?>
			<section class="right">
				<?php
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					?>
					<h2>Manufacturers</h2>
					<a class="new" href="addmanufacturer.php">Add new manufacturer</a>
					<?php
					echo '<table>';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Name</th>';
					echo '<th style="width: 5%">&nbsp;</th>';
					echo '<th style="width: 5%">&nbsp;</th>';
					echo '</tr>';
					
					$categories = $pdo->query('SELECT * FROM manufacturers');
					foreach ($categories as $category) {
						echo '<tr>';
						echo '<td>' . $category['name'] . '</td>';
						echo '<td><a style="float: right" href="editmanufacturer.php?id=' . $category['id'] . '">Edit</a></td>';
						echo '<td><form method="post" action="deletemanufacturer.php">
						<input type="hidden" name="id" value="' . $category['id'] . '" />
						<input type="submit" name="submit" value="Delete" />
						</form></td>';
						echo '</tr>';
					}
					echo '</thead>';
					echo '</table>';
				}
				else {
					?>
					<h2>Log in</h2>
					<form action="index.php" method="post">
					<label>Username</label>
					<input type="text" name="username" />

					<label>Password</label>
					<input type="password" name="password" />

					<input type="submit" name="submit" value="Log In" />
					</form>
					<?php
					}
					?>
					</section>
				</main>
				<?php
				include('../footer/footer.php');
				?>
	</body>
</html>

