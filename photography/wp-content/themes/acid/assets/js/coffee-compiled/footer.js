(function() {
  var $footer_arrow, $footer_arrow_span, $footer_content, is_open;

  if (Acid_Options.is_enabled("footer_toggle", true)) {
    $footer_content = $("#footer-content");
    $footer_arrow = $("#footer-arrow");
    $footer_arrow_span = $footer_arrow.find("span");
    is_open = false;
    $footer_arrow.click(function() {
      if (is_open) {
        $footer_arrow_span.text("+");
        $footer_content.velocity({
          properties: 'slideUp',
          options: {
            duration: 400,
            easing: "easeOutQuad"
          }
        });
      } else {
        $footer_arrow_span.text("-");
        $footer_content.velocity({
          properties: 'slideDown',
          options: {
            duration: 400,
            easing: "easeOutQuad"
          }
        });
      }
      return is_open = !is_open;
    });
  }

}).call(this);
