<?php
// for inserting into the database table
    include ('pdo.php');   
    
    if(isset($_POST['submit'])){
   
        $comments = $_POST['comment'];
        $query4 ="INSERT INTO comment (comment)VALUES(:comment)";
        $statements =$pddo->prepare($query4);
        $statements->bindparam(':comment',$comments);
        $statements->execute();
        include('index.php');
                                } 
    
?>