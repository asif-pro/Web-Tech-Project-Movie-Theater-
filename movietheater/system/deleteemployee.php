<?php
    $admin = true;

    require_once("../library/function.php");

    connectDatabase();

    if(isLoggedIn()) {

        $employeeid = $_SESSION[LOGIN_SESSION];
        $user = getUserById($employeeid);

        if(isAdmin($user)) {

            $employeeid = isset($_REQUEST['employee']) ? $_REQUEST['employee'] : "";

            if(!empty($employeeid) && !empty($__employee =  getUserById($employeeid)) && isEmployee($__employee)) {

                if(deleteUser($__employee['id'])) {
                    setTransfer("employeeSuccess", "Employee ".$__movie['name']." Removed Successfully");
                } else {
                    setTransfer("employeeError", "Employee ".$__movie['name']." Not Removed");
                }
            } else {
                setTransfer("employeeError", "Employee Not Found");
            }    
            header("Location: employee.php");
            exit; 
        } else header("Location: index.php");

    } else header("Location: ../login.php");

?>