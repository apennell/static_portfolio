(function() {
  var $, $doc, $win, get_direction, get_gutter_width, get_width, setup_meta_position;

  $ = jQuery;

  $win = $(window);

  $doc = $(document);

  get_direction = function(selector) {
    if (selector === "prev-post") {
      return "right";
    } else {
      return "left";
    }
  };

  get_width = function(selector) {
    if ($(selector).textWidth() !== $win.width()) {
      return $(selector).textWidth();
    } else {
      return 0;
    }
  };

  get_gutter_width = function() {
    var gutter_width;
    gutter_width = ($win.width() - $("#container").outerWidth()) / 2;
    return gutter_width;
  };

  setup_meta_position = function() {
    var GW;
    GW = get_gutter_width();
    $("#prev-post .meta").css({
      "right": GW,
      "position": "absolute"
    });
    return $("#next-post .meta").css({
      "left": GW,
      "position": "absolute"
    });
  };

  $doc.ready(function() {
    var hoverEnabled, longestWidth;
    setup_meta_position();
    hoverEnabled = false;
    longestWidth = get_width("#prev-post") > get_width("#next-post") ? get_width("#prev-post") : get_width("#next-post");
    longestWidth = longestWidth + 90;
    $("#next-post, #prev-post").velocity({
      properties: {
        width: get_gutter_width()
      },
      options: {
        duration: 600,
        delay: 250,
        easing: "easeInOutQuart",
        complete: function() {
          $("#next-post, #prev-post").css({
            overflow: "visible"
          });
          hoverEnabled = true;
        }
      }
    });
    $(".js--post-link").hoverIntent({
      over: function() {
        if (hoverEnabled === true) {
          $(this).css({
            backgroundColor: $(this).data("color")
          });
          return $(this).find(".meta").velocity({
            width: longestWidth
          }, {
            duration: 300,
            easing: "easeOutExpo"
          });
        }
      },
      out: function() {
        if (hoverEnabled === true) {
          $(this).css({
            backgroundColor: $("#content").data("color")
          });
          return $(this).find(".meta").velocity({
            width: 0
          }, {
            duration: 250,
            easing: "easeInQuad"
          });
        }
      },
      timeout: 100,
      interval: 150
    });
    $(".js--post-link").click(function(e) {
      var url;
      url = $(this).find(".adjacent-title a").attr("href");
      if (url != null) {
        if (e.metaKey) {
          window.open(url, '_blank');
        } else {
          window.location = url;
        }
      }
    });
    return $win.on("resize", function() {
      setup_meta_position();
      return $(".js--post-link").css({
        width: get_gutter_width()
      });
    });
  });

}).call(this);
