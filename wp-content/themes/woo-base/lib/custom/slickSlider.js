import $ from 'jquery';
const slickSlider = {
  init() {
    $(".slider-wrapper").slick({
      dots: true,
      autoplay: true,
      autoplaySpeed: 10000,
      speed: 500
    });

    // Brand widget
    $('div.brand-widget ul li').removeClass('first last-row');
    $('.yith-wcbr-thumbnail-list li').attr('style', '');

    // Rated widget
    $('div.rated-widget ul, div.brand-widget ul').addClass('cat-slider');

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
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]});	
  }
};
export default slickSlider;