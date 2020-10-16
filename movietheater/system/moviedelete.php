<?php
    $admin = true;

    require_once("../library/function.php");

    connectDatabase();

    if(isLoggedIn()) {

        $userid = $_SESSION[LOGIN_SESSION];
        $user = getUserById($userid);

        if(isEmployee($user)) {

            $movieid = isset($_REQUEST['movie']) ? $_REQUEST['movie'] : "";

            if(!empty($movieid) && !empty($__movie = getMovieById($movieid))) {

                if(deleteMovie($__movie['id'])) {
                    setTransfer("moviesSuccess", "Movie ".$__movie['name']." Removed Successfully");
                } else {
                    setTransfer("moviesError", "Movie ".$__movie['name']." Not Removed");
                }
            } else {
                setTransfer("moviesError", "Movie Not Found");
            }    
            header("Location: movies.php");
            exit; 
        } else header("Location: index.php");

    } else header("Location: ../login.php");

?>