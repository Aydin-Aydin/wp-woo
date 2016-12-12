import $ from 'jquery';
const slickSlider = {
  init() {
		$(".slider-wrapper").slick({
		  dots: true,
		  speed: 500
		});

		// Front page category slider
		$('.product_list_widget').slick({
		  infinite: true,
		  slidesToShow: 6,
		  slidesToScroll: 3
		});		
  }
};
export default slickSlider;