import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import Masonry from 'masonry-layout';
jQueryBridget('masonry', Masonry, $);
const masonGrid = {
	init() {
		$('.grid').masonry({
			itemSelector: '.grid-item',
			columnWidth: '.grid-sizer',
			precentPosition: true,
			gutter: '.gutter-sizer'
		});
	}
};
export default masonGrid;
