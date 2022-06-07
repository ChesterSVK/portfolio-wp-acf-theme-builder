(function ($) {
  $(document).ready(function ($) {
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    //Scroll Top functionality
    function scrollFunction() {
      if (document.body.scrollTop > 880 || document.documentElement.scrollTop > 880) {
        $('#uk-totop').fadeIn();
      } else {
        $('#uk-totop').fadeOut();
      }
    }
    scrollFunction();

    //Spinner functionality
    function spinnerFunction() {
      if ($('#uk-spinner').length) {
        setTimeout(function() {
          $('#uk-spinner').fadeOut();
          $('#uk-spinner').promise().done(function () {
            $(this).parent().remove();
          })
        }, $('#uk-spinner').data('timeout'))
      }
    }
    spinnerFunction();


    //Disable active menu click
    $('.current_page_item').eq(0).click(function (e) {
      e.preventDefault();
    })
  });
})(jQuery);