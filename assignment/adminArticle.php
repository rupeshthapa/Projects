<?php
include('pdo.php'); //connecting docker server 
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>

	<?php
	//showing messages only for a seconds 
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
	include('pdo.php'); //connecting into docker server 
	$fetch = "SELECT * FROM article"; //selecting datas from the database table 
	$fetch1 = $pddo->prepare($fetch); //preparing the query 
	$fetch1->execute();//executing after preparing
	$fetch1->setfetchMode(PDO::FETCH_OBJ); //fetching with obj method
	$result = $fetch1->fetchALL(); //fetching all the fields
	if($result){ //if its is fetched
		foreach($result as $row){ //taking result as row using foreach
			// getting the datas from the database which adming puts 
			?>
			
				<br>
				
			<center>
				
			<h5><?=$row->id;?></h5>
			<h3 style="color:black;"><?=$row->title;?></h3>
			<br>
			<h2><?=$row->category;?></h2>
			<br>
			<li><?=$row->textarea;?></li>
		</center>
		<?php
		//calling the id of the article while clicking edit
		?>
           <a href="editArticle.php?id=<?= $row->id ;?>" style="text-decoration:none; color:black;">Edit</a> 
		   <a href="deleteArticle.php" style="text-decoration:none; color:black;">Delete</a>
		   <!-- <form action = "db.php" method = "POST">
		<button type="submit" name="delete" value="">Delete</button> -->
		</form>
		
			<?php
		}
	}
	else{
			?>
		<td>No records found!</td>
			<?php
		}
		
?>
		<div class = "comments">
		<form action = "userComments.php" method = "POST">
		<h3>Post Your Comments:</h3>
		<input type="text" name="comments" placeholder="Post the comments." required />
		<button type="submit" name="submit" value="submit" class="button3">Post</button>
		</form>			
	</div>

	<?php
	include('pdo.php'); //connecting with docker server
	$fetch_comments = "SELECT * FROM comment"; //query for getting datas from the database table 
	$fetch1_comments = $pddo->prepare($fetch_comments); // preparing query 
	$fetch1_comments->execute(); //executing the query after preparing
	$fetch1_comments->setfetchMode(PDO::FETCH_OBJ); // fetching with the object type
	$resultOfComments = $fetch1_comments->fetchALL(); // and fetching all 
	if($resultOfComments){ // if fetched
		foreach($resultOfComments as $row){ // takes comments as row and 

			// displays it
			?>
			<?=$row->comment;?> 
			<br>
			<?php
		}
	}
	else{ // else displays no comments message
			?>
		<td>No Comments!</td>
			<?php
		}
		
?>
		<footer>
			&copy; Northampton News 2017
		</footer>
		 

	</body>
</html>
