<?php
$database_connecting = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

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
				if (isset($_POST['submit'])) {
					$stmt = $database_connecting->prepare('UPDATE cars SET name = :name, description = :description, price = :price,
					manufacturerId = :manufacturerId
					WHERE id = :id');
					$criteria = [
						'name' => $_POST['name'],
						'description' => $_POST['description'],
						'price' => $_POST['price'],
						'manufacturerId' => $_POST['manufacturerId'],
						'id' => $_POST['id']
					];
					$stmt->execute($criteria);
					if ($_FILES['image']['error'] == 0) {
						$fileName = $database_connecting->lastInsertId() . '.jpg';
						move_uploaded_file($_FILES['image']['tmp_name'], '../images/productimages/' . $fileName);
					}
					echo 'Product saved';
				}
				else {
					if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						$car = $database_connecting->query('SELECT * FROM cars WHERE id = ' . $_GET['id'])->fetch();
						?>
						<h2>Edit Car</h2>
						<form action="editcar.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $car['id']; ?>" />
							<label>Name</label>
							<input type="text" name="name" value="<?php echo $car['name']; ?>" />

							<label>Description</label>
							<textarea name="description"><?php echo $car['description']; ?></textarea>

							<label>Price</label>
							<input type="text" name="price" value="<?php echo $car['price']; ?>" />

							<label>Category</label>

							<select name="manufacturerId">
								<?php
								$stmt = $database_connecting->prepare('SELECT * FROM manufacturers');
								$stmt->execute();

								foreach ($stmt as $row) {
									if ($car['categoryId'] == $row['id']) {
										echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
									}
									else {
										echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';	
									}
								}
								?>
								</select>
								<?php
								if (file_exists('../productimages/' . $car['id'] . '.jpg')) {
									echo '<img src="../productimages/' . $car['id'] . '.jpg" />';
								}
								?>
								<label>Product image</label>
								<input type="file" name="image" />
									<input type="submit" name="submit" value="Save Product" />
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

