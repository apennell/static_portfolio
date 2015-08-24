$ = jQuery
Hooks = wp.hooks

class _Abstract_Toggler  
	constructor: ( options ) -> 	
		# Merge Defaults with Provided Options
		@selectors = options

		# Some Private class Variables
		@_URL = false
		@_loaded_URL = false
		@_IS_LOADING = false
		@_AJAX = false

		@is_open = false
		
		# Select the core selectors only once, store them in class variable @iface
		@iface = 
			window: $(window)
			body: $("html,body")
			preview: @selectors.preview # Cache the Container

 	# Pull content in with AJAX
	load: (URL) =>
		$dfds = []
		content = ""

		if @is_open or @is_new_url(URL)
			$dfds.push @close()

		load = $.get(URL)
		@_IS_LOADING = true
		@_AJAX = load

		$dfds.push load

		load.always =>
			@_IS_LOADING = false
			return
			
		load.done (data) =>
			$data = $(data)
			content = $data.find @selectors.content
			@cache_data content

		$.when.apply(null, $dfds).done =>
			@on_load_complete(content)
		
		return $dfds

	# Yeah...
	on_load_complete: (content) ->
		@cache_url(@_URL)
		@open(content)

	# Core Functiontality
	open: ->
		@is_open = true
		@iface.preview.container.show()
	
	close: ->
		@is_open = false
		@iface.preview.container.hide()
	
	toggle: (URL) =>
		@_URL = URL

		if @is_open isnt true or @is_new_url(@_URL)
		then @reopen(URL)
		else @close()
	
	reopen: (URL) ->
		if @is_new_url(@_URL)
			@load(URL)
		else
			if @is_open is true
				@close()

			@open()


	is_new_url: (URL) ->
		URL isnt @_loaded_URL
	
	cache_url: (URL) ->
		@_loaded_URL = URL
		@_URL = false
		return

	cache_data: (data) ->
		@_cached = data.clone().hide()
		return
	
	get_cached_data: ->
		@_cached.clone().show()


class Toggler extends _Abstract_Toggler
	toggle: (URL) =>
		if @is_open is false
			@iface.preview.overlay
				.velocity('stop')
				.velocity 'fadeIn'


		super(URL)

	open: (data) ->
		 #Reset
		@iface.preview.content.css('height', '')
		@iface.preview.container.css
			'top': ''
			'display': 'block'

		# Append new content
		@iface.preview.content.html data

		# Get Height
		height = @iface.preview.content.height()


		@iface.preview.content.css
			height: height
			display: 'none'


		Hooks.doAction 'ajax_popup.before_open'
		@iface.preview.content.velocity('stop').velocity
			properties: 'slideDown'
			options:
				easing: "easeInOutQuint"
				display: 'block'
				complete: =>
					@is_open = true
					return

	close: ( force ) ->
		$dfd = new $.Deferred()
		$dfd.promise()

		if @_IS_LOADING and force is true
			@_AJAX.abort()

		if not @is_new_url(@_URL) or force is true
			@iface.preview.overlay
				.velocity('stop')
				.velocity
						properties: 'fadeOut'
						options:
							easing: 'easeOutQuad'
							duration: 400
		if not @is_open
			$dfd.resolve()
			return $dfd


		@iface.preview.container.velocity
			properties:
				top: 0
			options:
				easing: "easeInOutQuint"
				duration: 400

		@iface.preview.content.velocity
			properties: 'slideUp'
			options:
				easing: "easeOutQuint"
				duration: 400
				complete: =>
					@is_open = false
					$dfd.resolve()
					return
		return $dfd



# /* -----------------------------------*/
# /* 		Document Manipulation
# /* -----------------------------------*/
$(window).load ->
	toggler_settings = 
		preview:
			overlay: $("#overlay")
			content: $("#ajax-popup-content")
			container: $("#ajax-popup")
		content: '#content .entry-content'
	
	toggler = new Toggler( toggler_settings )

	# Setup Variables
	$ajax_links = $(".sf-menu .with-ajax > a, .acid-ajax-link > a, a.acid-ajax-link")
	$arrow = $("#popup-arrow")


	# Set a global $target
	$target = false

	# Listen for a click
	$ajax_links.click (e) ->
		# Don't go anywhere
		e.preventDefault()

		# Get the click target, 
		$target = $(e.srcElement || e.target)

		# Get the URL
		URL = $target.attr("href")
		
		# Open 
		toggler.toggle URL

	###
		Position the "current" arrow
		@uses $target
	###
	Hooks.addAction 'ajax_popup.before_open', ->
		$arrow.velocity left: $target.offset().left,
			duration: 200


	# A click on the overlay means close
	$("#overlay").click (e) ->
		$target = $(e.srcElement || e.target)
		if $target.attr('id') is 'overlay'
			toggler.close(true)
	
	$(document).on "keyup", (e) ->
		if e.keyCode is 27 # The ESC key
			toggler.close(true)

