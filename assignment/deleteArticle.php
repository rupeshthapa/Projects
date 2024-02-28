<?php
include('pdo.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>

	<?php
	if(isset($_SESSION['message'])) : ?>
	<h5> <?= $_SESSION['message']; ?></h5>
	<?php
	unset($_SESSION['message']);
	endif;
	?>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="adminArticle.php">Home</a></li>
				<li><a href="#">Select Category</a>
					<ul>
						<li><a class="articleLink" href="localnews.php">Local News</a></li>
						<li><a class="articleLink" href="sports.php">Sports</a></li>
						<li><a class="articleLink" href="technology.php">Technology</a></li>
						<li><a class="articleLink" href="business.php">Business</a></li>
					</ul>
				</li>
				<li><a href="addArticle.php">Add Article</a></li>
				<li><a class="articleLink" href="manageAdmins.php">Manage Admin</a></li>
				<li><a class="articleLink" href="manageCategories.php">Manage Categories</a></li>
			</ul>
		</nav>
		<!-- <img src="images/banners/randombanner.php" /> -->
		

	<?php
	include('pdo.php'); // connecting with docker server
	$fetch = "SELECT * FROM article"; // query to get datas from the database table
	$fetch1 = $pddo->prepare($fetch); // preparing the query to execute
	$fetch1->execute(); // executing the query
	$fetch1->setfetchMode(PDO::FETCH_OBJ); // fetching with obj method
	$result = $fetch1->fetchALL(); // fetching all datas
	if($result){ // if fetched
		foreach($result as $row){
 // displays datas
  			?>
			<br>
			<center>
		<form action = "db.php" method = "POST">
		<button type="submit" name="delete" value="<?=$row->id ;?>" style="border-radius:10px; width:50px;">Delete</button>
		</form>
		
			<h5><?=$row->id;?></h5>
			<?=$row->category;?>
			<h3 style="color:black;"><?=$row->title;?></h3>
			<br>
			<h2><?=$row->category;?> </h2>
			<br>
			<li><?=$row->textarea;?></li>
		</center>
		 
			<?php
		} // in line number 61 taking on a button
	}
	else{
			?>
		<td>No records found!</td>
			<?php
		}
		

?>
		<footer>
			&copy; Northampton News 2017
		</footer>
		 

	</body>
</html>
