(function() {
  var $, $body, $content, $scrollbar, Horizontal_Layout, Layout,
    bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $ = jQuery;

  Horizontal_Layout = (function() {
    function Horizontal_Layout() {
      this.refresh = bind(this.refresh, this);
      this.setup = bind(this.setup, this);
      this.$scrollbar = $("#scrollbar");
      this.$content = $("#content");
      this.is = {
        enabled: this.maybe_enable_horizontal_scroll(),
        setup: false
      };
      this.properties = {
        scrollbar: {
          height: $('#scrollbar').find("> .scrollbar").height()
        },
        canvas: false,
        width: $(window).width()
      };
      $(document).on("ready", this.setup);
      $(window).on("load debouncedresize", this.refresh);
    }

    Horizontal_Layout.prototype.setup = function() {
      if (this.is.setup || !this.is.enabled) {
        return false;
      }
      this.is.setup = true;
      $("body").data("ready", "fired");
      $("html").css("overflow-y", "hidden");
      return this.$scrollbar.tinyscrollbar({
        axis: "x",
        invertscroll: true
      });
    };

    Horizontal_Layout.prototype.refresh = function() {
      var $head, $style, boxH, boxW, canvas_height, ratio, rows, style, window_height, window_width;
      this.is.enabled = this.maybe_enable_horizontal_scroll();
      if (!this.is.enabled) {
        return false;
      }
      if (this.is.setup === false) {
        this.setup();
      }
      window_height = $(window).height();
      window_width = $(window).width();
      canvas_height = this.$content.height() - this.properties.scrollbar.height;
      this.update_cover_images();
      this.$content.find(".vertical-title").css('width', Math.round(canvas_height));
      if ((canvas_height === this.properties.canvas) && (window_width === this.properties.width)) {
        return;
      }
      this.properties.canvas = canvas_height;
      this.properties.width = window_width;
      ratio = 1;
      rows = 2;
      boxH = Math.round(canvas_height / rows);
      boxW = Math.round(boxH * ratio);
      style = ".hscol { \n	width: " + boxW + "px; \n}\n.hscol .box {\n	width: " + boxW + "px; \n	height: " + boxW + "px; \n}\n.hscol.full, .hscol.full .box { \n	width: " + canvas_height + "px; \n	height: " + canvas_height + "px; \n}";
      $head = $(document.head);
      $style = $head.find('#js__style');
      if ($style.length === 1) {
        $style.html(style);
      } else {
        $head.append("<style id=\"js__style\" type=\"text/css\">" + style + "</style>");
      }
      return this.update_scrollbar('relative');
    };

    Horizontal_Layout.prototype.get_total_width = function($elements) {
      var el, i, key, len, w;
      w = 0;
      for (key = i = 0, len = $elements.length; i < len; key = ++i) {
        el = $elements[key];
        w += $(el).outerWidth();
      }
      return w;
    };

    Horizontal_Layout.prototype.resize_columns = function(columns, ratio) {
      var $columns, aspectRatio, imageHeight, imageWidth, newHeight, newWidth;
      if (ratio == null) {
        ratio = 0.5;
      }
      $columns = $(columns);
      newHeight = Math.floor(this.$content.height() * ratio);
      imageHeight = parseInt($columns.find(".wp-post-image").first().attr("height"), 10);
      imageWidth = parseInt($columns.find(".wp-post-image").first().attr("width"), 10);
      if (!(isNaN(imageHeight) || isNaN(imageWidth) || imageWidth === 0 || imageHeight === 0)) {
        aspectRatio = imageHeight / imageWidth;
        newWidth = Math.round(newHeight / aspectRatio);
        return $columns.find(".box").css({
          height: newHeight,
          width: newWidth
        });
      }
    };

    Horizontal_Layout.prototype.update_cover_images = function() {
      var $cover_images;
      $cover_images = this.$content.find(".cover-image");
      if ($cover_images.length >= 1) {
        $cover_images.each(function(key, cover) {
          var $cover, $thumb, image_width;
          $cover = $(cover);
          $thumb = $cover.find(".wp-post-image");
          if ($thumb.length !== 1) {
            return;
          }
          $cover.css("position", "static");
          image_width = $thumb.outerWidth(true);
          return $cover.css({
            "width": image_width,
            "position": "relative"
          });
        });
        return this.update_scrollbar('relative');
      }
    };

    Horizontal_Layout.prototype.update_scrollbar = function(params) {
      if (!this.is.setup) {
        return false;
      }
      this.$content.width(this.get_total_width($('.hscol')));
      return this.$scrollbar.tinyscrollbar_update(params);
    };

    Horizontal_Layout.prototype.maybe_enable_horizontal_scroll = function() {
      if ($("#primary").data("horizontal-scroll") !== "on") {
        return false;
      }
      if ($("body").hasClass("horizontal-scroll")) {
        if ($(window).width() < 768) {
          $("body").removeClass("horizontal-scroll").addClass("js-no-tinyscroll");
          $("html").css("overflow-y", "visible");
          return false;
        } else {
          return true;
        }
      } else {
        if ($(window).width() >= 768) {
          $("body").addClass("horizontal-scroll").removeClass("js-no-tinyscroll");
          return true;
        } else {
          return false;
        }
      }
    };

    return Horizontal_Layout;

  })();

  Layout = new Horizontal_Layout();

  $scrollbar = Layout.$scrollbar;

  $content = $("#content");

  $body = $("body");

  $(document).keydown(function(e) {
    if (!(e.keyCode === 37 || e.keyCode === 38 || e.keyCode === 39 || e.keyCode === 40)) {
      return;
    }
    e.preventDefault();
    if (e.keyCode === 37 || e.keyCode === 38) {
      $scrollbar.tinyscrollbar_updatescroll(60);
    }
    if (e.keyCode === 39 || e.keyCode === 40) {
      return $scrollbar.tinyscrollbar_updatescroll(-60);
    }
  });

  $scrollbar.one("tscroll", function() {
    var scroll_happened;
    scroll_happened = true;
    return $(".blinking-arrow").remove();
  });

  $('#main').imagesLoaded(function() {
    var $page_thumbnail, $page_thumbnail_image, maybeLoadAjax, nextAjaxLoad;
    if (!Layout.maybe_enable_horizontal_scroll()) {
      return false;
    }
    Layout.refresh();

    /*
    		Parallaxy Page Thumbnail
     */
    $page_thumbnail = $("#page-thumbnail");
    if ($page_thumbnail.length > 0) {
      $page_thumbnail_image = $page_thumbnail.find(".wp-post-image");
      $scrollbar.on("tscroll", function(e, scroll) {
        $page_thumbnail_image.css("left", scroll * 0.75);
      });
    }
    if (Acid_Options.is_enabled("blinking_arrow", true)) {
      $(".vertical-title-container").first().append('<div class="blinking-arrow"></div>');
    }
    if ($("ul.page-numbers").length > 0) {
      nextAjaxLoad = $content.width() * 0.65 - $(window).width();
      $(".page-links, .page-numbers").hide();

      /*
      			Infinite Scroll
      
      			Only Attempt if there is a pagination
       */
      $content.infinitescroll({
        navSelector: "ul.page-numbers",
        nextSelector: "ul.page-numbers .next",
        finishedMsg: true,
        msgText: true,
        itemSelector: "#content .hscol",
        errorCallback: function() {
          $scrollbar.off("tscroll", maybeLoadAjax);
          $("#infscr-loading").remove();
          return Layout.update_scrollbar('relative');
        }
      }, function(items) {
        $(items).find(".box").append('<div class="dim">');
        $('.colorbox').colorbox({
          rel: "portfolio",
          maxHeight: "100%",
          maxWidth: "100%"
        });
        Layout.refresh();
        nextAjaxLoad = $content.width() * 0.8 - $(window).width();
      });
      $(window).unbind('.infscr');
      maybeLoadAjax = function(e, scroll) {
        if (nextAjaxLoad === false) {
          return;
        }
        if (scroll >= nextAjaxLoad) {
          nextAjaxLoad = false;
          $content.infinitescroll('retrieve');
        }
      };
      $scrollbar.on("tscroll", maybeLoadAjax);
      return maybeLoadAjax(null, 0);

      /*
      			Explaining: $("#content").width() * 0.65 - $(window).width()
      			CW = $("#content").width() * 0.65
      			WW = $(window).width()
      			---
      			Assume: CW = 100px, WW = 200px
      
      			CW * 0.65 - WW = 65px - 200px = -135px
      			(TRUE) === -135px < 0
      
      			Maybe Load AJAX ? Yes.
      			---
      			
      			---
      			Assume CW = 200px, WW = 200px
      			
      			CW * 0.65 - WW = 130px - 200px = -70px
      			(TRUE) === -70px < 0
      
      			Maybe Load AJAX ? Yes.
      			---
      
      			---
      			Assume CW = 400px, WW = 200px
      			
      			CW * 0.65 - WW = 260px - 200px = 60px
      			(FALSE) === 60px < 0
      
      			Maybe Load AJAX ? NO, wait for scroll.
      			---
      
      			Passing null, because maybeLoadAjax is expecting an event as the first argument
       */
    }
  });

}).call(this);
