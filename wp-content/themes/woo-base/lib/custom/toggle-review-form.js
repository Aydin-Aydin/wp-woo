import $ from 'jquery';
const toggleReviewForm = {
  init() {
    $('#reply-title ').on('click', function() {

      $('#respond .comment-form').toggleClass('show-content-form');
    });
  }
};
export default toggleReviewForm;