<?php
$admin = true;
require_once("../library/function.php");
if(isLoggedIn()) {
    connectDatabase();

    $userid = $_SESSION[LOGIN_SESSION];
    $user = getUserById($userid);

    if(isAdmin($user)) {

    $__pageError = getTransfer("employeeAddError");
    $__pageSuccess = getTransfer("employeeAddSuccess");
    $__preData = getTransfer("employeeAddData");
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
                            <h1 class="page-header">Add Employees</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Provide Employee Information
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="employeeaddlistener.php">
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Name:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="name" id="name" value="<?= isset($__preData['name']) ? htmlspecialchars($__preData['name']) : '' ?>" placeholder="Enter Full Name">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Email:</label>
                                        <div class="col-sm-10">
                                          <input type="email" class="form-control" name="email" id="email" value="<?= isset($__preData['email']) ? htmlspecialchars($__preData['email']) : '' ?>" placeholder="Enter email">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="phone">Phone Number:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($__preData['phone']) ? htmlspecialchars($__preData['phone']) : '' ?>" placeholder="Enter Phone Number">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="designation">Designation:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="designation" name="designation" value="<?= isset($__preData['designation']) ? htmlspecialchars($__preData['designation']) : '' ?>" placeholder="Enter Designation">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="salary">Salary:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="salary" name="salary" value="<?= isset($__preData['salary']) ? htmlspecialchars($__preData['salary']) : '' ?>" placeholder="Enter Salary">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="password" id="pwd" placeholder="Enter password" value="<?= rand(100000,999999) ?>">
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
        <script src="../js/startmin.js"></script>

        <script>
            
            var success = <?= !empty($__pageSuccess) ? 'true' : 'false' ?>;
            var error = <?= !empty($__pageError) ? 'true' : 'false' ?>;

            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true
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