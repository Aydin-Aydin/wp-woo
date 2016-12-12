import $ from 'jquery';
const matchHeight = {
  init() {
		let options = {
			  byRow: true,
			  property: 'height',
			  target: null,
			  remove: false  
			};

		$('.equal-height').matchHeight(options);  	
  	$('.grid-item.product').matchHeight();
  }
};
export default matchHeight;