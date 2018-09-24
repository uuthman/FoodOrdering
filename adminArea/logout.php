<?php 
include 'core/init.php';
$getFromU->logout();
if ($getFromU->isUserLoggedIn() == false) {
    header('Location: login.php');
}
?>