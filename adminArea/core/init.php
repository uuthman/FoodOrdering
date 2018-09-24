<?php 
include 'database/connection.php';
include 'classes/user.php';

//start session
session_start();

global $pdo;

//initialize the classes
$getFromU = new User($pdo);

define("TEMPLATE", '<center><div class="alert alert-primary alert-dismissible col-md-6"><a  class="close" data-dismiss="alert" aria-label="close">&times;</a>%s</div></center>');

?>