
$(document).ready ($) ->
	# /* -----------------------------------*/
	# /*   Select (responsive) Navigation
	# /* -----------------------------------*/
	$('#menu-main-menu')
		.clone()
		.attr('id', 'responsive-menu-selectnav')
		.insertAfter('#menu-main-menu')
		.find('.logo-placeholder, #js-logo')
		.remove()

	selectnav 'responsive-menu-selectnav',
		label: 'Menu',
		nested: true,
		indent: '-'
		activeclass: 'current-menu-item'

	$('#responsive-menu-selectnav').remove()

	$nav = $('.selectnav')
	$nav.wrapAll('<div class="selectnav-wrap">')




	# /* -----------------------------------*/
	# /*         FitVids 
	# /* -----------------------------------*/
	$("#content").fitVids()

	# A Special class for logged in users
	# Should actually do this through wordpress classes, but hey...
	if $("#wpadminbar").length > 0
		$(".sf-container").addClass("offset")



	# /* -----------------------------------*/
	# /*         Superfish
	# /* -----------------------------------*/

	# Superfish itself
	$('.sf-menu').superfish
		# the class applied to hovered list items
		hoverClass:    'sfHover',          
		
		# the class you have applied to list items that lead to the current page
		# pathClass:     'current-menu-ancestor', 
		
		# the number of levels of submenus that remain open or are restored using pathClass
		pathLevels:    1              
		
		# the delay in milliseconds that the mouse can remain outside a submenu without it closing
		delay:         500               
		
		# an object equivalent to first parameter of jQuery’s .animate() method
		animation:     
			height:'toggle' 
		
		# speed of the animation. Equivalent to second parameter of jQuery’s .animate() method
		speed:         175          
		
		# if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
		autoArrows:    true

		#set to true to disable hoverIntent detection              
		disableHI:     false

		onShow: ->
			$(this).css "overflow", "visible"
			return

	$('.colorbox').colorbox 
		rel: "portfolio"
		maxHeight: "100%"
		maxWidth: "100%"



