(function ($) {

  var slider = $('.bxslider').bxSlider({
    mode: 'horizontal',
    auto: true,
    autoControls: false,
    stopAutoOnClick: false,
    pager: false,
    speed: 500
  });

  $('#reload-slider').click(function (e) {
    e.preventDefault();
    slider.reloadSlider({
      mode: 'fade',
      auto: true,
      pause: 1000,
      speed: 500
    });
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scrollup').fadeIn();
    } else {
      $('.scrollup').fadeOut();
    }
  });
  $('.scrollup').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 1000);
    return false;
  });

  wow = new WOW({}).init();

})(jQuery);
