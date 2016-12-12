import $ from 'jquery';
import toggleMenu from './custom/toggle-main-menu';
import toggleReviewForm from './custom/toggle-review-form';
import masonGrid from './custom/masonry-grid';
import containerMargin from './custom/container-margin';
import scroll from './custom/scroll-2-element';
import matchHeight from './custom/matchHeight';
import ratingSys from './custom/ratingSystem';
import niceSelect from './custom/niceSelect';
import slickSlider from './custom/niceSelect';
import hideResetButton from './custom/hideResetButton';

(function() {
  //   Run when DOM is ready
  $(function() {
    toggleMenu.init();
    masonGrid.init();
    containerMargin.init();
    toggleReviewForm.init();
    scroll.init();
    matchHeight.init();
    ratingSys.init();
    niceSelect.init();
    slickSlider.init();
    hideResetButton.init();
  });
})();
