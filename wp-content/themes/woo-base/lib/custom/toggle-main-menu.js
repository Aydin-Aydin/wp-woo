import $ from 'jquery';
const toggleMenu = {
  init() {
    $('.toggle-menu').on('click', function() {
    	  //console.log($(this).closest('.side-left-wrapper'));
      $(this).next('.side-left-wrapper').toggleClass('is-open');
      if ($(this).hasClass('toggle-menu-close')) {
      	$(this).parent('.side-left-wrapper').toggleClass('is-open');
      };
    });
  }
};
export default toggleMenu;
