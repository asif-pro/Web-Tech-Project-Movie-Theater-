<?php

	require_once("library/function.php");

	connectDatabase();

	if(!isLoggedIn()) {

		if(isset($_POST)) {
			$name = isset($_POST['full_name']) ? $_POST['full_name'] : "";
			$mobile = isset($_POST['mobile_no']) ? $_POST['mobile_no'] : "";
			$email = isset($_POST['email_address']) ? $_POST['email_address'] : "";
			$password = isset($_POST['password']) ? $_POST['password'] : "";
			$confirmpassword = isset($_POST['con-password']) ? $_POST['con-password'] : "";

			if(empty($name) || empty($mobile) || empty($email) || empty($password) || empty($confirmpassword)) {
				echo "No fields cannot be empty";
			} else if(strlen($name)<3) {
				echo "Invalid Name";
			} else if(!(strlen($mobile)>1 && strlen($mobile)<12)) {
				echo "Invalid Phone no";
			} else if(!isValidEmail($email)) {
				echo "Invalid Email Address";
			} else if(verifyEmailAssigned($email)) {
				echo "Email already exists";
			} else if(strlen($password)<4) {
				echo "Weak Password";
			} else if($password!=$confirmpassword) {
				echo "Confirm Password doesn't match";
			} else if(insertUser(array(
				$email,
				md5($password),
				$name,
				$mobile,
				null,
				null,
				"customer",
				date("Y-m-d H:i:s")
			))) {
				header("Location: login.php");
				exit;
			} else {

				header("Location: index.php");
				exit;
			}
		}

	} else header("Location: login.php");

?>