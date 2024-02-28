<?php

//database connection using PDO class and mysql database type including db host and student username and password
$database = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

//including required file for this file
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
		<!--by using shorthand syntax getting image-->
		<?=$image;?>
		<main class="admin">
			<section class="left">
				<ul>
					<?php
					$geManufacturers = "SELECT * FROM manufacturers"; // getting datas from database table query 
					$prepareSql = $database->prepare($geManufacturers); // preparing query
					$prepareSql->execute(); // executing query
					$prepareSql->setfetchMode(PDO::FETCH_OBJ); // setting default fetching mode which is object method 
					$getManu = $prepareSql->fetchALL(); // fetching all 
					if($getManu){ // if fetched 
						foreach($getManu as $manufacturer){ // displaying datas by looping an array 
						?>
						<br>
						<center>
							<!--returning ids and it helps to print the news according to the manufacturers id-->
							<li><a href="users_showroom.php?id=<?=$manufacturer->id;?>"><?=$manufacturer->name;?></a></li>;
						</center>
						<?php
						}
					}
					?>
					</ul>
				</section>
				<section class="right">
					<h1>Our cars</h1>
					<ul class="cars">
						<?php
						//preparing sql queries which gets the cars details and manufacturers details
						$getCars = $database->prepare('SELECT * FROM cars LIMIT 10');
						$getting_manufacturer = $database->prepare('SELECT * FROM manufacturers WHERE id = :id');
						$getCars->execute(); //executing sql query which selects the cars 
						foreach ($getCars as $cars_details) { //using foreach loop for an array

							//executing getting manaufacturer query to get manufacturers with foreign key and primary key
							$getting_manufacturer->execute(['id' => $cars_details['manufacturerId']]);
							
							//fetching query to get manufacturer details
							$manufacturer = $getting_manufacturer->fetch();
							echo '<li>';

							//checks if mentioned files exist or not
							if (file_exists('images/cars/' . $cars_details['id'] . '.jpg')) {
								//if exist gets the images according to id 
								echo '<a href="images/cars/' . $cars_details['id'] . '.jpg"><img src="images/cars/' . $cars_details['id'] . '.jpg" /></a>';
							}
							//gets car details
							echo '<div class="details">';
							echo '<h2>' . $manufacturer['name'] . ' ' . $cars_details['name'] . '</h2>';
							echo '<h3>£' . $cars_details['price'] . '</h3>';
							echo '<p>' . $cars_details['description'] . '</p>';
							echo '</div>';
							echo '</li>';
						}
						?>
						</ul>
					</section>
				</main>
				<?php
				//including footer part
				include('footer/footer.php');
				?>
	</body>
</html>