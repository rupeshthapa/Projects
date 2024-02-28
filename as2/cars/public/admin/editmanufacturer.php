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
		<?=$navigation;?>
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
				if (isset($_POST['submit'])) {
					$stmt = $pdo->prepare('UPDATE manufacturers SET name = :name WHERE id = :id ');
					$criteria = [
						'name' => $_POST['name'],
						'id' => $_POST['id']
					];
					$stmt->execute($criteria);
					echo 'Manufacturer Saved';
				}
				else {
					if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						$currentMan = $pdo->query('SELECT * FROM manufacturers WHERE id = ' . $_GET['id'])->fetch();
						?>
						<h2>Edit Manufacturer</h2>
						<form action="" method="POST">
							<input type="hidden" name="id" value="<?php echo $currentMan['id']; ?>" />
							<label>Name</label>
							<input type="text" name="name" value="<?php echo $currentMan['name']; ?>" />
							<input type="submit" name="submit" value="Save Manufacturer" />
						</form>
						<?php
						}
						else {
							header('Location: ../login.php');
							?>
							<?php
							}
						}
						?>
						</section>
					</main>
					<?php
					include('../footer/footer.php');
					?>
	</body>
</html>
