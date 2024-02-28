<?php

//using PDO class, connecting to the database
//using database type: mysql, host: db, and student,student username and password to access into database 
$connecting = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

//evaluting the required files for shorthand
require 'functions/index_template.php';
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
            <li><a href="auctions.php">Auctions</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
		</nav>
		<!--getting image from using shorthand-->
		<?=$image;?>
		<main class = "home">
		<?php
					//getting the articles from the database
					$selecting_stories = $connecting->prepare('SELECT * FROM stories'); // selecting records of stories from the database
					$selecting_stories->execute(); // executing the query by database
					foreach ($selecting_stories as $stories) { //array getting looped
						//getting image from the folder which have in stored
						if (file_exists('images/story/' . $stories['id'] . '.jpg')) { //checks if there is an existing file or not
						//if there is an image it gives images according to id
						echo '<center><a href="images/story/' . $stories['id'] . '.jpg"><img src="images/story/' . $stories['id'] . '.jpg" style="width:50%; height:50%;"/></a></center>';
					}
					//getting story from the database which have been inserted
					echo '<h1>' . $stories['story'] . '</h1>';	
					//getting the name who has posted story	
					echo '<em style="float:right; "> Posted By:' . $stories['userId'] . '</em>';
					echo '</div>';
				}
				?>
				</main>
		<?php
		//including footer
		include('footer/footer.php');
		?>
	</body>
</html>