$ = jQuery

class WP_Theme_Options
	constructor: ( options ) ->
		@options = options

	get_option: (what) ->
		@options[what]

	is_falsy: (option) ->
		return @is_bool @parse_falsy option

	# Thank you Underscore.js
	is_bool: (obj) ->
		obj is true or obj is false or toString.call(obj) == '[object Boolean]'

	parse_falsy: (option) ->
		val = @get_option option
		return false if val is "false"
		return true if val is "true"
		return val

	is_enabled: (option, default_option = false) ->
		if @is_falsy option
			@parse_falsy option
		else
			default_option


Acid_Options = new WP_Theme_Options(ACID_OPTIONS_CONFIG)