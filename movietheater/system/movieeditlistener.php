<?php
    $admin = true;

    require_once("../library/function.php");

    connectDatabase();

    if(isLoggedIn()) {

        $userid = $_SESSION[LOGIN_SESSION];
        $user = getUserById($userid);

        if(isEmployee($user)) {
            if(isset($_POST)) {
                $movieid = isset($_POST['movie']) ? $_POST['movie'] : "";
                if(!empty($movieid) && !empty($__movie = getMovieById($movieid))) {
                    $name = isset($_POST['name']) ? $_POST['name'] : "";
                    $genre = isset($_POST['genre']) ? $_POST['genre'] : "";
                    $rating = isset($_POST['rating']) ? $_POST['rating'] : "";
                    $type = isset($_POST['movie_type']) ? $_POST['movie_type'] : "";
                    $poster = isset($_FILES['poster']) ? $_FILES['poster'] : '';
                    $uploaded = "";
                    $previousPoster = $__movie['poster']; 

                    if(empty($name) || empty($genre) || empty($type)) {
                        setTransfer("movieEditError", "Name, Genre, Type can't be empty");
                    } else if(strlen($name)<3) {
                        setTransfer("movieEditError", "Invalid Name");
                    } else if($name!= $__movie['name'] && !empty($exists = getMovieByName($name))) {
                        setTransfer("movieEditError", "Movie with the same name is already exists. Try with different one");
                    } else if(strlen($genre)<3) {
                        setTransfer("movieEditError", "Invalid Genre");
                    } else if(!is_numeric($rating)) {
                        setTransfer("movieEditError", "Invalid Rating");
                    } else if(isFilePosted($poster) && !verifyImageType($poster)) {
                        setTransfer("movieEditError", "Only .jpg, .png, .gif images are allowed");
                    } else if (isFilePosted($poster) && !verifyImageSize($poster)) {
                        setTransfer("movieEditError", "Files over 2MB isn\'t allowed");
                    } else if(isFilePosted($poster) && empty($uploaded = uploadFile($poster))) {
                        setTransfer("movieEditError", "Files uploading error occured.");
                    } else if(updateMovie($__movie['id'], array(
                        $name,
                        $genre,
                        !empty($rating) ? $rating : 0,
                        !empty($uploaded) ? $uploaded : $previousPoster,
                        encodeMovieType($type)
                    ))) {
                        $changed = !empty($uploaded) ? $uploaded : $previousPoster;
                        if($changed!=$previousPoster) removeUploaded($previousPoster);
                        setTransfer("moviesSuccess", "Movie ".$__movie['name']." Updated Successfully");
                        header("Location: movies.php");
                        exit;
                    } else {
                        removeUploaded($uploaded);
                        setTransfer("movieEditError", "Please make changes to update information");
                    } 

                    setTransfer("movieEditData", $_POST);
                    setTransfer("movieEditId", $movieid);
                    header("Location: movieedit.php");
                    exit;
                } else {
                    header("Location: movies.php");
                    exit;
                }
            }
        } else header("Location: index.php");

    } else header("Location: ../login.php");

?>