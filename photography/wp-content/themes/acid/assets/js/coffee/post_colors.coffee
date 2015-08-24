$ = jQuery
$win = $(window)
$doc = $(document)


get_direction = (selector) ->
	if selector is "prev-post"
		return "right"
	else
		return "left"

# Fixes a little textWidth() bug when there is no text
get_width = (selector) ->
	if $(selector).textWidth() isnt $win.width()
	then $(selector).textWidth()
	else 0


get_gutter_width = ->
	# Calculate Content Position and Gutter Width
	#	contentPosition = $("#container").offset()
	gutter_width = ( $win.width() - $("#container").outerWidth() ) / 2
	return gutter_width

setup_meta_position = ->
	GW = get_gutter_width()

	$("#prev-post .meta").css
		"right": GW
		"position": "absolute"

	$("#next-post .meta").css
		"left": GW
		"position": "absolute"

$doc.ready ->
	setup_meta_position() # Setup Meta Position

	hoverEnabled = false # Disable Hover until the opening Animation is complete

	longestWidth =
		if get_width("#prev-post") > get_width("#next-post")
		then get_width("#prev-post")
		else get_width("#next-post")
	longestWidth = longestWidth + 90



	$("#next-post, #prev-post").velocity
		properties:
			   width: get_gutter_width()
		options:
			duration: 600
			delay: 250
			easing: "easeInOutQuart"
			complete: ->
				$("#next-post, #prev-post").css overflow: "visible"
				hoverEnabled = true
				return

	$(".js--post-link").hoverIntent
		over: ->
			if hoverEnabled is true
				$(this).css
					backgroundColor: $(this).data("color")

				$(this).find(".meta").velocity width: longestWidth,
					duration: 300
					easing: "easeOutExpo"

		out: ->
			if hoverEnabled is true
				$(this).css
					backgroundColor: $("#content").data("color")
				$(this).find(".meta").velocity width: 0,
					duration: 250
					easing: "easeInQuad"
		timeout: 100
		interval: 150


	$(".js--post-link").click (e) ->
		url = $(this).find(".adjacent-title a").attr("href")

		if url?
			if e.metaKey
				window.open url, '_blank'
			else
				window.location = url
			return


	$win.on "resize", ->
		setup_meta_position()
		$(".js--post-link").css
			width: get_gutter_width()




