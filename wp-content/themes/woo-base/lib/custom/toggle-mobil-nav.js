import $ from 'jquery';
const toggleMenu = {
  init() {
    $('.toggle-mobil-nav').on('click', function() {
      $('.mobil-nav').toggleClass('open');
    });

    $('.toggle-mobil-nav').click(function(){
      $(this).toggleClass('open');
    });
  }
};
export default toggleMenu;
