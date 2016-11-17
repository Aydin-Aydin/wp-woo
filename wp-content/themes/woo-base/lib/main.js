import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import masonGrid from './custom/masonry-grid';
import containerMargin from './custom/container-margin';
import liquidImg from './custom/liquid-img';

(function() {
  //   Run when DOM is ready
  $(function() {
    toggleMenu.init();
    masonGrid.init();
    containerMargin.init();
    liquidImg.init();

$('.grid-item.product').matchHeight();
// $('.owl-carousel').owlCarousel();

$(".slider-wrapper").slick({
  dots: true,
  speed: 500
});

  });
})();
