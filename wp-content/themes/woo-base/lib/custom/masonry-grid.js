import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
jQueryBridget('masonry', Masonry, $);
const masonGrid = {
	init() {
		// You may also like section
		$('.grid').masonry({
			itemSelector: '.grid-item-2-columns',
			columnWidth: '.grid-sizer-2-columns',
			gutter: '.gutter-sizer',
			percentPosition: true
		});	
			
		// General grid
		$('.grid').masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			gutter: '.gutter-sizer',
			percentPosition: true
		});
		// Grid 2 columns
	  $('.up-sells .grid-sizer').addClass('grid-sizer-2-columns').removeClass('grid-sizer');
	  $('.up-sells .grid-item').addClass('grid-item-2-columns').removeClass('grid-item');
	}
};
export default masonGrid;
