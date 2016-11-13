import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import masonGrid from './custom/masonry-grid';

(function() {
  //   Run when DOM is ready
  $(function() {

    $('.sidebar-left-container').css({width: $('#left-sidebar').outerWidth() + 'px'});
    $('.woo-content').css({left: $('.sidebar-left-container').outerWidth() + 'px'});
    toggleMenu.init();
    masonGrid.init();

    $(".imgLiquidFill").imgLiquid({
        fill: true,
        horizontalAlign: "center",
        verticalAlign: "top"
    });

$('.grid-item.product').matchHeight();        
    
  });
})();