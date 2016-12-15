import $ from 'jquery';
const scroll = {
  init() {
    $(".take-me-down").click(function() {
      $('html,body').animate({
          scrollTop: $("#content-top").offset().top},
          'slow');
    });

    $(".scroll2").click(function() {
      if ($(window).width() >= 481){
        $('html,body').animate({
            scrollTop: $("#content-top").offset().top},
          'slow');
      } else {
       $('html,body').animate({
            scrollTop: $("#ratedWidget").offset().top},
        'slow');
      }
    });
  }
};
export default scroll;





