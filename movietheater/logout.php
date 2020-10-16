<?php 
	require_once("library/function.php");

	if(isLoggedIn()) {
		unset($_SESSION[LOGIN_SESSION]);
	} 

	header("Location: login.php");