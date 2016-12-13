import $ from 'jquery';
<<<<<<< HEAD
const scrollToElement = {

  init(){

    $('a[href^="#"]').on('click', function(event) {
      var target = $(this.getAttribute('href'));

      if( target.length ) {
        event.preventDefault();
        $('body,html').stop().animate({
            scrollTop: target.offset().top
        }, 1000);
        console.log(target.attr("id"));
      }
    });

  }
};
export default scrollToElement;
=======
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
>>>>>>> 71511c4e17f3df54582e3799817cd4a391d3b427
