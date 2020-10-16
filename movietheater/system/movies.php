<?php
$admin = true;
require_once("../library/function.php");
if(isLoggedIn()) {
    connectDatabase();

    $userid = $_SESSION[LOGIN_SESSION];
    $user = getUserById($userid);

    if(isAdmin($user) || isEmployee($user)) {

    $__pageError = getTransfer("moviesError");
    $__pageSuccess = getTransfer("moviesSuccess");

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
        <style type="text/css">
            
            table.dataTable tbody td {
              vertical-align: middle;
            }

        </style>

        <div id="myConfirm" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>              
                        <h4 class="modal-title">Are you sure?</h4>  
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete a Movie? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" id="removeConfirm" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div> 

        <?php include("../library/popups.php") ?>

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php"><img src="../img/cinemas_light_180x44.png"></a>
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
                            <h1 class="page-header">Movies</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Showing All Movies From System
<?php if(isEmployee($user)) { ?>
                                    <a href="movieadd.php" class="btn btn-primary btn-xs pull-right">Add New</a>
                                    <?php } ?>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th width="50px">Poster</th>
                                                    <th>Name</th>
                                                    <th>Genre</th>
                                                    <th>Rating</th>
                                                    <th>Type</th>
                                                    <th>Created</th>
                                                    <th width="70px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $movies = getMovies(); ?>
                                                <?php if(!empty($movies)) : ?>
                                                <?php foreach ($movies as $__movie) : ?>
                                                <tr>
                                                    <td align="center"><img src="<?= getPoster($__movie['poster']) ?>" height="60px" width="60px"></td>
                                                    <td><?= htmlspecialchars($__movie['name']) ?></td>
                                                    <td><?= htmlspecialchars($__movie['genre']) ?></td>
                                                    <td><?= htmlspecialchars($__movie['rating']) ?></td>
                                                    <td><?= decodeMovieType($__movie['upcoming']) ?></td>
                                                    <td><?= __formatDate($__movie['created'], "j F Y, g:i a") ?></td>
                                                    <td>
                                                        <a href="movieedit.php?movie=<?= htmlspecialchars($__movie['id']) ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>&nbsp; &nbsp;<a href="moviedelete.php?movie=<?= htmlspecialchars($__movie['id']) ?>" class="btn btn-danger btn-xs remove-confirm"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else : ?>
                                                <tr>
                                                    <td colspan="7">No Movie Found</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

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

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            var success = <?= !empty($__pageSuccess) ? 'true' : 'false' ?>;
            var error = <?= !empty($__pageError) ? 'true' : 'false' ?>;

            $(document).ready(function() {

                $('#dataTables-example').DataTable({
                    responsive: true,
                    ordering: false
                });

                $("body").on("click", ".remove-confirm", function(e){
                    e.preventDefault();
                    $("button#removeConfirm").data('target', $(this).attr('href'));
                    $('#myConfirm').modal('show');
                });

                $("button#removeConfirm").click(function(e) {
                    window.location.replace($(this).data('target'));
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