<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <title>Northampton News - Home</title>
</head>
<body>
<?php
// for displaying message of deleted successfully and not deleted successfully 
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
						<li><a class="articleLink" href="#">Local News</a></li>
						<li><a class="articleLink" href="#">Sports</a></li>
						<li><a class="articleLink" href="#">Technology</a></li>
						<li><a class="articleLink" href="#">Business</a></li>
					</ul>
				</li>
				<li><a href="addArticle.php">Add Article</a></li>
				<li><a class="articleLink" href="manageAdmins.php">Manage Admin</a></li>
                <li><a class="articleLink" href="manageCategories.php">Manage Categories</a></li>
			</ul>
		</nav>
		
		<!-- <img src="images/banners/randombanner.php" /> -->
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				
			</nav>


        <article>
	<?php
	include('pdo.php'); //connecting with docker server
	$fetch = "SELECT * FROM admin"; // query to get datas from the table 
	$fetch1 = $pddo->prepare($fetch); // preparing the query
	$fetch1->execute(); // executing the query 
	$fetch1->setfetchMode(PDO::FETCH_OBJ); // fetching with object method
	$result = $fetch1->fetchALL(); // after that fetching all datas
	if($result){ // fetched
		foreach($result as $row){ // display 
			?>
            <br>
				<center>
					<br>
				<form action = "db.php" method = "POST">
		<button type="submit" name="delete_admin"  value="<?=$row->id ;?>" style="border-radius:10px; width:60px;">Delete</button> 
		
		</form>
	
			<h5><?=$row->id;?></h5>
			<h3 style="color:black;"><?=$row->name;?></h3>
			<br>
			<h2><?=$row->email;?> </h2>
			<br>
			<li><?=$row->password;?></li>
		
		</center>
         
			<?php
		} //in line number 64 taking id of the admin on button 
	}
	else{
			?>
		<td>No records found!</td>
			<?php
		}
		
?>
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

</body>
</html>
