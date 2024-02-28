<?php
//using PDO class to connect into database with mysql database type, host db and username and password student
$databaseConnection = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

//starting the session
session_start();

//startingt output buffer 
ob_start();

//evaluting the required file of shorthand part
require 'functions/index_template.php';
require 'functions/image_template.php';
?>

<?php
if (isset($_POST['submit'])) { //checking if variable are set or not on button click
	$name = $_POST['name']; //getting entered name from form
	$password = $_POST['password']; //getting entered password
	
	//selecting records from the database table
	$get_name = $databaseConnection->prepare('SELECT * FROM users WHERE name = :name');
	$get_name->execute(['name' => $name]); //executing sql query checking the name from datbase and entered one
	$user = $get_name->fetch(); 
	
	//checking if hashed password is correct or not
	if ($user && password_verify($password, $user['hash_password'])) {
		//starting the global variables
		$_SESSION['name'] = $user['name']; 
		$_SESSION['loggedin'] = true;
        echo'Loggedin Successfully';
        header('Location: admin/index.php');
	}
	else{
		echo 'Invalid email or password';
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/styles.css"/>
		<title>Claires's Cars - Home</title>
	</head>
	<body>
		<?php
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
		<main class = "home">
			<h2>Log in</h2>
			<form action="login.php" method="post" style="padding: 40px">
			<label>Enter Name:</label>
			<input type="text" name="name" />
			<label>Enter Password:</label>
			<input type="password" name="password" />
			<input type="submit" name="submit" value="Log In" />
		</form>
	</main>
	<?php
	include('footer/footer.php');
	?>
	</body>
</html>