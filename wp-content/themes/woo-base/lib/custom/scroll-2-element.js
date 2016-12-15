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
<<<<<<< HEAD
=======

>>>>>>> b9497e101f5c7ad23adffe6f2fe1bd33dcd796c5
