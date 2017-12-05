<?php

session_start();

if(isset($_SESSION['username']) || !empty($_SESSION['username'])){
	session_destroy();
	setcookie('PHPSESSID','', time() - 100);
	header("location: index.php");
	exit;
}

?>