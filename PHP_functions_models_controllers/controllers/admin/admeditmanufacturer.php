<?php
	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE manufacturers SET name = :name WHERE id = :id ');

		$criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);
		echo 'Manufacturer Saved';
	}
$admtitle = "Clarie's Cars - Admin";
$admcontent = TempLoad('../../views/admin/editmanu-template.php',[]);
	?>