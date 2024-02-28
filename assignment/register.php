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
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
        
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Select Category</a>
					<ul>
						

			<li><a class="articleLink" href="localnews.php">	<?php
	include('pdo.php');
	$fetch = "SELECT * FROM category";
	$fetch1 = $pddo->prepare($fetch);
	$fetch1->execute();
	$fetch1->setfetchMode(PDO::FETCH_OBJ);
	$result = $fetch1->fetchALL();
	if($result){
		foreach($result as $row){
			?>
		
			<li><?=$row->name;?></li>
			
			<?php
		}
	}
	else{
			?>
		<td>No records found!</td>
			<?php
		}
?>
</a>
</li>
<!-- 
						<li><a class="articleLink" href="sports.php">Sports</a></li>
						<li><a class="articleLink" href="technology.php">Technology</a></li>
						<li><a class="articleLink" href="business.php">Business</a></li> -->
					</ul>
				</li>
				<li><a href="login.php">LogIn</a></li>
				<a href="register.php">Register Here</a>
			</ul>
		</nav>
		<!-- <img src="images/banners/randombanner.php" /> -->
        <main>
        <nav>
            
            </nav>
                <h2>Registration Form</h2>
                <form action ='db.php' method='POST'>
                <label>Name:</label>
                <input type ="text" name="name" placeholder="Enter your fullname" required><br>
                <label>Email:</label>
                <input type ="email" name="email" placeholder="Enter your email." required><br>
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password." required><br><br>
                <button type="submit" name="submit" value="submit" class="button">sumbit</button>
</form>
    
			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

</body>
</html>