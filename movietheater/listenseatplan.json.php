<?php 

$data = array();

require_once("library/function.php");

if(isset($_POST['schedule'])) {
	if(isLoggedIn()) {
	    connectDatabase();
	    $userid = $_SESSION[LOGIN_SESSION];
	    $user = getUserById($userid);
	    if($user['role']=="customer") {
	        $id = $_POST['schedule'];
	        if(!empty($id) && !empty($__schedule = getScheduleById($id))) {

        		$seatsBooked = getSeatsByScheduleId($id);
        		
        		$data = array(
        			'column' => $__schedule['seat_column'],
        			'row' => $__schedule['seat_row'],
        			'booked' => !empty($seatsBooked) ? $seatsBooked : array()
        		);	
	        }
	    }
	}
}

echo json_encode($data);


