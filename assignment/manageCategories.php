<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css" type="text/css"/>
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
				<ul>
					<li><a href="addCategories.php" >Add Category</a></li>
					
				</ul>
			</nav>

			<article>
				<h2>A Page Heading</h2>
                <?php
	include('pdo.php');
	$fetch_comments = "SELECT * FROM category";
	$fetch1_comments = $pddo->prepare($fetch_comments);
	$fetch1_comments->execute();
	$fetch1_comments->setfetchMode(PDO::FETCH_OBJ);
	$resultOfComments = $fetch1_comments->fetchALL();
	if($resultOfComments){
		foreach($resultOfComments as $row){
			?>
			<br>
			<?=$row->category_id ;?>
			<br>
			<?=$row->name;?>
			<br>
            <a href="editCategories.php?id=<?= $row->category_id ;?>">Edit</a>
            <a href="deleteCategory.php">Delete</a>
			<br>
			<?php
		}
	}
	else{
			?>
		<td>No Categories!</td>
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
