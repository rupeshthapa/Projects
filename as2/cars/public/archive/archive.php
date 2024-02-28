<?php
ob_start();

$connectionForDatabase = new PDO('mysql:dbname=cars;host=db', 'student', 'student');

if (isset($_POST['updateButton'])) {
    if ($_POST['archived'] == 0) {
        $archiveCars = $connectionForDatabase->prepare("UPDATE cars SET archived = 1 WHERE id = ?");
        $archived = 1;
       
        header('Location: ../admin/cars.php');
        echo'Archived';
    } else {
        $archiveCars = $connectionForDatabase->prepare("UPDATE cars SET archived = 0 WHERE id = ?");
        $archived = 0;
        
        header('Location: ../admin/cars.php');
        echo'Unarchived';
    }
    $archiveCars->execute([$_POST['id']]);
    
}





?>