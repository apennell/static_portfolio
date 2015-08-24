(function() {
  $(document).ready(function($) {
    var $nav;
    $('#menu-main-menu').clone().attr('id', 'responsive-menu-selectnav').insertAfter('#menu-main-menu').find('.logo-placeholder, #js-logo').remove();
    selectnav('responsive-menu-selectnav', {
      label: 'Menu',
      nested: true,
      indent: '-',
      activeclass: 'current-menu-item'
    });
    $('#responsive-menu-selectnav').remove();
    $nav = $('.selectnav');
    $nav.wrapAll('<div class="selectnav-wrap">');
    $("#content").fitVids();
    if ($("#wpadminbar").length > 0) {
      $(".sf-container").addClass("offset");
    }
    $('.sf-menu').superfish({
      hoverClass: 'sfHover',
      pathLevels: 1,
      delay: 500,
      animation: {
        height: 'toggle'
      },
      speed: 175,
      autoArrows: true,
      disableHI: false,
      onShow: function() {
        $(this).css("overflow", "visible");
      }
    });
    return $('.colorbox').colorbox({
      rel: "portfolio",
      maxHeight: "100%",
      maxWidth: "100%"
    });
  });

}).call(this);
