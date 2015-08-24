(function() {
  var $, $js_logo, $logo, $nav, $placeholder, Hooks, menu_item_length, singleSide;

  Hooks = wp.hooks;

  $ = jQuery;

  $nav = $('#navigation');

  $logo = $('#logo');

  if ($nav.find('.logo-placeholder').length > 0) {
    $placeholder = $nav.find('.logo-placeholder').first();
    $js_logo = $logo.hide().clone().attr("id", "js-logo").show().insertBefore($placeholder).wrap('<li id="logo-container" class="menu-item"/>');
    $placeholder.remove();
  } else {

    /*
    			Move the Logo to the center of the UL
     */
    menu_item_length = $(".sf-menu > .menu-item").length;
    if (menu_item_length > 0) {
      singleSide = Math.ceil(menu_item_length / 2);
      $("#logo").hide().clone().attr("id", "js-logo").show().insertAfter(".sf-menu > .menu-item:nth-child(" + singleSide + ")").wrap('<li id="logo-container" class="menu-item"/>');
    } else {
      $("#logo").addClass("center-block");
    }
  }

}).call(this);
