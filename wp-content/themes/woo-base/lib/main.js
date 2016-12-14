import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import toggleReviewForm from './custom/toggle-review-form';
import masonGrid from './custom/masonry-grid';
import containerMargin from './custom/container-margin';
import scroll from './custom/scroll-2-element';
import matchHeight from './custom/matchHeight';
import ratingSys from './custom/ratingSystem';
import niceSelect from './custom/niceSelect';
import slickSlider from './custom/slickSlider';
import hideResetButton from './custom/hideResetButton';
//import masonGrid2Colomns from './custom/masonry-grid-2-columns';

(function() {
  //   Run when DOM is ready
  $(function() {
    toggleMenu.init();
    containerMargin.init();
    toggleReviewForm.init();
    scroll.init();
    matchHeight.init();
    ratingSys.init();
    niceSelect.init();
    slickSlider.init();
    hideResetButton.init();
    //masonGrid2Colomns.init();
    masonGrid.init();
  });
})();
