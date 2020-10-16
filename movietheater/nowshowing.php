<?php
  require_once("library/function.php");
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
            <li role="presentation"><a href="index.php">HOME</a></li>
            <li role="presentation" class="active"><a href="#">SEARCH</a></li>
            <?php if(!isLoggedIn()) : ?>
            <li role="presentation"><a href="login.php">LOGIN</a></li>
            <li role="presentation"><a href="register.php">SINGN UP</a></li>
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
  <h2 class="maintitle">CHOOSE YOUR MOVIE</h2>
</div>
<hr class="divider">
<form action="" method="">
            <div class="form-group row login">
                <div class="col-md-9">
                    <input type="text" id="email_address" class="form-control" placeholder="Type movie name/genre/rating here" name="email-address" required autofocus>
                </div>
                <div class="col-md-3">
                <button type="submit" class="btn btn-primary login">
                    SEARCH
                  </button>
                </div>
            </div>
       </form>
</div>
</div>
</div>
  <div class="content">
    <div class="grid">
      <figure class="effect-zoe">
        <img src="img/25.jpg" alt="img25" />
        <figcaption>
          <h2>Title <span>Name</span></h2>
          <p class="icon-links">
            <a href="#"><span class="icon-heart"></span></a>
            <a href="#"><span class="icon-eye"></span></a>
            <a href="#"><span class="icon-paper-clip"></span></a>
          </p>
          <p class="description">Zoe never had the patience of her sisters. She deliberately punched the bear in his face.</p>
        </figcaption>
      </figure>
      <figure class="effect-zoe">
        <img src="img/26.jpg" alt="img26" />
        <figcaption>
          <h2>Title <span>Name</span></h2>
          <p class="icon-links">
            <a href="#"><span class="icon-heart"></span></a>
            <a href="#"><span class="icon-eye"></span></a>
            <a href="#"><span class="icon-paper-clip"></span></a>
          </p>
          <p class="description">Zoe never had the patience of her sisters. She deliberately punched the bear in his face.</p>
        </figcaption>
      </figure>
    </div>
  </div>

  <div class="content">
    <div class="grid">
      <figure class="effect-zoe">
        <img src="img/27.jpg" alt="img27" />
        <figcaption>
          <h2>Title <span>Name</span></h2>
          <p class="icon-links">
            <a href="#"><span class="icon-heart"></span></a>
            <a href="#"><span class="icon-eye"></span></a>
            <a href="#"><span class="icon-paper-clip"></span></a>
          </p>
          <p class="description">Zoe never had the patience of her sisters. She deliberately punched the bear in his face.</p>
        </figcaption>
      </figure>
      <figure class="effect-zoe">
        <img src="img/30.jpg" alt="img30" />
        <figcaption>
          <h2>Title <span>Name</span></h2>
          <p class="icon-links">
            <a href="#"><span class="icon-heart"></span></a>
            <a href="#"><span class="icon-eye"></span></a>
            <a href="#"><span class="icon-paper-clip"></span></a>
          </p>
          <p class="description">Zoe never had the patience of her sisters. She deliberately punched the bear in his face.</p>
        </figcaption>
      </figure>
    </div>
  </div>

  <footer>
    <div class="inner-footer">
      <div class="container">
        <div class="row">
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
