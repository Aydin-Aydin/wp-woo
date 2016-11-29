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

$('div.brand-widget ul').addClass('slider-wrapper');

$('.yith-wcbr-thumbnail-list li').attr('style', '');

// Front page category slider
$('div.front-widget ul').addClass('cat-slider');

$('.cat-slider').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 3
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

options = {
  byRow: true,
  property: 'height',
  target: null,
  remove: false
};

$('.equal-height').matchHeight(options);

// equal-height

// $("*").each(function() {
//     if ($(this).width() > $(window).width()) {
//         console.log(this.attr('class') + "#" + this.id);
//     }
// });

  });
})();
