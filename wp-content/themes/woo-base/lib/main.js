import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import masonGrid from './custom/masonry-grid';
import containerMargin from './custom/container-margin';

(function() {
  //   Run when DOM is ready
  $(function() {
    toggleMenu.init();
    masonGrid.init();
    containerMargin.init();
<<<<<<< HEAD

		$('.grid-item.product').matchHeight();


$(".slider-wrapper").slick({
  dots: true,
  speed: 500
});

// Front page category slider
$('.product_list_widget').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 3
});

// $("*").each(function() {
//     if ($(this).width() > $(window).width()) {
//         $(this).width() = 100;
//     }
// });

=======
    $('.grid-item.product').matchHeight();

    $(".slider-wrapper").slick({
      dots: true,
      speed: 500
    });
>>>>>>> mohamad
  });
})();
