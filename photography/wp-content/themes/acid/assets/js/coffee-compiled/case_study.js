(function() {
  $('#content').imagesLoaded(function() {
    var control, slider;
    control = $(".purejs__slider--control");
    slider = $(".purejs__slider");
    if (slider.length != null) {
      if (slider.find("li").length > 1) {
        if (control.length != null) {
          control.flexslider({
            animation: "slide",
            controlNav: true,
            animationLoop: false,
            slideshow: false,
            itemWidth: 125,
            itemMargin: 5,
            asNavFor: slider,
            smoothHeight: false
          });
        }
        slider.flexslider({
          animation: "swing",
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          sync: control,
          smoothHeight: true,
          video: true,
          itemWidth: "100%"
        });
      }
      return $(".purejs__slider .popup-image").colorbox({
        top: 10,
        rel: "portfolio",
        maxWidth: "100%",
        maxHeight: "100%"
      });
    }
  });

}).call(this);
