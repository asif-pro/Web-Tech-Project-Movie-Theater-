<?php

  require_once("library/function.php");

  connectDatabase();

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
            <li role="presentation" class="active"><a href="#">HOME</a></li>
            <li role="presentation"><a href="nowshowing.php">SEARCH</a></li>
            <?php if(!isLoggedIn()) : ?>
            <li role="presentation"><a href="login.php">LOGIN</a></li>
            <li role="presentation"><a href="register.php">SINGN UP</a></li>
            <?php endif; ?>
            <?php if(isLoggedIn()) : ?>
            <?php
                $userid = $_SESSION[LOGIN_SESSION];
                $user = getUserById($userid);
                if(isAdmin($user) || isEmployee($user)) {
                    echo "<li role=\"presentation\"><a href=\"system/index.php\">DASBOARD</a></li>";
                }
            ?>
            <li role="presentation"><a href="logout.php">LOGOUT</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
<div class="container div-first">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="text-center">
  <h2 class="maintitle">NOW SHOWING</h2>
</div>
<hr class="divider">
</div>
</div>
</div>


  <div class="container">
    <div class="row">
      <div class="slider">
        <div class="img-responsive">
          <ul class="bxslider">
            <?php $shows = getShows() ?>
            <?php if(!empty($shows)) : ?>
            <?php foreach ($shows as $__nowShowing) : ?>
            <li><a href="booking.php?movie=<?= $__nowShowing['id'] ?>"><img src="<?= getPoster($__nowShowing['poster']) ?>" alt="<?= $__nowShowing['name'] ?>" /></a></li>
            <?php endforeach; ?>
            <?php else : ?>
            <li><img src="img/default_slider.jpg" alt="" /></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php $shows = getShows('1') ?>
<?php if(!empty($shows)) : ?>
            
<div class="container div-first">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="text-center">
        <h2 class="maintitle">UP COMMINGS</h2>
      </div>
      <hr class="divider">
    </div>
  </div>
</div>
<?php $counter = 1 ?>
<div class="content">
  <div class="grid">
    <?php foreach ($shows as $__upComing) : ?>
    <?php if($counter==3) : ?>
    </div>
</div>
    <div class="content">
        <div class="grid">
    <?php $counter = 1;?>
    <?php else : ?> 
    <?php $counter++;?>
    <figure class="effect-zoe">
        <img src="<?= getPoster($__upComing['poster']) ?>" alt="<?= $__upComing['name'] ?>" />
        <figcaption>
            <h2><?= $__upComing['name'] ?></h2>
            <p class="icon-links"></p>
            <p class="description"></p>
        </figcaption>
    </figure>
    <?php endif; ?>   
    <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>  


  <footer>
    <div class="inner-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 f-about">
          </div>
          <div class="col-md-4 l-posts">
            <h3 class="widgetheading">Contact Us</h3>
            <a href="#">
              <p><i class="fa fa-envelope"></i> cinemas@gmail.com</p>
            </a>
            <p><i class="fa fa-phone"></i> +345 578 59 45 416</p>
            <p><i class="fa fa-home"></i> Cinemas inc | American International University Bangladesh, Kuratoli, Dhaka Bangladesh</p>
          </div>
          <div class="col-md-4 f-contact">
          </div>
        </div>
      </div>
    </div>


    <div class="last-div">
      <div class="container">
        <div class="row">
          <div class="copyright">
            &copy; Cinemas All Rights Reserved
            <div class="credits">
              <!--
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eNno
              -->
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
