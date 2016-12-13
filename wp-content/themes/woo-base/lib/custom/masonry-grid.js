import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
jQueryBridget('masonry', Masonry, $);
const masonGrid = {
	init() {
  // Latest product widget
  $('#woocommerce_products-2 ul').addClass('grid').prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>');

		$('.grid').masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			gutter: '.gutter-sizer',
			percentPosition: true
		});
	}
};
export default masonGrid;
