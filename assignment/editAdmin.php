




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
// for getting successfull and not successfull message
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
        
        <main>
        <nav>
            
            </nav>
 
            <h2>Add Admin:</h2>
            <?php
            if(isset($_GET['id'])) // getting id of a admin
{
	$admin_id = $_GET['id']; // after clicking on edit link

	$query = "SELECT * FROM admin WHERE id=:admin_id"; // getting datas from the database table query
	$statement = $pddo->prepare($query); // preparing query
	$data = [':admin_id' => $admin_id]; // checking datas
	$statement->execute($data); // executing query 

	$data = $statement->fetch(PDO::FETCH_ASSOC); //fetching with association methon 
		

		?>	

                <form action ='db.php' method='POST'>
                <input type="hidden" name="admin_id" value = "<?= $data['id']?>"/>
                <label>Name:</label>
                <input type ="text" name="name" placeholder="Enter your fullname"  value = "<?= $data['name'] ;?>" required><br>
                <label>Email:</label>
                <input type ="email" name="email" placeholder="Enter your email." value = "<?= $data['email'] ;?>"  required><br>
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password." value = "<?= $data['password'] ;?>" required><br><br>
                <button type="submit" name="editAdmin" value="editAdmin" class="button">Edit</button>
  
            </form>
            <?php
} // in line number 74 id is hidden, in 76, 78 and 80 it displays the previous data, 
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
