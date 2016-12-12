import $ from 'jquery';
const ratingSys = {
  init() {
		let options = {
		    max_value: 5,
		    step_size: 0.5,
		    initial_value: 0,
		    selected_symbol_type: 'utf8_star', // Must be a key from symbols
		    cursor: 'default',
		    readonly: true,
		}

		$(".rating").rate(options);
		$(".rating").rate("getValue");

		$('.star-rating div').css({
			width: '100%'
		});
  }
};
export default ratingSys;