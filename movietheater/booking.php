<?php 
require_once("library/function.php");

if(isLoggedIn()) {
    connectDatabase();
    $userid = $_SESSION[LOGIN_SESSION];
    $user = getUserById($userid);
    if($user['role']=="customer") {
        $movieid = isset($_REQUEST['movie']) ? $_REQUEST['movie'] : getTransfer("bookingMovieId");

        if(!empty($movieid) && !empty($__movie = getMovieById($movieid)) && hasScheduleValid($movieid)) {
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
            <li role="presentation"><a href="nowshowing.php">SEARCH</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
<div class="container div-first">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<div class="text-center">
  <h2 class="maintitle"><?= $__movie['name'] ?></h2>
</div>
<hr class="divider" style="margin-bottom: 10px">
</div>
</div>
</div>
<div class="container">
<div class="row">
  <div class="col-md-3 f-about">
  </div>
  <div class="col-md-6 l-posts" style="padding-bottom: 20px; margin-bottom:20px">
    <div class="text-center" style="margin-bottom: 40px">
      <img src="<?= getPoster($__movie['poster']) ?>" height="222px" width="555px">
    </div>
    <form action="listenticketbooking.php" method="post">

            <div class="form-group row login">
                <label for="email_address" class="col-md-3 col-form-label text-md-right">Hall</label>
                <div class="col-md-9">
                    <select class="form-control" name="show-hall">
                        <?php $halls = getSchedulesGroupedByMovie($__movie['id']) ?>
                        <option value="">Select One</option>
                        <?php foreach($halls as $__hall) : ?>
                        <option value="<?= $__hall['hall']?>"><?= $__hall['hall']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row login">
                <label for="email_address" class="col-md-3 col-form-label text-md-right">Show Time</label>
                <div class="col-md-9">
                    <select class="form-control" name="show-time">
                        <option value="">Select Hall First</option>
                    </select>
                </div>
            </div>

            <div class="form-group row login" style="">
                <label for="password" class="col-md-3 col-form-label text-md-right">Seats</label>
                <div class="col-md-9 seat-plan">
                    <table>
                      <tr>
                        <td width="30px" height="30px" title="A1"></td>
                        <td width="30px" height="30px" title="A2"></td>
                        <td width="30px" height="30px" title="A3"></td>
                        <td width="30px" height="30px" title="A4"></td>

                      </tr>
                      <tr>
                        <td width="30px" height="30px" title="B1"></td>
                        <td width="30px" height="30px" title="B2"></td>
                        <td width="30px" height="30px" title="B3"></td>
                        <td width="30px" height="30px" title="B4"></td>
                      </tr>
                    </table>
                </div>
            </div>
            <div class="col-xs-offset-3 col-xs-9">
                <button type="submit" class="btn btn-primary login">
                    Book
                </button>

            </div>
       </form>
    </div>
  </div>
  <div class="col-md-3 f-contact">
  </div>
</div>
</div>

  <footer>
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
        var movie = <?= $__movie['id'] ?>;
        $(document).ready(function(){
            $('select[name="show-hall"]').on("change", function(){
                var elem = $(this);
                var option = $("<option />");
                var showtime = $('select[name="show-time"]');
                showtime.html('');
                if(elem.val().length){
                    $.post('listenshowtime.json.php', {movie: movie, hall: elem.val() }, function(data, textStatus, xhr) {
                        if(textStatus=='success') {
                           if(data.length) {
                                showtime.append(option.clone().attr({ value: ''}).text('Select One'));
                                $.each(data, function(i, v) {
                                    showtime.append(option.clone().attr({ value: v.option }).text( v.value ));
                                });
                           } else showtime.append(option.clone().attr({ value: ''}).text('No Show Time Found'));   
                        } else showtime.append(option.clone().attr({ value: ''}).text('No Show Time Found'));
                    }, 'json');
                } else showtime.append(option.clone().attr({ value: ''}).text('Select Hall First'));
            });

            $('select[name="show-time"]').on("change", function(){
                var elem = $(this);
                var seatplan = $('div.seat-plan');

                seatplan.html('');

                if(elem.val().length){
                    $.post('listenseatplan.json.php', {schedule: elem.val() }, function(data, textStatus, xhr) {
                        if(textStatus=='success') {
                           if(data) {
                               renderSeatPlan(data.column, data.row, data.booked) ;
                           } 
                        }
                    }, 'json');
                }
            });

            $('div.seat-plan').click('table tr td:not(.seat_booked)', function() {
                var __input = $('<input type="hidden" name="choosen_seat[]">');
                var elem = $(event.target);
                var place = $('div.seat-plan').parent();

                console.log(elem.hasClass('seat_choosen'));

                if(elem.hasClass('seat_choosen')) {
                    if($('input[data-acl="'+elem.attr('title')+'"][name="choosen_seat[]"]').val()) {
                        $('input[data-acl="'+elem.attr('title')+'"][name="choosen_seat[]"]').remove();
                        elem.removeClass('seat_choosen');
                    }
                } else {
                    elem.addClass('seat_choosen');
                    place.append(__input.clone().attr('data-acl', elem.attr('title')).val(elem.attr('title')));
                }
            });

            function renderSeatPlan(column, row, booked) {
                var __tb = $('<table />');
                var __tr = $('<tr />');
                var __td = $('<td width="30px" height="30px" />');
                var seatplan = $('div.seat-plan');

                var pattern = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

                seatplan.html('');

                var table = __tb.clone();

                for(var i = 0; i<row; i++) {
                    var tr = __tr.clone();
                    var rn = pattern.charAt(i);
                    for(var j = 0; j<column; j++) {
                        var cn = rn + (j+1);
                        var td = __td.clone().attr('title', cn);
                        if(booked.includes(cn)) td.addClass('seat_booked');
                        td.appendTo(tr);
                    }
                    tr.appendTo(table);
                }
                seatplan.append(table);
            }
        });
  </script>

</body>

</html>
<?php
        } else {
            setTransfer("indexMovieError", "No Movie Found");
            header("Location: index.php");
            exit;
        }
    } else {
        header("Location: system/index.php");
        exit;
    }
} else {
    setTransfer("loginReferrer", "booking.php");
    setTransfer("bookingMovieId", isset($_REQUEST['movie']) ? $_REQUEST['movie'] : '');
    header("Location: login.php");
    exit;
}

