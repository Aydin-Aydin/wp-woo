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
    liquidImg.init();
		$('.grid-item.product').matchHeight();
    
  });
})();