import $ from 'jquery';
const toggleMenu = {
  init() {
    $('.toggle-menu').on('click', function() {
      $('.side-left-wrapper').toggleClass('is-open');
    });
  }
};
export default toggleMenu;
