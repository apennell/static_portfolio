$ = jQuery

class Horizontal_Layout
	constructor: ->
		# Cache Selectors
		@$scrollbar = $("#scrollbar")
		@$content = $("#content")

		@is =
			enabled: @maybe_enable_horizontal_scroll()
			setup: false

		@properties = 
			scrollbar: 
				height: $('#scrollbar').find("> .scrollbar").height()
			canvas: false
			width: $(window).width()

		$(document).on "ready", @setup
		$(window).on "load debouncedresize", @refresh

		


	setup: =>
		return false if @is.setup or not @is.enabled
		@is.setup = true

		$("body").data("ready", "fired")
		$("html").css "overflow-y", "hidden"
		
		# Setup Horizontal Scroll
		@$scrollbar.tinyscrollbar
						axis: "x"
						invertscroll: true
	
	refresh: =>
		# Check whether Horizontal Layout should be enabled
		@is.enabled = @maybe_enable_horizontal_scroll()
		
		# Quit if it shouldn't
		return false unless @is.enabled
		
		# Setup if isn't already setup
		@setup() if @is.setup is false
		
		
		window_height = $(window).height()
		window_width = $(window).width()

		canvas_height = @$content.height() - @properties.scrollbar.height


		@update_cover_images()

		@$content.find(".vertical-title").css( 'width', Math.round( canvas_height ) )
		
		# Don't resize if nothing is changed
		return if (canvas_height is @properties.canvas) and (window_width is @properties.width)
		
		@properties.canvas = canvas_height
		@properties.width = window_width

		ratio = 1
		rows = 2
		boxH = Math.round( canvas_height / rows )
		boxW = Math.round( boxH * ratio )


		style = """
			.hscol { 
				width: #{boxW}px; 
			}
			.hscol .box {
				width: #{boxW}px; 
				height: #{boxW}px; 
			}
			.hscol.full, .hscol.full .box { 
				width: #{canvas_height}px; 
				height: #{canvas_height}px; 
			}
		"""
		
		$head = $( document.head )
		$style = $head.find('#js__style')
		
		if $style.length is 1
			$style.html style
		else
			$head.append """<style id="js__style" type="text/css">#{style}</style>"""


		@update_scrollbar('relative')

	# Get the total width of an array of elements
	get_total_width: ( $elements ) -> 
		w = 0
		for el, key in $elements
			w += $(el).outerWidth()
		return w


	resize_columns: (columns, ratio = 0.5) ->
		$columns = $(columns)
		newHeight = Math.floor @$content.height() * ratio
		imageHeight = parseInt $columns.find(".wp-post-image").first().attr("height"), 10
		imageWidth = parseInt $columns.find(".wp-post-image").first().attr("width"), 10
		
		unless isNaN(imageHeight) or isNaN(imageWidth) or imageWidth is 0 or imageHeight is 0


			aspectRatio = imageHeight / imageWidth
			newWidth = Math.round newHeight / aspectRatio

			$columns.find(".box").css
				height: newHeight
				width: newWidth

	update_cover_images: ->
		$cover_images = @$content.find(".cover-image")
		if $cover_images.length >= 1
			$cover_images.each  (key, cover) ->
				$cover = $(cover)	
				$thumb = $cover.find(".wp-post-image")
				
				# Skip problem childs
				return if $thumb.length isnt 1

				$cover.css "position", "static"
				image_width = $thumb.outerWidth(true)

				$cover.css 	
					"width": image_width
					"position": "relative"

			@update_scrollbar('relative')

	update_scrollbar: ( params ) ->
		return false unless @is.setup

		# Set the content width
		@$content.width @get_total_width( $('.hscol') )

		# Update scrollbar
		@$scrollbar.tinyscrollbar_update(params)

	maybe_enable_horizontal_scroll: ->
		
		# First thing we do, check if the server even wants us to do a Horizontal Scroll
		return false unless $("#primary").data("horizontal-scroll") is "on"


		if $("body").hasClass("horizontal-scroll")
			# Mobile ?
			if $(window).width() < 768
				$("body").removeClass("horizontal-scroll").addClass("js-no-tinyscroll")
				$("html").css "overflow-y", "visible"
				return false 
			# Not mobile, and class is already set. Go home.
			else
				return true
		else
			# We should have a .hs class
			if $(window).width() >= 768
				$("body").addClass("horizontal-scroll").removeClass("js-no-tinyscroll")
				return true

			# Window not large enough and no .hs class:
			else
				return false



Layout = new Horizontal_Layout()



# //-----------------------------------*/
# // Events
# //-----------------------------------*/

# Variables    
$scrollbar = Layout.$scrollbar
$content = $("#content")
$body = $("body")


# Events
$(document).keydown (e) ->
	# console.log e
	return unless e.keyCode == 37 or e.keyCode == 38 or e.keyCode == 39 or e.keyCode == 40
	e.preventDefault()

	# Left and Up
	if e.keyCode == 37 or e.keyCode == 38
		$scrollbar.tinyscrollbar_updatescroll(60)
	# Right and Down
	if e.keyCode == 39 or e.keyCode == 40
		$scrollbar.tinyscrollbar_updatescroll(-60)

$scrollbar.one "tscroll", ->
	scroll_happened = true
	$(".blinking-arrow").remove()


$('#main').imagesLoaded ->
	return false unless Layout.maybe_enable_horizontal_scroll()
	Layout.refresh()

	###
		Parallaxy Page Thumbnail
	###
	$page_thumbnail = $("#page-thumbnail")
	if $page_thumbnail.length > 0
		$page_thumbnail_image = $page_thumbnail.find(".wp-post-image")

		$scrollbar.on "tscroll", (e, scroll) ->
			$page_thumbnail_image.css("left", scroll * 0.75)
			return


	if Acid_Options.is_enabled("blinking_arrow", true)		
		$(".vertical-title-container").first().append('<div class="blinking-arrow"></div>')


	if $("ul.page-numbers").length > 0
		# Set a point when to do the next AJAX Load
		nextAjaxLoad = $content.width() * 0.65 - $(window).width()

		# Hide Pagination				
		$(".page-links, .page-numbers").hide()

		###
			Infinite Scroll

			Only Attempt if there is a pagination
		###
		# Setup Infinite Scroll
		$content.infinitescroll
			navSelector: "ul.page-numbers"
			nextSelector: "ul.page-numbers .next"
			finishedMsg: true
			msgText: true
			itemSelector: "#content .hscol"
			errorCallback: ->
				# Unbind the ajax loading function, nothing more to load
				$scrollbar.off "tscroll", maybeLoadAjax
				$("#infscr-loading").remove()
				Layout.update_scrollbar('relative')

			, (items) ->
				$(items).find(".box").append('<div class="dim">')
				
				$('.colorbox').colorbox 
					rel: "portfolio"
					maxHeight: "100%"
					maxWidth: "100%"

				Layout.refresh()
				nextAjaxLoad = $content.width() * 0.8 - $(window).width()
				return

		
		# Unbind Infinite Scroll (we're going to trigger it manually)
		$(window).unbind('.infscr')


		# Maybe load some content, maybe not...
						
		maybeLoadAjax = (e, scroll) ->
			return if nextAjaxLoad is false
			if scroll >= nextAjaxLoad
				nextAjaxLoad = false
				$content.infinitescroll('retrieve')
				return
				

		# Bind to tiny scrollbar scroll event
		$scrollbar.on "tscroll", maybeLoadAjax
		maybeLoadAjax(null, 0) # See explanation below


		###
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
		###	

