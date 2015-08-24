$('#content').imagesLoaded ->
	control = $(".purejs__slider--control")
	slider = $(".purejs__slider")

	# Portfolio Slider
	if slider.length?
		if slider.find("li").length > 1
	# slider.find('ul').clone().appendTo(control)
			if control.length?
				control.flexslider
					animation: "slide"
					controlNav: true
					animationLoop: false
					slideshow: false
					itemWidth: 125
					itemMargin: 5
					asNavFor: slider
					smoothHeight: false


			slider.flexslider
				animation: "swing"
				controlNav: false
				animationLoop: false
				slideshow: false
				sync: control
				smoothHeight: true
				video: true,
				itemWidth: "100%",

		$(".purejs__slider .popup-image").colorbox
			top: 10
			rel: "portfolio"
			maxWidth: "100%"
			maxHeight: "100%"