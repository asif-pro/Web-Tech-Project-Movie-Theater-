<?php
	$admin = true;

	require_once("../library/function.php");

	connectDatabase();

	if(isLoggedIn()) {

		$userid = $_SESSION[LOGIN_SESSION];
    	$user = getUserById($userid);

		if(isEmployee($user)) {
			if(isset($_POST)) {
				
				$movie = isset($_POST['movie']) ? $_POST['movie'] : "";
				$hall = isset($_POST['hall']) ? $_POST['hall'] : "";
				$seatColumn = isset($_POST['seat_column']) ? $_POST['seat_column'] : "";
				$seatRow = isset($_POST['seat_row']) ? $_POST['seat_row'] : "";
				$start = isset($_POST['start']) ? ( !empty($_POST['start']) ? __formatDate($_POST['start'], "Y-m-d H:i:s", "m/d/Y g:i A") : "" ) : "";
				$end = isset($_POST['end']) ? ( !empty($_POST['end']) ? __formatDate($_POST['end'], "Y-m-d H:i:s", "m/d/Y g:i A") : "" ) : "";
				
				if(empty($movie) || empty($hall) || empty($seatColumn) || empty($seatRow) || empty($start) || empty($end)) {
					setTransfer("scheduleAddError", "No fields cannot be empty");
				} else if(empty($__movie = getMovieById($movie))) {
					setTransfer("scheduleAddError", "Movie Not Found");
				} else if(strlen($hall)<3) {
					setTransfer("scheduleAddError", "Invalid Phone no");
				} else if($seatColumn<5 || $seatColumn>10) {
					setTransfer("scheduleAddError", "Column number of the Seats must be in between 5 to 10");
				} else if(!validStartTime($start)) {
					setTransfer("scheduleAddError", "Invalid time to start the schedule");
				} else if(!validEndTime($start, $end)) {
					setTransfer("scheduleAddError", "Invalid time preiod. It must be greater than 2 hours");
				} else if(!empty($duplicate = getScheduleByHallStart($hall, $start))) {
					setTransfer("scheduleAddError", "It might be a duplicate entry");
				} else if(!empty($clash = getScheduleClash($hall, $start))) {
					setTransfer("scheduleAddError", "The schedule has time clash");
				} else if(insertSchedule(array(
					$movie,
					$hall,
					$seatColumn,
					$seatRow,
					$start,
					$end,
					date("Y-m-d H:i:s")
				))) {
					setTransfer("scheduleSuccess", "Schedule of Movie ".$__movie['name']." / ".__formatDate($start, "j/n/Y ( g:i a"). " to ". __formatDate($end, "g:i a )")." Added Successfully");
					header("Location: schedule.php");
					exit;
				} else {
					setTransfer("scheduleAddError", "Something went Wrong. Schedule Not Added");
				}

				setTransfer("scheduleAddData", $_POST);
				header("Location: scheduleadd.php");
				exit;
			}
		} else header("Location: index.php");

	} else header("Location: ../login.php");

?>