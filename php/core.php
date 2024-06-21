<?php 

session_start();
$port= 3000;
require_once 'db_connect.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location: http://localhost:'.$port.'/stock/index.php');	 # check dpport, it was 9080 before.
} 
?>