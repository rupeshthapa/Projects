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
						<li><a class="articleLink" href="localnews.php">Local News</a></li>
						<li><a class="articleLink" href="sports.php">Sports</a></li>
						<li><a class="articleLink" href="technology.php">Technology</a></li>
						<li><a class="articleLink" href="business.php">Business</a></li>
					</ul>
				</li>
				<li><a href="loginpage.php">LogIn</a></li>
				<a href="register.php">Register Here</a>
			</ul>
		</nav>
		<!-- <img src="images/banners/randombanner.php" /> -->
		

	<?php
	include('pdo.php');
	$fetch = "SELECT * FROM articles";
	$fetch1 = $pddo->prepare($fetch);
	$fetch1->execute();
	$fetch1->setfetchMode(PDO::FETCH_OBJ);
	$result = $fetch1->fetchALL();
	if($result){
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
	else{
			?>
		<td>No records found!</td>
			<?php
		}
		
?>
		<div class = "comments">
		<form action = "comments.php" method = "POST">
		<h3>Post Your Comments:</h3>
		<input type="text" name="comments" placeholder="Post the comments." required />
		<button type="submit" name="submit" value="submit" class="button3">Post</button>
		</form>			
	</div>

	<?php
	include('pdo.php');
	$fetch_comments = "SELECT * FROM comments";
	$fetch1_comments = $pddo->prepare($fetch_comments);
	$fetch1_comments->execute();
	$fetch1_comments->setfetchMode(PDO::FETCH_OBJ);
	$resultOfComments = $fetch1_comments->fetchALL();
	if($resultOfComments){
		foreach($resultOfComments as $row){
			?>
			<?=$row->comments;?>
			<br>
			<?php
		}
	}
	else{
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
