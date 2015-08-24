(function() {
  jQuery.fn.textWidth = function(text, font) {
    var $el;
    $el = jQuery(this);
    if (!jQuery.fn.textWidth.fakeEl) {
      jQuery.fn.textWidth.fakeEl = jQuery("<span>").hide().appendTo(document.body);
    }
    jQuery.fn.textWidth.fakeEl.html(text || $el.text()).css("font", font || $el.css("font") || 32);
    return jQuery.fn.textWidth.fakeEl.width();
  };

}).call(this);
