


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Select Category</a>
					<ul>
					<?php
include('pdo.php');

  if(isset($_POST['submit'])){
  
  $title = $_POST['title'];
  $category = $_POST['category'];
  $textarea = $_POST['textarea'];
  
$fetch = "SELECT * FROM article WHERE category=Sports";
$fetch1 = $pddo->prepare($fetch);
$fetch1->execute();
$fetch1->setfetchMode(PDO::FETCH_OBJ);
$result = $fetch1->fetchALL();
if($result){


	?>
	<?php
	while($fetch1){
		?>
		
		<li><a class="articleLink" href="sports.php?id=<?=$row->id;?>"> 
		<?php
  foreach($result as $row){
    ?>
    <br>
    <h1 style="color:black;"><?=$row->title;?></h1>
    <br>
    <?=$row->category;?>
    <br>
    <?=$row->textarea;?>
    <?php
  }
}

}
}
?>

			
					
					
					</ul>
					
				</li>
				<li><a href="login.php">LogIn</a></li>
				<a href="register.php">Register Here</a>
			</ul>
		</nav>
		<!-- <img src="images/banners/randombanner.php" /> -->
		

		<footer>
			&copy; Northampton News 2017
		</footer>
		 

	</body>
</html>
