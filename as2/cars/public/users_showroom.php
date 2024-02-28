<?php
//connecting into database using PDO class which
//database type is mysql, host is db and student, student username and password
$pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

//including file 
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
		//including header
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
		<?=$image;?>
		<main class="admin">
			<section class="left">
				<ul>
					<?php
					$get_data_from_manufacutrer_table = "SELECT * FROM manufacturers"; // getting datas from database table query 
					$prepare_query_to_execute = $pdo->prepare($get_data_from_manufacutrer_table); // preparing query
					$prepare_query_to_execute->execute(); // executing query
					$prepare_query_to_execute->setfetchMode(PDO::FETCH_OBJ); // fetching with object method 
					$after_setting_fetchMode = $prepare_query_to_execute->fetchALL(); // fetching all 
					if($after_setting_fetchMode){ // if fetched 
						foreach($after_setting_fetchMode as $after_set){ // displaying datas
						?>
						<br>
						<center>
							<!--sedning ids and it helps to print the news according to the category id-->
							<li><a href="users_showroom.php?id=<?=$after_set->id;?>"><?=$after_set->name;?></a></li>;
						</center>
						<?php
						}
					}
					?>
					</ul>
				</section>
				<section class="right">
					<ul class="cars">
						<?php
						//selecting cars according to manufacturer id and selecting manufacturers according to id
						$get_cars_from_databaseTable = $pdo->prepare('SELECT * FROM cars WHERE manufacturerId = '. $_GET['id']);
						$get_manufacturers = $pdo->prepare('SELECT * FROM manufacturers WHERE id = :id');

						// $query = $pdo->prepare('SELECT image, type FROM images WHERE carsId = :id');
						
						
						$get_cars_from_databaseTable->execute();//executing the query which is to select cars according to manufacturerId
						
						//$query->execute();
						foreach ($get_cars_from_databaseTable as $get_information) { //looping an array value
							$get_manufacturers->execute(['id' => $get_information['manufacturerId']]); //query which selects manufacturers getting executed according to foreign key 'manufacturerId'
							$get_manufacturer = $get_manufacturers->fetch(); // fetching the datas of both according to primary key and foreign key
							
							// $manu->execute(['id' => $car['manufacturerId']]);
							// $manufacturer = $query->fetch();
							
							
							echo '<li>';
							//checking if the file exists or not
							if (file_exists('images/cars/' . $get_information['id'] . '.jpg')) {
								//if there is an existing files it will helps to get image according to id
								echo '<a href="images/cars/' . $get_information['id'] . '.jpg"><img src="images/cars/' . $get_information['id'] . '.jpg" /></a>';
							}
							echo '<div class="details">';
							//gets manufacturer name from manufacturers table
							echo '<h2>' . $get_manufacturer['name'] . ' ' . $get_information['name'] . '</h2><br><br>';
							
							//gets details from cars table
							echo '<h3>Now: £' . $get_information['price'] . '</h3>';
							echo '<h3>was: £' . $get_information['wasPrice'] . '</h3>';
							echo '<h3>Mileage:' . $get_information['mileage'] . '</h3>';
							echo '<h3>Engine Type:' . $get_information['engineType'] . '</h3>';
							echo '<p>' . $get_information['description'] . '</p>';
      
		// if (file_exists('images/angles/' . $car['id'] . '.jpg')) {
		// 	echo '<a href="images/angles/' . $car['id'] . '.jpg"><img src="images/angles/' . $car['id'] . '.jpg" /></a>';
		// }

							echo '</div>';
							echo '</li>';
						}
						?>
						</ul>
					</section>
				</main>
				<?php
				//including footer
				include('footer/footer.php');
				?>
	</body>
</html>