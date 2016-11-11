import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import masonGrid from './custom/masonry-grid';

(function() {
  //   Run when DOM is ready
  $(function() {

    toggleMenu.init();
    masonGrid.init();
  });
})();