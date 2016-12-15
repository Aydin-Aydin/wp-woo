import $ from 'jquery';
const containerMargin = {
  init() {
    $('.sidebar-left-container').css({
      width: $('#left-sidebar').outerWidth() + 'px'
    });
    $('.primary-wrapper').css({
      paddingLeft: $('.sidebar-left-container').outerWidth() + 'px'
    });
  }
};
export default containerMargin;
