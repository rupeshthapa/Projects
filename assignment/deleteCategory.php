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
				<li><a class="articleLink" href="manageAdmins.php">Manage Admin</a></li>
				<li><a class="articleLink" href="manageCategories.php">Manage Categories</a></li>
			</ul>
		</nav>


        
	<?php
	include('pdo.php');
	$fetch = "SELECT * FROM newcategory";
	$fetch1 = $pddo->prepare($fetch);
	$fetch1->execute();
	$fetch1->setfetchMode(PDO::FETCH_OBJ);
	$result = $fetch1->fetchALL();
	if($result){
		foreach($result as $row){
			?>
            <br>
            <?=$row->id;?>
			<?=$row->newCategory;?>
            <form action = "db.php" method = "POST">
		<button type="submit" name="delete_category" value="<?=$row->id ;?>">Delete</button>
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
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

</body>
</html>
