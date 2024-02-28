<?php 
	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('INSERT INTO cars (name, description, price, manufacturerId) 
							   VALUES (:model, :description, :price, :manufacturerId)');

		$criteria = [
			'model' => $_POST['model'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'manufacturerId' => $_POST['manufacturerId']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../images/cars/' . $fileName);
		}

		echo 'Car added';
	}
	$admtitle = "Clarie's Cars - Admin";
	$admcontent = TempLoad('../../views/admin/admaddcar-template.php',[]);
	?>