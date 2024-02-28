<?php
 $pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');
session_start();
ob_start();

require '../functions/image_template.php';
require '../functions/admin_section_left.php';
require '../functions/addCatalogue_template.php';

if (isset($_POST['submit'])) {
	$story = $_POST['story'];
	$userId = $_SESSION['name']; //
    $stmt = $pdo->prepare('INSERT INTO stories (story, userId) 
	VALUES (?, ?)');
	$stmt->execute([$story,$userId]);
	if ($_FILES['image']['error'] == 0) {
		$fileName = $pdo->lastInsertId() . '.jpg';
		move_uploaded_file($_FILES['image']['tmp_name'], '../images/story/' . $fileName);
	}
	header('Location: index.php');
	echo 'Story added';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/css/styles.css"/>
		<title>Fotheby's Business - Home</title>
	</head>
	<body>
		<?php
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
		<?=$image;?>
		<main class="admin">
			<?php
			if (isset($_POST['submit'])) {
				$stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
				$stmt->execute([$_POST['name']]);
				$user = $stmt->fetch();
				if ($_POST['password'] == 'opensesame' && $user && password_verify($_POST['password'], $user['password'])){ //verfiy the given password matches with hash password or not
					$_SESSION['name'] = $_POST['name']; // starting the global variable 
					$_SESSION['loggedin'] = true;
				}
			}
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
				?>
				<?=$section;?>
				<?=$story;?>
				<?php
				}
				else {
					header('Location: ../login.php');
					?>
					<?php
					}
					?>
					</main>
					<?php
					require('../footer/footer.php');
					?>
	</body>
</html>