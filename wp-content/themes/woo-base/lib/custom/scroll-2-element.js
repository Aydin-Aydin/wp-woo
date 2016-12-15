import $ from 'jquery';
const scrollToElement = {

  init(){

    $('a[href^="#"]').on('click', function(event) {
      var target = $(this.getAttribute('href'));

      if( target.length ) {
        event.preventDefault();
        $('body,html').stop().animate({
            scrollTop: target.offset().top
        }, 1000);
      }
    });

  }
};
export default scrollToElement;
