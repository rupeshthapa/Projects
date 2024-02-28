<?php
// docker server for database
$server =  "db";
$db="assignment";
$username = "student";
$password = "student";
try{
    $pddo = new PDO("mysql:host=$server; dbname=$db", $username, $password);
}
catch(\Throwable $th){
    $th->getMessage();
}





?>