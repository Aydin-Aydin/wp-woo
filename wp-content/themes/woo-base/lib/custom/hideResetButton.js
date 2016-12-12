import $ from 'jquery';
const hideResetButton = {
	init() {
		$('.value .reset_variations').css({
		  position: 'absolute',
		  zIndex: '-10'
		});
	}
};
export default hideResetButton;
