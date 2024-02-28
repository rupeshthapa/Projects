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
				<li><a href="index.php">LogOut</a></li>
			</ul>
		</nav>
		<!-- <img src="images/banners/randombanner.php" /> -->
		
<?php
// for displaying datas from the database table
include('pdo.php');
$fetch = "SELECT * FROM article";
$fetch1 = $pddo->prepare($fetch);
$fetch1->execute();
$fetch1->setfetchMode(PDO::FETCH_OBJ);
$result = $fetch1->fetchALL();
if($result){
	foreach($result as $row){
		?>
		<br>
		<center>
			<h5><?=$row->id;?></h5>
			<?=$row->category;?>
			<h3 style="color:black;"><?=$row->title;?></h3>
			<br>
			<h2><?=$row->category;?> </h2>
			<br>
			<li><?=$row->textarea;?></li>
		</center>
		<div class = "comments">
		<form action = "userComments.php" method = "POST">
		<h3>Post Your Comments:</h3>
		<input type="text" name="comment" placeholder="Post the comments." required />
		<button type="submit" name="submit" value="submit" class="button3">Post</button>
		</form>			
	</div>
			<?php
		}
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
