<?php 

	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('INSERT INTO manufacturers (name) VALUES (:name)');

		$criteria = [
			'name' => $_POST['name']
		];

		$stmt->execute($criteria);
		echo 'Manufacturer added';
	}
$admtitle = "Clarie's Cars - Admin";
$admcontent = TempLoad('../../views/admin/admaddmanufacturer-template.php',[]);
?>