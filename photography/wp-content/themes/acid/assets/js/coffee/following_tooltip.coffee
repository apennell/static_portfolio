jQuery ($) ->

	# /* -----------------------------------*/
	# /* 		The Follower
	# /* -----------------------------------*/
	# Setup
	$( document.body ).append('<div id="follower"><span class="text"></span><div id="follower-arrow"></div</div>')
	$tooltip = $("#follower").css('display', 'none')

	tooltip_text = $tooltip.find(".text")

	# Default H/W (Register globalish variables)
	tooltip_height = 0
	tooltip_width = 0

	# Hide all the titles
	# $('.box .entry-title').hide()
	$('.box [title]').attr("title", "")
	$('.box').append('<div class="dim">')

	$("#scrollbar").on "tscroll", ->
			$tooltip.hide()
			return
	# On Hover
	box_event_actions = 
		mouseenter: ->
			followerColor = $(this).data("followerColor")	

			$( tooltip_text ).html( $(this).find(".entry-title").text() )
			$tooltip.show().css
				"width": $( tooltip_text ).textWidth() + 30
				"background-color": followerColor

			$("#follower-arrow").css
				"border-color": "#{followerColor} transparent transparent transparent"

			# Set variables used on Mousemove H/W
			tooltip_height = $tooltip.outerHeight() + 25
			tooltip_width = $tooltip.width() 

			return

		mouseleave: -> 
			$tooltip.hide()
			return
		
		mousemove: (e) ->
			$tooltip.css
				top: e.pageY - tooltip_height
				left: e.pageX 
			return

		click: (e) ->

			# Remove triggerCeption
			return if e.isTrigger

			$this = $(this)
			$link = $this.find('.js--link').first()

			# Don't do anything at all if this link has a class of js--ignore
			return if $link.is('.js--ignore')

			if $link.is('.colorbox')
				$link.click()

			else
				url = $link.attr('href')
				target = $link.attr('target')

				if e.metaKey or ( target? and target.toLowerCase() is '_blank' )
					window.open( url, '_blank' )
				else
					window.location.href = url

			e.preventDefault()

			
	$(document.body).on box_event_actions, ".box"
	return

