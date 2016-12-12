import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import masonGrid from './custom/masonry-grid';
import containerMargin from './custom/container-margin';
import scrollToElement from './custom/scroll-2-element';

(function() {
  //   Run when DOM is ready
  $(function() {
    toggleMenu.init();
    masonGrid.init();
    containerMargin.init();
    scrollToElement.init();

		$('.grid-item.product').matchHeight();


$(".slider-wrapper").slick({
  dots: true,
  autoplay: true,
  autoplaySpeed: 10000,
  speed: 500
});

// Brand widget
$('div.brand-widget ul li').removeClass('first last-row');
$('.yith-wcbr-thumbnail-list li').attr('style', '');

// Rated widget
$('div.rated-widget ul, div.brand-widget ul').addClass('cat-slider');

$('.cat-slider').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 3,
responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 6,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]});

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

options = {
  byRow: true,
  property: 'height',
  target: null,
  remove: false
};

$('.equal-height').matchHeight(options);

// Latest product widget
$('#woocommerce_products-2 ul').addClass('grid').prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>').find('li').addClass('grid-item');

// equal-height

// $("*").each(function() {
//     if ($(this).width() > $(window).width()) {
//         console.log(this.attr('class') + "#" + this.id);
//     }
// });

  });
})();
