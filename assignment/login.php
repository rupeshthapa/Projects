<!DOCTYPE html>
<html>
	<head>
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
						

			<li><a class="articleLink" href="localnews.php">
					
</a>
</li>

					</ul>
				</li>
				<li><a href="login.php">LogIn</a></li>
				<a href="register.php">Register Here</a>
			</ul>
		</nav>
		<!-- <img src="images/banners/randombanner.php" /> -->
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
			
			</nav>

			<article>
            <h2>Login Form</h2>
                <form action ='db.php' method='POST'>
            <label>E-mail:</label>
            <input type ="email" name="email" placeholder="Enter your email." required><br>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password." required>
            <button type="submit" name="button" value="submit" class="button">sumbit</button>
</form>

					

			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

	</body>
</html>