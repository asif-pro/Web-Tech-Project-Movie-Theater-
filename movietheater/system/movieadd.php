<?php
$admin = true;
require_once("../library/function.php");
if(isLoggedIn()) {
    connectDatabase();

    $userid = $_SESSION[LOGIN_SESSION];
    $user = getUserById($userid);

    if(isEmployee($user)) {

        $__pageError = getTransfer("movieAddError");
        $__pageSuccess = getTransfer("movieAddSuccess");
        $__preData = getTransfer("movieAddData");
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
                            <h1 class="page-header">Add Movie</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Provide Movie Information
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="movieaddlistener.php" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="name">Name:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="name" id="name" value="<?= isset($__preData['name'])?htmlspecialchars($__preData['name']) : "" ?>" placeholder="Enter Movie Name">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="genre">Genre:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="genre" id="genre" value="<?= isset($__preData['genre'])?htmlspecialchars($__preData['genre']) : "" ?>" placeholder="Enter Genre">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="rating">Rating:</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="rating" name="rating" value="<?= isset($__preData['rating']) ? htmlspecialchars($__preData['rating']) : "" ?>" placeholder="Enter IMDB Rating">
                                        </div>
                                      </div>
                                      <?php $movieType = isset($__preData['movie_type']) ? $__preData['movie_type'] : "" ?>
                                      <div class="form-group">
                                        <label class="control-label col-sm-2" for="movie_type">Type:</label>
                                        <div class="col-sm-10">
                                            <select name="movie_type" id="movie_type" class="form-control">
                                                <option value="">Select an option</option>
                                                <option value="now" <?= $movieType=="now" ? "selected": "" ?>>Now Showing</option>
                                                <option value="upc" <?= $movieType=="upc" ? "selected": "" ?>>Upcomming</option>
                                            </select>
                                        </div>
                                      </div>
                                      
                                     <div class="form-group">
                                        <label class="control-label col-sm-2" for="poster">Poster:</label>
                                        <div class="col-sm-10">
                                            <div class="input-group acl-input-file" name="poster">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default btn-choose" type="button">Choose</button>
                                                </span>
                                                <input type="text" class="form-control" id="poster" placeholder='Choose a file...' readonly />
                                                <span class="input-group-btn">
                                                     <button class="btn btn-danger btn-reset" type="button">Clear</button>
                                                </span>
                                            </div>
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
            function __aclFileInput() {
                $(".acl-input-file").before(
                    function() {
                        if ( ! $(this).prev().hasClass('input-hidden-acl') ) {
                            var element = $("<input type='file' class='input-hidden-acl' style='visibility:hidden; height:0'>");
                            element.attr("name",$(this).attr("name"));
                            $(this).find('input').css({'border-bottom-right-radius':'4px', 'border-top-right-radius':'4px'});
                            $(this).find('button.btn-reset').parent().css('display','none');
                            element.change(function(){
                                element.next(element).find('input').val((element.val()).split('\\').pop());
                                element.next(element).find('button.btn-reset').parent().prev().css({'border-bottom-right-radius':'', 'border-top-right-radius':''});
                                element.next(element).find('button.btn-reset').parent().show();
                            });
                            $(this).find("button.btn-choose").click(function(){
                                element.click();
                            });
                            $(this).find("button.btn-reset").click(function(){
                                element.val(null);
                                $(this).parent().prev().css({'border-bottom-right-radius':'4px', 'border-top-right-radius':'4px'});
                                $(this).parent().hide();
                                $(this).parents(".acl-input-file").find('input').val('');
                            });
                            $(this).find('input').css("cursor","pointer");
                            $(this).find('input').click(function() {
                                $(this).parents('.acl-input-file').prev().click();
                                return false;
                            });
                            return element;
                        }
                    }
                );
            }

            var success = <?= !empty($__pageSuccess) ? 'true' : 'false' ?>;
            var error = <?= !empty($__pageError) ? 'true' : 'false' ?>;

            $(document).ready(function() {
                __aclFileInput();
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