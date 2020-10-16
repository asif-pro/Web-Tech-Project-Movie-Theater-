<?php
	$admin = true;

	require_once("../library/function.php");

	connectDatabase();

	if(isLoggedIn()) {

		$userid = $_SESSION[LOGIN_SESSION];
    	$user = getUserById($userid);

		if(isAdmin($user)) {
			if(isset($_POST)) {

				$id = isset($_POST['employee']) ? $_POST['employee'] : "";
        
    			if(!empty($id) && !empty($__employee =  getUserById($id)) && isEmployee($__employee)) {

					$name = isset($_POST['name']) ? $_POST['name'] : "";
					$mobile = isset($_POST['phone']) ? $_POST['phone'] : "";
					$designation = isset($_POST['designation']) ? $_POST['designation'] : "";
					$salary = isset($_POST['salary']) ? $_POST['salary'] : "";
					$email = isset($_POST['email']) ? $_POST['email'] : "";
					$password = isset($_POST['password']) ? $_POST['password'] : "";
					
					if(empty($name) || empty($mobile) || empty($email) || empty($designation) || empty($salary)) {
						setTransfer("employeeEditError", "No fields cannot be empty");
					} else if(strlen($name)<3) {
						setTransfer("employeeEditError", "Invalid Name");
					} else if(!(strlen($mobile)>1 && strlen($mobile)<12)) {
						setTransfer("employeeEditError", "Invalid Phone no");
					} else if(!isValidEmail($email)) {
						setTransfer("employeeEditError", "Invalid Email Address");
					} else if($email!=$__employee['email'] && verifyEmailAssigned($email)) {
						setTransfer("employeeEditError", "Email already exists");
					} else if(!empty($password) && strlen($password)<4) {
						setTransfer("employeeEditError", "Weak Password");
					} else if($salary<1) {
						setTransfer("employeeEditError", "Salary must be more than 1");
					} else if(updateUser($__employee['id'], array(
						$email,
						!empty($password) ? md5($password) : $__employee['password'],
						$name,
						$mobile,
						$salary,
						$designation
					))) {
						setTransfer("employeeSuccess", "Employee ".$__employee['name']." Updated Successfully");
						header("Location: employee.php");
						exit;
					} else {
						setTransfer("employeeEditError", "Please make any changes to update employee");
					}

					setTransfer("employeeEditId", $id);
					setTransfer("employeeEditData", $_POST);
					header("Location: editemployee.php");
					exit;
				} else {
					setTransfer("employeeError", "Employee Not Found");
		            header("Location: employee.php");
		            exit;
				}
			}
		} else header("Location: index.php");

	} else header("Location: ../login.php");

?>