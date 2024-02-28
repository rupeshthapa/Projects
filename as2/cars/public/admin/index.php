<?php
 
 //connecting into database using PDO class
 //database type mysql
 //host db and student as username and password to access the database
 $pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

//resuming the session
session_start();

//starting output buffer for collecting the output generated and to store in buffer
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
		<!--getting data using shorthand syntax-->
		<?=$image;?>
		<main class="admin">
			<?php
			//using global variable to execute the further codes if logged in is true
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				?>
				<?=$section;?>
				<section class="right">
					<?php
					//helps to get logged in user name
					if(isset($_SESSION['name'])){
						$user = $_SESSION['name'];
						echo '<center><h2> Welcome '. $user . '</center></h2>';
					}
					?>
					<?php
					//getting the stories from the database
					$select_story = $pdo->prepare('SELECT * FROM stories'); // selecting records of stories table from the database
					$select_story->execute(); // database executing the query 
					foreach ($select_story as $get_story_details) { //looping values of an array
						//getting image from the folder which have stored
						if (file_exists('../images/story/' . $get_story_details['id'] . '.jpg')) { //checks if there is an existing file or not
						//if there is an existing file it gives images according to id
						echo '<center><a href="../images/story/' . $get_story_details['id'] . '.jpg"><img src="../images/story/' . $get_story_details['id'] . '.jpg" style="width:50%; height:50%;"/></a></center>';
					}
					//get details from the stories table
					echo '<h1>' . $get_story_details['story'] . '</h1>';		
					echo '<em style="float:right; "> Posted By:' . $get_story_details['userId'] . '</em>';
					echo '</div>';
				}
				?>
				</section>
				<?php
				}
				else {
					//if loggedin is false it taks to login page
					header('Location: ../login.php');
					?>
					<?php
					}
					?>
					</main>
					<?php
					//include footer part
					require('../footer/footer.php');
					?>
	</body>
</html>