<?php 

$data = array();

require_once("library/function.php");

if(isset($_POST['movie']) && isset($_POST['hall'])) {
	if(isLoggedIn()) {
	    connectDatabase();
	    $userid = $_SESSION[LOGIN_SESSION];
	    $user = getUserById($userid);
	    if($user['role']=="customer") {
	        $movieid = $_POST['movie'];
	        $hall = $_POST['hall'];
	        if(!empty($movieid) && !empty($__movie = getMovieById($movieid)) && hasScheduleValid($movieid)) {

        		$schedules = getSchedulesByMovieHall($movieid, $hall);

        		foreach ($schedules as $__schedule) {
        			$content = array(
        				'option' => $__schedule['id'],
        				'value' => __formatDate($__schedule['start'], "j/n/Y ( g:i a"). " to ". __formatDate($__schedule['end'], "g:i a )")
        			);

        			$data[] = $content;
        		}
	        }
	    }
	}
}

echo json_encode($data);


