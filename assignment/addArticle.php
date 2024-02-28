<?php
include('db.php') // for connecting into docker server
?>


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
			<li><a href="adminArticle.php">Edit <br> And <br>Delete <br> Article</a></li>
			</nav>

			<article>
				<h2>Add Article</h2>
			


				<form action ='db.php' method ='POST'>
				

					<label>Title</label> <input type="text" name="title" placeholder = "Enter the title." required/>
					<label>Category</label> <input type="text" name="category" placeholder = "Enter the category." required />
					<label>Article</label> <textarea type="text" name="textarea" placeholder = "Write the article." required></textarea>
					<button type="submit" name="submit" value="submit" class="button2">Sumbit</button>
				</form>
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

	</body>
</html>
