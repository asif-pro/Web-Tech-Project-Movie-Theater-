<?php
if(isset($admin)) {
	require_once("../library/config.php");
	require_once("../library/database.php");
} else {
	require_once("library/config.php");
	require_once("library/database.php");
}


if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

function isLoggedIn() {
	return isset($_SESSION[LOGIN_SESSION]) && !empty($_SESSION[LOGIN_SESSION]);
}

function isValidEmail($email) {
	$dotPos = strpos($email, ".");
	$atPos = strpos($email, "@");

	return ($atPos && $dotPos && $atPos<$dotPos);
}

function isAdmin($user) {
	if(!empty($user)) {
		return $user['role']=='admin';
	}
	return false;
}

function isEmployee($user) {
	if(!empty($user)) {
		return $user['role']=='employee';
	}
	return false;
}

function getPoster($poster="") {
	global $admin;

	$uploads = isset($admin) ? "../uploads/"  : "uploads/";
	$default = isset($admin) ? "../img/default_poster.jpg" : "img/default_poster.jpg";
	$uploaded = $uploads.$poster;

	return !empty($poster) && file_exists($uploaded) ? $uploaded : $default;
}

function decodeMovieType($type="") {
	return $type=='1' ? "Upcoming" : "Now Showing";
}

function encodeMovieType($type="") {
	return $type=='upc' ? "1" : "0";
}

function __formatDate($date, $output = "Y-m-d H:i:s", $input = 'Y-m-d H:i:s')
{
    if(__validDate($date, $input)) {
        $dObject = DateTime::createFromFormat($input, $date);
        return $dObject->format($output);
    }
    
    return "";
}


function __validDate($date, $format="Y-m-d H:i:s")
{
    $dObject = DateTime::createFromFormat($format, $date);
    return $dObject && $dObject->format($format) === $date;
}

function __preiodStatus($start, $end, $style=true) {
    
    date_default_timezone_set('Asia/Dhaka');

    $start = DateTime::createFromFormat("Y-m-d H:i:s", $start);
    $end = DateTime::createFromFormat("Y-m-d H:i:s", $end);
    $now = new DateTime();

    if($now>=$start && $now<=$end) 
        return $style ? "<span class=\"label label-success\">Running</span>":"Running";
    else if($now>$end)
        return $style ? "<span class=\"label label-default\">Passed</span>":"Passed";
    else if($now<$start)
        return $style ? "<span class=\"label label-primary\">Latterly</span>":"Latterly";

    else return $style ? "<span class=\"label label-warning\">Undetected</span>":"Undetected";
}

function validStartTime($start) {
    date_default_timezone_set('Asia/Dhaka');

    $start = DateTime::createFromFormat("Y-m-d H:i:s", $start);
    $now = new DateTime();

    return $start>=$now;
}

function validEndTime($start, $end) {
    date_default_timezone_set('Asia/Dhaka');

    $start = DateTime::createFromFormat("Y-m-d H:i:s", $start);
    $end = DateTime::createFromFormat("Y-m-d H:i:s", $end);
    $difference = $end->diff($start); 

    return $end>$star && $difference->format('%h')>=2;
}

function randString($length = 10) 
{
    $charSet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $generated = '';
    for ($i = 0; $i < $length; $i++) {
        $generated .= $charSet[rand(0, strlen($charSet) - 1)];
    }
    return $generated;
}

function isFilePosted($file) {
	return isset($file['tmp_name']) && !empty($file['tmp_name']) && isset($file['error']) && $file['error']==UPLOAD_ERR_OK;
}

function verifyImageType($file)
{
    if(isset($file['tmp_name']) && !empty($file['tmp_name']))
    {
        $allowed = array(
            IMAGETYPE_JPEG,
            IMAGETYPE_PNG,
            IMAGETYPE_GIF
        );

        if($imageDetails = getimagesize($file['tmp_name']))
        {
            return (isset($imageDetails[2]) && in_array($imageDetails[2], $allowed));
        }
    }

    return false;
}

function verifyImageSize($file)
{
    if(isset($file['size']) && $file['size']>0)
    {
        return ($file['size']/1024)<2048;
    }
    return false;
}

function uploadFile($file)
{
	global $admin;

    $filename = '';

    if(isset($file['tmp_name']) && !empty($file['tmp_name']))
    {
        if($filename = generateNewFileName($file))
        {
        	$dir = (isset($admin) ? "../": "").'uploads';
            $path =  $dir.'/'. $filename;

            if(is_dir($dir) && !file_exists($path))
            {
                if(!move_uploaded_file($file['tmp_name'], $path))
                {
                    $filename = '';
                }
            }
        }

    }

    return $filename;
}

function removeUploaded($uploaded) {
	global $admin;

	$dir = (isset($admin) ? "../": "").'uploads';
	$path = $dir.'/'. $uploaded;
	if(is_file($path) && file_exists($path)) unlink($path);
}

function generateNewFileName($file)
{
    $filename = null;

    if(isset($file['name']) && !empty($file['name']))
    {
        if($ext = pathinfo($file['name'], PATHINFO_EXTENSION))
        {
            $filename = md5(time().randString()) . '.' . $ext;
        }
    }

    return $filename;
}

function getTransfer($key) {
	$value = "";

	if(isset($_SESSION[$key])) {
		$value = $_SESSION[$key];
		unset($_SESSION[$key]);
	}

	return $value;
}

function setTransfer($key, $value) {
	$_SESSION[$key] = $value;
}