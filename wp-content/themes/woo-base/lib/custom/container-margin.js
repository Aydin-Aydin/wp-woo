import $ from 'jquery';
const containerMargin = {
  init() {

      $('.primary-wrapper').css({
        paddingLeft: $('.sidebar-left-container').outerWidth() + 'px'
      });
  }
};
export default containerMargin;
