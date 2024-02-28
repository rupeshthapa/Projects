<?php
	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE cars
								SET name = :name, 
								    description = :description, 
								    price = :price,
								    manufacturerId = :manufacturerId
								   WHERE id = :id 
						');

		$criteria = [
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'price' => $_POST['price'],
			'manufacturerId' => $_POST['manufacturerId'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);

		if ($_FILES['image']['error'] == 0) {
			$fileName = $pdo->lastInsertId() . '.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'], '../productimages/' . $fileName);
		}

		echo 'Product saved';
	}
$admtitle = "Clarie's Cars - Admin";
$admcontent = TempLoad('../../views/admin/admeditcar-template.php',[]);
	?>