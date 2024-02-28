<?php
ob_start();
session_start();
// Connect to database
$pdo = new PDO('mysql:dbname=cars;host=db', 'student', 'student');


if (isset($_POST['submit'])) {
  
  if ($_FILES['image']['error'] == 0) {
    $fileName = $pdo->lastInsertId() . '.jpg';
    move_uploaded_file($_FILES['image']['tmp_name'], '../images/angles/' . $fileName);

    $query = "INSERT INTO images (image, type, carsId) VALUES (:image, 'image/jpeg', :carsId)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':carsId', $_POST['carsId'], PDO::PARAM_INT);
    $stmt->bindValue(':image', file_get_contents('../images/angles/' . $fileName), PDO::PARAM_LOB);
    $stmt->execute();
    if($stmt){

      $_SESSION['carsId'] = $_GET['carsId'];
      echo "Image inserted successfully!";
      header('Location: cars.php');


    }

  
  }

}


?>




