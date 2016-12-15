import $ from 'jquery';
const toggleMenu = {
  init() {
    $('.toggle-menu').on('click', function() {

      $('#left-sidebar').toggleClass('is-open');
      $('.primary-wrapper').toggleClass('nav-open');
      $('#site-name').toggleClass('move-right');
    });


    $('.toggle-menu').click(function(){
      $(this).toggleClass('open');
    });
  }
};
export default toggleMenu;
