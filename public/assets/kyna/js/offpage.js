(function($) {
  "use strict";
  $(document).on("click", "[data-offpage]", function(e) {
    e.preventDefault();
    if (window.matchMedia('(max-width: 991px)').matches)
      $(this).parents("body").addClass("offpage-overflow");
    var target = $(this).data("offpage");
    if ($(this).hasClass("offpage-close")) {
      $(target).removeClass("in");
      $(this).parents("body").removeClass("offpage-overflow");
      $('main').removeClass('filterCourses');
    } else {
      $(target).toggleClass("in");
    }
    if ($(this).data('offpage') == '#nav-mobile' &&
      window.matchMedia('(max-width: 991px)').matches &&
      window.matchMedia('(min-width: 768px)').matches) {
      if ($('.k-header-offpage-menu').hasClass('open'))
        $('.k-header-offpage-menu').removeClass('open');
      else
        $('.k-header-offpage-menu').addClass('open');
    }
  });
  $(".k-listing-button-filter.k-button-mobile").on('click', function(e) {
    e.preventDefault();
    $('main').addClass('filterCourses');
  })
})(jQuery);
