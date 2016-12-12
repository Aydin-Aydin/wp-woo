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
    // You may also like section
    $('.summary-tabs-wrapper .grid-sizer').css({
      width: "45%"
    });
    $('.summary-tabs-wrapper .grid-item').css({
      width: "45%"
    });


     // Brand widget
    $('div.brand-widget ul li').removeClass('first last-row');
    $('.yith-wcbr-thumbnail-list li').attr('style', '');

    // Rated widget
    $('div.rated-widget ul, div.brand-widget ul').addClass('cat-slider');   
    
  });
})();
