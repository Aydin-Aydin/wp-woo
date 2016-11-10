// import $ from 'jquery';
// //   Import libs
// // import $ from 'jquery';
// import toggleMenu from 'toogle-main-menu';
(function() {
  //   Run when DOM is ready
  jQuery(function() {
    // toggleMenu.init();
    jQuery('.toggle-menu').on('click', function() {
      jQuery('.side-left-wrapper').toggleClass('is-open');
    });
  });
})();