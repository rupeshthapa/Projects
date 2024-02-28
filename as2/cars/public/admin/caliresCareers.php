<?php
$pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');
session_start();

require '../functions/image_template.php';
require '../functions/jobs_template.php';
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

<?=$jobs;?>
</main>
<?php
include('../footer/footer.php');
?>
</body>
</html>