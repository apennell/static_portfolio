(function() {
  var $, Hooks, Toggler, _Abstract_Toggler,
    bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  $ = jQuery;

  Hooks = wp.hooks;

  _Abstract_Toggler = (function() {
    function _Abstract_Toggler(options) {
      this.toggle = bind(this.toggle, this);
      this.load = bind(this.load, this);
      this.selectors = options;
      this._URL = false;
      this._loaded_URL = false;
      this._IS_LOADING = false;
      this._AJAX = false;
      this.is_open = false;
      this.iface = {
        window: $(window),
        body: $("html,body"),
        preview: this.selectors.preview
      };
    }

    _Abstract_Toggler.prototype.load = function(URL) {
      var $dfds, content, load;
      $dfds = [];
      content = "";
      if (this.is_open || this.is_new_url(URL)) {
        $dfds.push(this.close());
      }
      load = $.get(URL);
      this._IS_LOADING = true;
      this._AJAX = load;
      $dfds.push(load);
      load.always((function(_this) {
        return function() {
          _this._IS_LOADING = false;
        };
      })(this));
      load.done((function(_this) {
        return function(data) {
          var $data;
          $data = $(data);
          content = $data.find(_this.selectors.content);
          return _this.cache_data(content);
        };
      })(this));
      $.when.apply(null, $dfds).done((function(_this) {
        return function() {
          return _this.on_load_complete(content);
        };
      })(this));
      return $dfds;
    };

    _Abstract_Toggler.prototype.on_load_complete = function(content) {
      this.cache_url(this._URL);
      return this.open(content);
    };

    _Abstract_Toggler.prototype.open = function() {
      this.is_open = true;
      return this.iface.preview.container.show();
    };

    _Abstract_Toggler.prototype.close = function() {
      this.is_open = false;
      return this.iface.preview.container.hide();
    };

    _Abstract_Toggler.prototype.toggle = function(URL) {
      this._URL = URL;
      if (this.is_open !== true || this.is_new_url(this._URL)) {
        return this.reopen(URL);
      } else {
        return this.close();
      }
    };

    _Abstract_Toggler.prototype.reopen = function(URL) {
      if (this.is_new_url(this._URL)) {
        return this.load(URL);
      } else {
        if (this.is_open === true) {
          this.close();
        }
        return this.open();
      }
    };

    _Abstract_Toggler.prototype.is_new_url = function(URL) {
      return URL !== this._loaded_URL;
    };

    _Abstract_Toggler.prototype.cache_url = function(URL) {
      this._loaded_URL = URL;
      this._URL = false;
    };

    _Abstract_Toggler.prototype.cache_data = function(data) {
      this._cached = data.clone().hide();
    };

    _Abstract_Toggler.prototype.get_cached_data = function() {
      return this._cached.clone().show();
    };

    return _Abstract_Toggler;

  })();

  Toggler = (function(superClass) {
    extend(Toggler, superClass);

    function Toggler() {
      this.toggle = bind(this.toggle, this);
      return Toggler.__super__.constructor.apply(this, arguments);
    }

    Toggler.prototype.toggle = function(URL) {
      if (this.is_open === false) {
        this.iface.preview.overlay.velocity('stop').velocity('fadeIn');
      }
      return Toggler.__super__.toggle.call(this, URL);
    };

    Toggler.prototype.open = function(data) {
      var height;
      this.iface.preview.content.css('height', '');
      this.iface.preview.container.css({
        'top': '',
        'display': 'block'
      });
      this.iface.preview.content.html(data);
      height = this.iface.preview.content.height();
      this.iface.preview.content.css({
        height: height,
        display: 'none'
      });
      Hooks.doAction('ajax_popup.before_open');
      return this.iface.preview.content.velocity('stop').velocity({
        properties: 'slideDown',
        options: {
          easing: "easeInOutQuint",
          display: 'block',
          complete: (function(_this) {
            return function() {
              _this.is_open = true;
            };
          })(this)
        }
      });
    };

    Toggler.prototype.close = function(force) {
      var $dfd;
      $dfd = new $.Deferred();
      $dfd.promise();
      if (this._IS_LOADING && force === true) {
        this._AJAX.abort();
      }
      if (!this.is_new_url(this._URL) || force === true) {
        this.iface.preview.overlay.velocity('stop').velocity({
          properties: 'fadeOut',
          options: {
            easing: 'easeOutQuad',
            duration: 400
          }
        });
      }
      if (!this.is_open) {
        $dfd.resolve();
        return $dfd;
      }
      this.iface.preview.container.velocity({
        properties: {
          top: 0
        },
        options: {
          easing: "easeInOutQuint",
          duration: 400
        }
      });
      this.iface.preview.content.velocity({
        properties: 'slideUp',
        options: {
          easing: "easeOutQuint",
          duration: 400,
          complete: (function(_this) {
            return function() {
              _this.is_open = false;
              $dfd.resolve();
            };
          })(this)
        }
      });
      return $dfd;
    };

    return Toggler;

  })(_Abstract_Toggler);

  $(window).load(function() {
    var $ajax_links, $arrow, $target, toggler, toggler_settings;
    toggler_settings = {
      preview: {
        overlay: $("#overlay"),
        content: $("#ajax-popup-content"),
        container: $("#ajax-popup")
      },
      content: '#content .entry-content'
    };
    toggler = new Toggler(toggler_settings);
    $ajax_links = $(".sf-menu .with-ajax > a, .acid-ajax-link > a, a.acid-ajax-link");
    $arrow = $("#popup-arrow");
    $target = false;
    $ajax_links.click(function(e) {
      var URL;
      e.preventDefault();
      $target = $(e.srcElement || e.target);
      URL = $target.attr("href");
      return toggler.toggle(URL);
    });

    /*
    		Position the "current" arrow
    		@uses $target
     */
    Hooks.addAction('ajax_popup.before_open', function() {
      return $arrow.velocity({
        left: $target.offset().left
      }, {
        duration: 200
      });
    });
    $("#overlay").click(function(e) {
      $target = $(e.srcElement || e.target);
      if ($target.attr('id') === 'overlay') {
        return toggler.close(true);
      }
    });
    return $(document).on("keyup", function(e) {
      if (e.keyCode === 27) {
        return toggler.close(true);
      }
    });
  });

}).call(this);
