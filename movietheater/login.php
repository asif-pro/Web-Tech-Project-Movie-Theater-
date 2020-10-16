<?php
require_once("library/function.php");

  if(!isLoggedIn()) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cinemas</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css">
  <link rel="stylesheet" type="text/css" href="css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/set1.css" />
  <link href="css/overwrite.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div class="background"></div>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
        <a class="navbar-brand" href="index.php"><span><img src="img/cinemas_light_180x44.png"></span></a>
      </div>
      <div class="navbar-collapse collapse">
        <div class="menu">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="index.php">HOME</a></li>
            <li role="presentation" class="active"><a href="nowshowing.php">SEARCH</a></li>
            <li role="presentation"><a href="#">LOGIN</a></li>
            <li role="presentation"><a href="register.php">SINGN UP</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
<div class="container div-first">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="text-center">
  <h2 class="maintitle">LOGIN HERE</h2>
</div>
<hr class="divider">
</div>
</div>
</div>

<div class="container">
<div class="row">
  <div class="col-md-3 f-about">
  </div>
  <div class="col-md-6 l-posts">
    <form action="loginlistener.php" method="post">
            <div class="form-group row login">
                <label for="email" class="col-md-3 col-form-label text-md-right">E-Mail Address</label>
                <div class="col-md-9">
                    <input type="text" id="email" class="form-control" name="email" required autofocus>
                </div>
            </div>

            <div class="form-group row login">
                <label for="password" class="col-md-3 col-form-label text-md-right">Password</label>
                <div class="col-md-9">
                    <input type="password" id="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="col-xs-offset-3 col-xs-9">
                <button type="submit" class="btn btn-primary login">
                    LOGIN
                </button>
                &nbsp;&nbsp;&nbsp;
                <a href="#">
                    Forgot Password?
                </a>
            </div>
       </form>
    </div>
  </div>
  <div class="col-md-3 f-contact">
  </div>
</div>
</div>

  <footer style="position: fixed; bottom: 0; right: 0; left:0">
    <div class="last-div">
      <div class="container">
        <div class="row">
          <div class="copyright">
            &copy; Cinemas All Rights Reserved
            <div class="credits">
              Designed by <a href="javascript:void(0)">Webtech Project</a>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <ul class="social-network">
            <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest fa-1x"></i></a></li>
            <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus fa-1x"></i></a></li>
          </ul>
        </div>
      </div>

      <a href="" class="scrollup"><i class="fa fa-chevron-up"></i></a>


    </div>
  </footer>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery-2.1.1.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/jquery.bxslider.min.js"></script>
  <script type="text/javascript" src="js/fliplightbox.min.js"></script>
  <script src="js/functions.js"></script>
  <script type="text/javascript">
    $('.portfolio').flipLightBox();
  </script>

</body>

</html>

<?php } else {
  connectDatabase();
  $userid = $_SESSION[LOGIN_SESSION];
  $user = getUserById($userid);
  if(!empty($user) && ($user['role'] == 'admin' || $user['role'] == 'employee')) {
      header("Location: system/index.php");
      exit;
  }

  header("Location: index.php");
}
