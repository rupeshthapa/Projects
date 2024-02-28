 <?php

include('pdo.php');
?> 
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css" type="text/css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<?php

		// for getting successfull and not successfull message
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
				<li><a href="manageAdmins.php">Manage Admin</a>
				<li><a href="manageCategories.php">Manage Categories</a></li>
			</ul>
		</nav>
	
		
		
	
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				<ul>
					
				</ul>
			</nav>

			<article>
				<h2>Edit Article:</h2>
	

		
		<?php

if(isset($_GET['id']))
{ 
	// getting id of the article
	$article_id = $_GET['id'];

	$query = "SELECT * FROM article WHERE id=:article_id"; // query for selecting data from the database table
	$statement = $pddo->prepare($query); // preparing the query
	$data = [':article_id' => $article_id]; // checking the datas
	$statement->execute($data); // executing the query

	$data = $statement->fetch(PDO::FETCH_ASSOC); // fetching with asscociation method

		

		?>	


				<form action ='db.php' method ='POST'>
					<p>Forms are styled like so:</p>
					<input type="hidden" name="article_id" value = "<?= $data['id']?>"/>
					<label>Title</label> 
                    <input type="text" name="title" value="<?=$data['title']; ?>" />
					<label>Category</label> 
                    <input type="text" name="category" value="<?=$data['category']; ?>" />
					<label>Article</label>
                    <textarea type="text" name="textarea" value="<?=$data['textarea']; ?>"></textarea>
					<button type="submit" name="edit" value="edit" class="button2">Sumbit</button>
				</form>
			
				<?php
} // in line number 87 id is hidden and in line number 89, 91 and 93 it will display previous datas
	else{
		echo "<h5>No ID Found</h5>";
}
?> 
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

	</body>
</html>


