<?php
//connecting into database with PDO class mysql database type, db host and student as a username and password
 $databaseConnection = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

 //resuming the session
session_start();
ob_start();


//including required files
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
		//including header part
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
		<!--gets data using shorthand syntax-->
		<?=$image;?>
		<main class="admin">
			<?=$section;?>
			<section class="right">
				<?php
				//executing further codes using global variables if loggedin is true
				if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
					?>
					<h2>Cars</h2>
					<a class="new" href="addcar.php">Add new car</a>
					<?php
					echo '<table>';
					echo '<tr>';
					echo '<th>Model</th>';
					echo '<th>Manufacturer</th>';
					echo '<th>Price</th>';
					echo '<th>&nbsp;</th>';
					echo '<th>&nbsp;</th>';
					echo '</tr>';

					//joining table query for fetching manufacturers using PK and FK
					$joining_table = "SELECT cars.id, cars.name as car_name, cars.price as is_price, cars.WasPrice as was_price,  manufacturers.name as manufacturer_name
					FROM cars
					JOIN manufacturers ON cars.manufacturerId = manufacturers.id";
					$prepare = $databaseConnection->prepare($joining_table); //preparing query
					$prepare->execute(); //database executing the sql 
					$detail = $prepare->fetchAll(PDO::FETCH_ASSOC); //setting default method i.e. Association Method
					foreach ($detail as $details) { //looping an array elements
						
						//gets detials in table
						echo'<tr>';
						echo "<td>" . $details['car_name'] . "</td>";
						echo "<td>" . $details['manufacturer_name'] . "</td>";
						echo "<td>Now: £" . $details['is_price'] . ", Was: £ ". $details['was_price']. "</td>";
						
						echo '<td><a style="float: right" href="editcar.php?id=' . $details['id'] . '">Edit</a></td>';
						
						echo '<td><form method="post" action="deletecar.php">
						<input type="hidden" name="id" value="' . $details['id'] . '" />
						<input type="submit" name="submit" value="Delete" />
						</form></td>';
						echo '<td>';
						
						$cars_selecting = $databaseConnection->prepare("SELECT * FROM cars WHERE id = ?");
						$cars_selecting->execute([$details['id']]);
						$details = $cars_selecting->fetch();
						$archived = $details['archived']; //getting the field name of cars table
						
						echo '<form action="/archive/archive.php" method="post">';
						echo '<input type="hidden" name="id" value="'.$details['id'].'">'; //sents id of the cars from button
						echo '<input type="hidden" name="archived" value="'.$archived.'">'; // getting value same as a field name 
						if ($archived == 0) { //if archived is zero button name will be Archive
							echo '<input type="submit" name="updateButton" value="Archive">';
						} 
						else { // if 1 it will be Unarchive 
							echo '<input type="submit" name="updateButton" value="Unarchive">';
						}
							echo '</form>';
							echo'</td>';


							echo'<td> <form action="imageUpload.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="carsId" value="'.$details['id'] . '">
							<input type="file" name="image">
							<input type="submit" name="submit">
							</form> </td>';
							echo '</tr>';
						}
						echo '</table>';
					}
					else{
						//if loggedin is not true it takes in login page 
						header('Location: ../login.php');
						?>
						<?php
						}
						?>
						</section>
					</main>
					<?php
					//includes footer
					include('../footer/footer.php');
					?>
	</body>
</html>
