<?php
//connection to the database using PDO 
//by specifying the database type (in this case, mysql), the host name (db), 
//the database name (cars), and the studnet and student used to access the database.
$connecting_to_the_database = new PDO('mysql:dbname=cars;host=db', 'student', 'student');


//resuming the started session
session_start();

ob_start();//starting output buffer

//output buffering start to catch the output generated and storing it in a buffer

//including the required file for shorthandling 

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
		<!--getting the image using shorthand method-->
		<?=$image;?>
		<main class="admin">
			<?=$section;?>
			<section class="right">
				<?php
				if(isset($_POST['submit'])) {
					$inserting_cars = $connecting_to_the_database->prepare('INSERT INTO cars (name, price, wasPrice, mileage, engineType, manufacturerId, description)
					VALUES (:model, :price, :wasPrice, :mileage, :engineType, :manufacturerId, :description)');
					$criteria = [
						'model' => $_POST['model'],
						'description' => $_POST['description'],
						'price' => $_POST['price'],
						'wasPrice' => $_POST['wasPrice'],
						'mileage' => $_POST['mileage'],
						'engineType' => $_POST['engineType'],
						'manufacturerId' => $_POST['manufacturerId']
					];
					$inserting_cars->execute($criteria);
					if ($_FILES['image']['error'] == 0) {
						$fileName = $connecting_to_the_database->lastInsertId() . '.jpg';
						move_uploaded_file($_FILES['image']['tmp_name'], '../images/cars/' . $fileName);
					}
					echo 'Car added';
				}
				else {
					if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						?>
						<h2>Add Car</h2>
						<form action="addcar.php" method="POST" enctype="multipart/form-data">
							<label>Car Model</label>
							<input type="text" name="model" />
							
							<label>Description</label>
							<textarea name="description"></textarea>
							
							<label>Price</label>
							<input type="text" name="price" />

							<label>Was Price</label>
							<input type="text" name="wasPrice" />

							<label>Mieage</label>
							<input type="text" name="mileage" />

							<label>Engine Type</label>
							<input type="text" name="engineType" />

							<label>Category</label>

							<select name="manufacturerId">
								<?php
								$manu = $connecting_to_the_database->prepare('SELECT * FROM manufacturers');
								$manu->execute();
								foreach ($manu as $manufacturer) {
									echo '<option value="' . $manufacturer['id'] . '">' . $manufacturer['name'] . '</option>';
								}
								?>
								</select>
								<label>Image</label>
								<input type="file" name="image" />
								<input type="submit" name="submit" value="Add Car" />
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