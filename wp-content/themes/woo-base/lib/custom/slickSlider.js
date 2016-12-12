import $ from 'jquery';
const slickSlider = {
  init() {
    $(".slider-wrapper").slick({
      dots: true,
      autoplay: true,
      autoplaySpeed: 10000,
      speed: 500
    });

    // Front page category slider
    $('.product_list_widget').slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 3
    });

  $('.cat-slider').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 3,
  responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]});     
  }
};
export default slickSlider;