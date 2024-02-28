<?php
include('pdo.php')
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <h2>Add Admin:</h2>
                <form action ='db.php' method='POST'>
                <label>Name:</label>
                <input type ="text" name="name" placeholder="Enter your fullname" required><br>
                <label>Email:</label>
                <input type ="email" name="email" placeholder="Enter your email." required><br>
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password." required><br><br>
                <button type="submit" name="add" value="add" class="button">Sumbit</button>
</form>
    
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

</body>
</html>