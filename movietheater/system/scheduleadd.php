<?php
$admin = true;
require_once("../library/function.php");
if(isLoggedIn()) {
    connectDatabase();

    $userid = $_SESSION[LOGIN_SESSION];
    $user = getUserById($userid);

    if(isEmployee($user)) {

    $__pageError = getTransfer("scheduleAddError");
    $__pageSuccess = getTransfer("scheduleAddSuccess");
    $__preData = getTransfer("scheduleAddData");
    $__preData = !empty($__preData) ? $__preData : array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Cinemas</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">
        <link href="../css/datetimepicker.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="../css/material-icon.css" rel="stylesheet">
        <link href="../css/special-modals.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include("../library/popups.php") ?>
        
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="../img/cinemas_light_180x44.png"></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($user['name']) ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-user fa-fw"></i> Users</a>
                            </li>
                            <li>
                                <a href="employee.php"><i class="fa fa-user-secret fa-fw"></i> Employees</a>
                            </li>
                            <li>
                                <a href="movies.php"><i class="fa fa-film fa-fw"></i> Movies</a>
                            </li>
                            <li>
                                <a href="schedule.php"><i class="fa fa-clock-o fa-fw"></i> Schedules</a>
                            </li>
                             <li>
                                <a href="tickets.php"><i class="fa fa-ticket fa-fw"></i> Tickets</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Add Schedule</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Provide Schedule Information
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="scheduleaddlistener.php">
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Movie:</label>
                                        <div class="col-sm-10">
                                            <select name="movie" class="form-control">
                                                <option value="">Select One</option>
                                                <?php $movies = getMovies() ?>
                                                <?php foreach($movies as $__movie) : ?>
                                                <option value="<?= $__movie['id'] ?>" <?= isset($__preData['movie']) && $__preData['movie']==$__movie['id'] ? 'selected' : '' ?>><?= htmlspecialchars($__movie['name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="hall">Hall:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="hall" id="hall" value="<?= isset($__preData['hall']) ? htmlspecialchars($__preData['hall']) : '' ?>" placeholder="Enter hall">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="seat_column">Seats:</label>
                                        <div class="col-sm-5">
                                          <input type="text" class="form-control" id="seat_column" name="seat_column" value="<?= isset($__preData['seat_column']) ? htmlspecialchars($__preData['seat_column']) : '' ?>" placeholder="Column">
                                        </div>
                                        <div class="col-sm-5">
                                          <input type="text" class="form-control" id="seat_row" name="seat_row" value="<?= isset($__preData['seat_row']) ? htmlspecialchars($__preData['seat_row']) : '' ?>" placeholder="Row">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="start">Preiod:</label>
                                        <div class="col-sm-5">
                                            <input data-format="MM/dd/yyyy HH:mm:ss PP" type="text" class="form-control" id="start" name="start" value="<?= isset($__preData['start']) ? htmlspecialchars($__preData['start']) : '' ?>" placeholder="Start">
                                        </div>
                                        <div class="col-sm-5">
                                            <input data-format="MM/dd/yyyy HH:mm:ss PP" type="text" class="form-control" id="end" name="end" value="<?= isset($__preData['end']) ? htmlspecialchars($__preData['end']) : '' ?>" placeholder="End">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/moment.js"></script>
        <script src="../js/datetimepicker.js"></script>
        <script src="../js/startmin.js"></script>

        <script>
            
            var success = <?= !empty($__pageSuccess) ? 'true' : 'false' ?>;
            var error = <?= !empty($__pageError) ? 'true' : 'false' ?>;

            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true
                });

                $('#start,#end').datetimepicker({
                    minDate:new Date()
                });

                if(success) {
                    $('#mySuccess').modal('show');
                } else if(error) {
                    $('#myError').modal('show');
                }
            });
        </script>

    </body>
</html>
<?php
    } else {
        header("Location: ../index.php");
    }

} else {
    header("Location: ../login.php");
}