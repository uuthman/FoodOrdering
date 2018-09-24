<?php 

$dsn = 'mysql:host=localhost; dbname=order';
$user = 'root';
$pass = '';

try{
    $pdo = new PDO($dsn,$user,$pass);
}catch(PDOException $e){
    echo 'connection error! ' . $e->getMessage();
}

?>