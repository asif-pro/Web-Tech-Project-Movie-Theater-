<?php
require_once("library/function.php");
if(isset($_POST)) {
	if(isLoggedIn()) {
	    connectDatabase();
	    $userid = $_SESSION[LOGIN_SESSION];
	    $user = getUserById($userid);
	    if($user['role']=="customer") {
	        $schedule = isset($_POST['show-time']) ? $_POST['show-time'] : "";
	        $seats = isset($_POST['choosen_seat']) ? $_POST['choosen_seat'] : "";
	        if(!empty($schedule) && !empty($__schedule = getScheduleById($schedule))) {
		        	$st = array();

		        	foreach ($seats as $seat) {
		        		if(!empty($seat))$st[] = $seat;
		        	}

		        	if(!empty($st)) {
		        		if(!empty($ticketid = insertTicket(array(
		        			$__schedule['id'],
		        			$user['id'],
		        			count($st),
		        			200,
		        			count($st)*200,
		        			date("Y-m-d H:i:s")
		        		)))) {
		        			foreach ($st as $as => $__seat) {
		        				insertSeats(array(
		        					$ticketid,
		        					$__seat
		        				));
		        			}


		        			setTransfer("bookingConfirmation", $ticketid);

		        			header("Location: confirmbooking.php");
		        			exit;
		        		} else {
		        			header("Location: index.php");
		        			exit;
		        		}
		        	} else {
		        		header("Location: index.php");
		        		exit;
		        	}
	        	} else {
	            setTransfer("indexMovieError", "No Movie Found");
	            header("Location: index.php");
	            exit;
	        }
	    } else {
	        header("Location: system/index.php");
	        exit;
	    }
	} else {
	    header("Location: index.php");
	    exit;
	}
}
