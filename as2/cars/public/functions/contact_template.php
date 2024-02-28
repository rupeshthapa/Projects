<?php
$title = '<title>Claires Cars - Contact</title>';
$content = '<main class="home">
			<h2>Enquiry Form:</h2>
			<form action = "/controller/contact_controller.php" method = "post">
			
			<label>Name:</label>
			<input type="text" name="name" placeholder = "Enter the name." required/>
			
			<label>Email:</label>
			<input type="email" name="email" placeholder = "Enter the email." required/>
			
			<label>Number:</label>
			<input type="number" name="number" placeholder = "Enter the number." required/>
			
			<label>Enquiry:</label>
			<textarea type="text" name="textarea" placeholder = "Write the enquiry." required></textarea>
			
			<input type="submit" name="submit" value="Submit" />
			
			</form>
			</main>';
?>