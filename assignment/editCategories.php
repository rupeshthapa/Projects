<?php
include('pdo.php');
?> 


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
<header>
<?php
	if(isset($_SESSION['message'])) : ?>
	<h5> <?= $_SESSION['message']; ?></h5>
	<?php
	unset($_SESSION['message']);
	endif;
	?>
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
            
            </nav>
 
            <h2>Edit Category:</h2>
    


			<?php

if(isset($_GET['category_id']))
{ 
	// getting id of the category
	$category_id = $_GET['category_id'];

	$query = "SELECT * FROM category WHERE category_id=:category_id"; // query for selecting data from the database table
	$statement = $pddo->prepare($query); // preparing the query
	$data = [':category_id' => $category_id]; // checking the datas
	$statement->execute($data); // executing the query

	$data = $statement->fetch(PDO::FETCH_ASSOC); // fetching with asscociation method
		

		?>	
                <form action ='db.php' method='POST'>
                <input type="hidden" name="category_id" value = "<?= $data['category_id']?>"/>
                <label>Category</label> <input type="text" name="category" placeholder = "Enter the category."  value="<?=$data['name']; ?>"required />
                <button type="submit" name="editCategory" value="editCategory" class="button">Edit</button>
  
            </form>

			<?php
}
else{
	echo"<h5> No ID Found!</h5>";
}
    ?>
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

</body>
</html>
