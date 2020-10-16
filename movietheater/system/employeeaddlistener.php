<?php
	$admin = true;

	require_once("../library/function.php");

	connectDatabase();

	if(isLoggedIn()) {

		$userid = $_SESSION[LOGIN_SESSION];
    	$user = getUserById($userid);

		if(isAdmin($user)) {
			if(isset($_POST)) {
				$name = isset($_POST['name']) ? $_POST['name'] : "";
				$mobile = isset($_POST['phone']) ? $_POST['phone'] : "";
				$designation = isset($_POST['designation']) ? $_POST['designation'] : "";
				$salary = isset($_POST['salary']) ? $_POST['salary'] : "";
				$email = isset($_POST['email']) ? $_POST['email'] : "";
				$password = isset($_POST['password']) ? $_POST['password'] : "";
				
				if(empty($name) || empty($mobile) || empty($email) || empty($designation) || empty($password) || empty($salary)) {
					setTransfer("employeeAddError", "No fields cannot be empty");
				} else if(strlen($name)<3) {
					setTransfer("employeeAddError", "Invalid Name");
				} else if(!(strlen($mobile)>1 && strlen($mobile)<12)) {
					setTransfer("employeeAddError", "Invalid Phone no");
				} else if(!isValidEmail($email)) {
					setTransfer("employeeAddError", "Invalid Email Address");
				} else if(verifyEmailAssigned($email)) {
					setTransfer("employeeAddError", "Email already exists");
				} else if(strlen($password)<4) {
					setTransfer("employeeAddError", "Weak Password");
				} else if($salary<1) {
					setTransfer("employeeAddError", "Salary must be more than 1");
				} else if(insertUser(array(
					$email,
					md5($password),
					$name,
					$mobile,
					$salary,
					$designation,
					"employee",
					date("Y-m-d H:i:s")
				))) {
					setTransfer("employeeSuccess", "Employee ".$name." Added Successfully");
					header("Location: employee.php");
					exit;
				} else {
					setTransfer("employeeAddError", "Something went Wrong. Employee Not Added");
				}

				setTransfer("employeeAddData", $_POST);
				header("Location: employeeadd.php");
				exit;
			}
		} else header("Location: index.php");

	} else header("Location: ../login.php");

?>