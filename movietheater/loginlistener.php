<?php

	require_once("library/function.php");

	connectDatabase();

	if(!isLoggedIn()) {

		if(isset($_POST)) {
			$email = isset($_POST['email']) ? $_POST['email'] : "";
			$password = isset($_POST['password']) ? $_POST['password'] : "";
			$referrer = isset($_POST['referrer']) ? $_POST['referrer'] : "";
			$user = null;
			if(empty($email)) {
				echo "Email Cannot be empty";
			} else if(empty($password)) {
				echo "Password Cannot be empty";
			} else if(empty($user = getUserByEmail($email))) {
				echo "Email not found";
			} else if((!empty($user) && $user['password']!=md5($password)) || empty($user)) {
				echo "Password doesn't match";
			} else {
				$_SESSION[LOGIN_SESSION] = $user['id'];

				if(!empty($referrer)) {
					$_SESSION[MOVIE_ID] = $referrer;
					header("Location: booking.php");
					exit;
				} else if($user['role'] == 'admin' || $user['role'] == 'employee') {
					header("Location: system/index.php");
					exit;
				}

				header("Location: index.php");
				exit;
			}
		}

	} else header("Location: login.php");

?>