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
        
        <main>
        <nav>
            <a href="addAdmin.php">Add Admin</a>
            </nav>


        
	<?php
	include('pdo.php');
	$fetch = "SELECT * FROM admin";
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
			<h3 style="color:black;"><?=$row->name;?></h3>
			<br>
			<h2><?=$row->email;?> </h2>
			<br>
			<li><?=$row->password;?></li>
		   <a href= "editAdmin.php?id=<?= $row->id ;?>" style="text-decoration:none; color:black">Edit</a>
            <a href="deleteAdmin.php" style="text-decoration:none; color:black">Delete</a>
			</center>
			<?php
		}
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
