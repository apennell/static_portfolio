(function() {
  jQuery(function($) {
    var $tooltip, box_event_actions, tooltip_height, tooltip_text, tooltip_width;
    $(document.body).append('<div id="follower"><span class="text"></span><div id="follower-arrow"></div</div>');
    $tooltip = $("#follower").css('display', 'none');
    tooltip_text = $tooltip.find(".text");
    tooltip_height = 0;
    tooltip_width = 0;
    $('.box [title]').attr("title", "");
    $('.box').append('<div class="dim">');
    $("#scrollbar").on("tscroll", function() {
      $tooltip.hide();
    });
    box_event_actions = {
      mouseenter: function() {
        var followerColor;
        followerColor = $(this).data("followerColor");
        $(tooltip_text).html($(this).find(".entry-title").text());
        $tooltip.show().css({
          "width": $(tooltip_text).textWidth() + 30,
          "background-color": followerColor
        });
        $("#follower-arrow").css({
          "border-color": followerColor + " transparent transparent transparent"
        });
        tooltip_height = $tooltip.outerHeight() + 25;
        tooltip_width = $tooltip.width();
      },
      mouseleave: function() {
        $tooltip.hide();
      },
      mousemove: function(e) {
        $tooltip.css({
          top: e.pageY - tooltip_height,
          left: e.pageX
        });
      },
      click: function(e) {
        var $link, $this, target, url;
        if (e.isTrigger) {
          return;
        }
        $this = $(this);
        $link = $this.find('.js--link').first();
        if ($link.is('.js--ignore')) {
          return;
        }
        if ($link.is('.colorbox')) {
          $link.click();
        } else {
          url = $link.attr('href');
          target = $link.attr('target');
          if (e.metaKey || ((target != null) && target.toLowerCase() === '_blank')) {
            window.open(url, '_blank');
          } else {
            window.location.href = url;
          }
        }
        return e.preventDefault();
      }
    };
    $(document.body).on(box_event_actions, ".box");
  });

}).call(this);
