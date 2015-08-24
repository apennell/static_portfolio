(function() {
  var $, Acid_Options, WP_Theme_Options;

  $ = jQuery;

  WP_Theme_Options = (function() {
    function WP_Theme_Options(options) {
      this.options = options;
    }

    WP_Theme_Options.prototype.get_option = function(what) {
      return this.options[what];
    };

    WP_Theme_Options.prototype.is_falsy = function(option) {
      return this.is_bool(this.parse_falsy(option));
    };

    WP_Theme_Options.prototype.is_bool = function(obj) {
      return obj === true || obj === false || toString.call(obj) === '[object Boolean]';
    };

    WP_Theme_Options.prototype.parse_falsy = function(option) {
      var val;
      val = this.get_option(option);
      if (val === "false") {
        return false;
      }
      if (val === "true") {
        return true;
      }
      return val;
    };

    WP_Theme_Options.prototype.is_enabled = function(option, default_option) {
      if (default_option == null) {
        default_option = false;
      }
      if (this.is_falsy(option)) {
        return this.parse_falsy(option);
      } else {
        return default_option;
      }
    };

    return WP_Theme_Options;

  })();

  Acid_Options = new WP_Theme_Options(ACID_OPTIONS_CONFIG);

}).call(this);
