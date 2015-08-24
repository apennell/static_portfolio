# Calculate width of text from DOM element or string. By Phil Freo <http://philfreo.com>
jQuery.fn.textWidth = (text, font) ->
	$el = jQuery(this)
	
	unless jQuery.fn.textWidth.fakeEl
		jQuery.fn.textWidth.fakeEl = jQuery("<span>").hide().appendTo(document.body)  
	
	jQuery.fn.textWidth.fakeEl
		.html(text or $el.text())
		.css("font", font or $el.css("font") or 32 )
	jQuery.fn.textWidth.fakeEl.width()