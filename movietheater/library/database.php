<?php

$connection = null;

function connectDatabase()
{
    global $connection;

    $host = 'localhost';

    $database = 'webtech_movie_theater';
    $username = 'root';
    $password = '';

    if($connection = mysqli_connect($host, $username, $password, $database))
    {
        return $connection;
    }

    execConnectionError();
    die();
}

function execConnectionError()
{
    ?>
    <h3>WE COULDN'T ESTABLISH DATABASE CONNECTION</h3>
    <?php
}

function disconnectDatabase()
{
    global $connection;

    if($connection)
    {
        mysqli_close($connection);
    }
}

function verifyEmailAssigned($email)
{
    global $connection;

    $query = "SELECT COUNT(*) FROM `users` WHERE `email` = ?";

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_row($response))
            {
                return (isset($row[0]) && $row[0]>0);
            }
        }
    }
    return false;
}

function getUserByEmail($email)
{
    global $connection;

    $query = "SELECT * FROM `users` WHERE `email` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function getUserById($id)
{
    global $connection;

    $query = "SELECT * FROM `users` WHERE `id` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function insertUser(array $data = array()) {
    global $connection;

    if(!empty($data)) {
        $query = "INSERT INTO `users` (`email`, `password`, `name`, `mobile`, `salary`, `designation`, `role`, `registered`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'ssssdsss', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
            mysqli_stmt_execute($stmt);
            return mysqli_affected_rows($connection);
        }

    }
   
    return false;
}

function getUsersByRole($role)
{
    global $connection;

    $query = "SELECT * FROM `users` WHERE `role` = ? ORDER BY `id` DESC";

    $users = array();

    if($stmt = mysqli_prepare($connection, $query))
    {

        mysqli_stmt_bind_param($stmt, 's', $role);

        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $users[] = $row;
                    }
                }
            }
        }
    }

    return $users;
}

function getMovies() {
    global $connection;

    $query = "SELECT * FROM `movie` ORDER BY `id` DESC";

    $movies = array();

    if($stmt = mysqli_prepare($connection, $query))
    {
        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $movies[] = $row;
                    }
                }
            }
        }
    }

    return $movies;
}

function insertMovie(array $data = array()) {
    global $connection;

    if(!empty($data)) {
        $query = "INSERT INTO `movie` (`name`, `genre`, `rating`, `poster`, `upcoming`, `created`) VALUES (?, ?, ?, ?, ?, ?);";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'ssdsss', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
            mysqli_stmt_execute($stmt);
            return mysqli_affected_rows($connection);
        }
    }
   
    return false;
}

function updateMovie($movieid, array $data = array()) {
    global $connection;

    if(!empty($data) && is_numeric($movieid)) {
        $query = "UPDATE `movie` SET `name` = ?, `genre` = ?, `rating` = ?, `poster` = ?, `upcoming` = ? WHERE `id` = ?";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'ssdssi', $data[0], $data[1], $data[2], $data[3], $data[4], $movieid);
            mysqli_stmt_execute($stmt);
            return mysqli_affected_rows($connection);
        }
    }
   
    return false;
}

function getMovieById($id)
{
    global $connection;

    $query = "SELECT * FROM `movie` WHERE `id` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function getMovieByName($name)
{
    global $connection;

    $query = "SELECT * FROM `movie` WHERE `name` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function deleteMovie($movieid) {
    global $connection;
    if(is_numeric($movieid)) {
        
        $query = "DELETE FROM `seats` WHERE `ticket_id` IN ( SELECT `id` FROM `tickets` WHERE `ticket_id` IN ( Select `id` FROM `tickets` WHERE `schedule_id` IN ( SELECT `id` FROM `schedule` WHERE `movie_id` = ? ) ) )";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'i', $movieid);
            mysqli_stmt_execute($stmt);
            mysqli_affected_rows($connection);

            $query = "DELETE FROM `tickets` WHERE `schedule_id` IN ( SELECT `id` FROM `schedule` WHERE `movie_id` = ? ) ";
            if($stmt = mysqli_prepare($connection, $query))
            {
                mysqli_stmt_bind_param($stmt, 'i', $movieid);
                mysqli_stmt_execute($stmt);
                mysqli_affected_rows($connection);

                $query = "DELETE FROM `movie` WHERE `id` = ?";
                if($stmt = mysqli_prepare($connection, $query))
                {
                    mysqli_stmt_bind_param($stmt, 'i', $movieid);
                    mysqli_stmt_execute($stmt);
                    echo mysqli_error($connection);
                    return mysqli_affected_rows($connection);
                }
            }
        }
    } 
    return false;
}


function deleteUser($userid) {
    
    global $connection;
    
    if(is_numeric($userid)) {
        
        $query = "DELETE FROM `seats` WHERE `ticket_id` IN ( SELECT `id` FROM `tickets` WHERE `user_id` = ? )";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'i', $userid);
            mysqli_stmt_execute($stmt);
            mysqli_affected_rows($connection);

            $query = "DELETE FROM `tickets` WHERE `user_id` = ? ";
            if($stmt = mysqli_prepare($connection, $query))
            {
                mysqli_stmt_bind_param($stmt, 'i', $userid);
                mysqli_stmt_execute($stmt);
                mysqli_affected_rows($connection);

                $query = "DELETE FROM `users` WHERE `id` = ? ";
                if($stmt = mysqli_prepare($connection, $query))
                {
                    mysqli_stmt_bind_param($stmt, 'i', $userid);
                    mysqli_stmt_execute($stmt);
                    return mysqli_affected_rows($connection);
                }
            }
        }
    } 
    return false;
}


function updateUser($userid, array $data = array()) {
    global $connection;

    if(!empty($data) && is_numeric($userid)) {
        $query = "UPDATE `users` SET `email` = ?, `password` = ?, `name` = ?, `mobile` = ?, `salary` = ?, `designation` = ? WHERE `id` = ?";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'ssssdsi', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $userid);
            mysqli_stmt_execute($stmt);
            return mysqli_affected_rows($connection);
        }
    }
   
    return false;
}

function getSchedules() {
    global $connection;

    $query = "SELECT * FROM `schedule` ORDER BY `id` DESC";

    $schedules = array();

    if($stmt = mysqli_prepare($connection, $query))
    {
        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $schedules[] = $row;
                    }
                }
            }
        }
    }

    return $schedules;
}

function getScheduleByHallStart($hall, $start) {
    global $connection;

    $query = "SELECT * FROM `schedule` WHERE `hall` = ? AND `start` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'ss', $hall, $start);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function getScheduleClash($hall, $start) {
    global $connection;

    $query = "SELECT * FROM `schedule` WHERE `hall` = ? AND `start` <= ? AND `end` >= ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'sss', $hall, $start, $start);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
        echo mysql_error($connection);
    }

    return null;
}


function insertSchedule(array $data = array()) {
    global $connection;

    if(!empty($data)) {
        $query = "INSERT INTO `schedule` (`movie_id`, `hall`, `seat_row`, `seat_column`, `start`, `end`, `created`) VALUES (?, ?, ?, ?, ?, ?, ?);";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'isiisss', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
            mysqli_stmt_execute($stmt);
            return mysqli_affected_rows($connection);
        }
    }
   
    return false;
}

function getShows($upcoming='0') {
    global $connection;

    $query = "SELECT * FROM `movie` WHERE `upcoming` = ? ORDER BY `id` DESC";

    $movies = array();

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $upcoming);

        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $movies[] = $row;
                    }
                }
            }
        }
    }

    return $movies;
}

function hasScheduleValid($movieid) {
    global $connection;

    date_default_timezone_set('Asia/Dhaka');

    $now = date("Y-m-d H:i:s");

    $query = "SELECT COUNT(*) FROM `schedule` WHERE `movie_id` = ? AND `start` >= ?";

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'is', $movieid, $now);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_row($response))
            {
                return (isset($row[0]) && $row[0]>0);
            }
        }
    }
    return false;
}

function getSchedulesGroupedByMovie($movieid) {
    global $connection;

    $query = "SELECT * FROM `schedule` WHERE `movie_id` = ? GROUP BY `hall`";

    $schedules = array();

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $movieid);

        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $schedules[] = $row;
                    }
                }
            }
        }
    }

    return $schedules;
}


function getSchedulesByMovieHall($movieid, $hall) {
    global $connection;

    $query = "SELECT * FROM `schedule` WHERE `movie_id` = ? AND `hall` = ?";

    $schedules = array();

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'is', $movieid, $hall);
        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $schedules[] = $row;
                    }
                }
            }
        }
    }

    return $schedules;
}

function getScheduleById($id)
{
    global $connection;

    $query = "SELECT * FROM `schedule` WHERE `id` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}


function getSeatsByScheduleId($id)
{
    global $connection;

    $query = "SELECT `seats`.`seat` FROM `seats` INNER JOIN `tickets` ON `seats`.`ticket_id` = `tickets`.`id`  WHERE `tickets`.`schedule_id` = ? ORDER BY `seats`.`id`.`id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_array($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function insertTicket(array $data = array()) {
    global $connection;

    if(!empty($data)) {
        $query = "INSERT INTO `tickets` (`schedule_id`, `user_id`, `total_seats`, `seat_price`, `total_price`, `purchased`) VALUES (?, ?, ?, ?, ?, ?);";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'iiidds', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
            mysqli_stmt_execute($stmt);
            return mysqli_insert_id($connection);
        }
    }
   
    return false;
}

function insertSeats(array $data = array()) {
    global $connection;

    if(!empty($data)) {
        $query = "INSERT INTO `seats` (`ticket_id`, `seat`) VALUES (?, ?);";
        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'is', $data[0], $data[1]);
            mysqli_stmt_execute($stmt);
            return mysqli_affected_rows($connection);
        }
    }
   
    return false;
}