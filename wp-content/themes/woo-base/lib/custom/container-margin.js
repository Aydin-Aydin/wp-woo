import $ from 'jquery';
const containerMargin = {
  init() {
    $('.sidebar-left-container').css({width: $('#left-sidebar').outerWidth() + 'px'});
    $('.woo-content').css({left: $('.sidebar-left-container').outerWidth() + 'px'});    
  }
};
export default containerMargin;
