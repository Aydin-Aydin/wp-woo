import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
jQueryBridget('masonry', Masonry, $);
const masonGrid2Colomns = {
	init() {
		// Grid 2 columns
		$('.up-sells .grid-sizer').addClass('grid-sizer-2-columns').removeClass('grid-sizer');
		$('.up-sells .grid-item').addClass('grid-item-2-columns').removeClass('grid-item');

		//Latest product widget
		$('#woocommerce_products-2 ul').addClass('grid').prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>').find('li').addClass('grid-item');

		//You may also like section
		$('.grid').masonry({
			itemSelector: '.grid-item-2-columns',
			columnWidth: '.grid-sizer-2-columns',
			gutter: '.gutter-sizer',
			percentPosition: true
		});	
	}
};
export default masonGrid2Colomns;
