<?php
	$admin = true;

	require_once("../library/function.php");

	connectDatabase();

	if(isLoggedIn()) {

		$userid = $_SESSION[LOGIN_SESSION];
    	$user = getUserById($userid);

		if(isEmployee($user)) {
			if(isset($_POST)) {
				$name = isset($_POST['name']) ? $_POST['name'] : "";
				$genre = isset($_POST['genre']) ? $_POST['genre'] : "";
				$rating = isset($_POST['rating']) ? $_POST['rating'] : "";
				$type = isset($_POST['movie_type']) ? $_POST['movie_type'] : "";
				$poster = isset($_FILES['poster']) ? $_FILES['poster'] : '';
				$uploaded = "";

				if(empty($name) || empty($genre) || empty($type)) {
					setTransfer("movieAddError", "Name, Genre, Type can't be empty");
				} else if(strlen($name)<3) {
					setTransfer("movieAddError", "Invalid Name");
				} else if(!empty($exists = getMovieByName($name))) {
					setTransfer("movieAddError", "Movie with the same name is already exists. Try with different one");
				} else if(strlen($genre)<3) {
					setTransfer("movieAddError", "Invalid Genre");
				} else if(!is_numeric($rating)) {
					setTransfer("movieAddError", "Invalid Rating");
				} else if(isFilePosted($poster) && !verifyImageType($poster)) {
			        setTransfer("movieAddError", "Only .jpg, .png, .gif images are allowed");
			    } else if (isFilePosted($poster) && !verifyImageSize($poster)) {
			        setTransfer("movieAddError", "Files over 2MB isn\'t allowed");
			    } else if(isFilePosted($poster) && empty($uploaded = uploadFile($poster))) {
			    	setTransfer("movieAddError", "Files uploading error occured.");
			    } else if(insertMovie(array(
					$name,
					$genre,
					!empty($rating) ? $rating : 0,
					$uploaded,
					encodeMovieType($type),
					date("Y-m-d H:i:s")
				))) {
					setTransfer("moviesSuccess", "Movie ".$name." Added Successfully");
					header("Location: movies.php");
					exit;
				} else {
					setTransfer("movieAddError", "Something Went Wrong. Movie Couldn't be added.");
					removeUploaded($uploaded);
				}

				setTransfer("movieAddData", $_POST);
				header("Location: movieadd.php");
				exit;
			}
		} else header("Location: index.php");

	} else header("Location: ../login.php");

?>