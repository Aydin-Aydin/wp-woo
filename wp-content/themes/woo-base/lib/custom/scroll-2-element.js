import $ from 'jquery';
const scroll = {
  init() {
    $(".take-me-down").click(function() {
      $('html,body').animate({
          scrollTop: $("#content-top").offset().top},
          'slow');
    });
  }
};
export default scroll;

