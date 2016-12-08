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

    $('.grid-item.product').matchHeight();


    $(".slider-wrapper").slick({
      dots: true,
      speed: 500
    });

<<<<<<< HEAD
    // Front page category slider
    $('.product_list_widget').slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 3
    });
=======
// Front page category slider
$('.product_list_widget').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 3
});
  
>>>>>>> 5f983673c4d74b50f743fbedbfb99366500ba0c1

    // You may also like section
    $('.summary-tabs-wrapper .grid-sizer').css({
      width: "45%"
    });
    $('.summary-tabs-wrapper .grid-item').css({
      width: "45%"
    });

    // Options
    var options = {
      max_value: 5,
      step_size: 0.5,
      initial_value: 0,
      selected_symbol_type: 'utf8_star', // Must be a key from symbols
      cursor: 'default',
      readonly: true,
    }

    $(".rating").rate(options);

    $(".rating").rate("getValue");

<<<<<<< HEAD
    options = {
      byRow: true,
      property: 'height',
      target: null,
      remove: false
    };

    $('.equal-height').matchHeight(options);
    $('.variations select').niceSelect();


    $('.value .reset_variations').css({
      position: 'absolute',
      zIndex: '-10'
    });

    // equal-height

    // $("*").each(function() {
    //     if ($(this).width() > $(window).width()) {
    //         $(this).width() = 100;
    //     }
    // });
=======
$('.equal-height').matchHeight(options);
$('.variations select').niceSelect();

$('.value .reset_variations').css({
  position: 'absolute',
  zIndex: '-10'
});

  // You may also like section
  $('.summary-tabs-wrapper .products .grid-sizer').addClass('grid-sizer-2-columns').removeClass('grid-sizer');


  $('.summary-tabs-wrapper .products .grid-item').addClass('grid-item-2-columns').removeClass('grid-item');
  //$('.summary-tabs-wrapper .products .grid-item').css({ left: $('.summary-tabs-wrapper .products .grid-item').width()});
>>>>>>> 5f983673c4d74b50f743fbedbfb99366500ba0c1

  });
})();