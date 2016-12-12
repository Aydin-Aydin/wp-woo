import $ from 'jquery';
const toggleMenu = {
  init() {
    $('.toggle-menu').on('click', function() {

      $('#left-sidebar').toggleClass('is-open');
      $(this).toggleClass('open');
      $('.side-first-wrapper').toggleClass('is-block');
    });
  }
};
export default toggleMenu;