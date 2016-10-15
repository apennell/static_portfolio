(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B=function(a,b){return function(){return a.apply(b,arguments)}},C=function(a,b){function c(){this.constructor=a}for(var d in b)D.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},D={}.hasOwnProperty;a=jQuery,s=function(){function a(a){this.options=a}return a.prototype.get_option=function(a){return this.options[a]},a.prototype.is_falsy=function(a){return this.is_bool(this.parse_falsy(a))},a.prototype.is_bool=function(a){return a===!0||a===!1||"[object Boolean]"===toString.call(a)},a.prototype.parse_falsy=function(a){var b;return b=this.get_option(a),"false"===b?!1:"true"===b?!0:b},a.prototype.is_enabled=function(a,b){return null==b&&(b=!1),this.is_falsy(a)?this.parse_falsy(a):b},a}(),n=new s(ACID_OPTIONS_CONFIG),jQuery.fn.textWidth=function(a,b){var c;return c=jQuery(this),jQuery.fn.textWidth.fakeEl||(jQuery.fn.textWidth.fakeEl=jQuery("<span>").hide().appendTo(document.body)),jQuery.fn.textWidth.fakeEl.html(a||c.text()).css("font",b||c.css("font")||32),jQuery.fn.textWidth.fakeEl.width()},a(document).imagesLoaded(function(){return a("#village-loading").velocity("fadeOut")}),a=jQuery,o=wp.hooks,t=function(){function b(b){this.toggle=B(this.toggle,this),this.load=B(this.load,this),this.selectors=b,this._URL=!1,this._loaded_URL=!1,this._IS_LOADING=!1,this._AJAX=!1,this.is_open=!1,this.iface={window:a(window),body:a("html,body"),preview:this.selectors.preview}}return b.prototype.load=function(b){var c,d,e;return c=[],d="",(this.is_open||this.is_new_url(b))&&c.push(this.close()),e=a.get(b),this._IS_LOADING=!0,this._AJAX=e,c.push(e),e.always(function(a){return function(){a._IS_LOADING=!1}}(this)),e.done(function(b){return function(c){var e;return e=a(c),d=e.find(b.selectors.content),b.cache_data(d)}}(this)),a.when.apply(null,c).done(function(a){return function(){return a.on_load_complete(d)}}(this)),c},b.prototype.on_load_complete=function(a){return this.cache_url(this._URL),this.open(a)},b.prototype.open=function(){return this.is_open=!0,this.iface.preview.container.show()},b.prototype.close=function(){return this.is_open=!1,this.iface.preview.container.hide()},b.prototype.toggle=function(a){return this._URL=a,this.is_open!==!0||this.is_new_url(this._URL)?this.reopen(a):this.close()},b.prototype.reopen=function(a){return this.is_new_url(this._URL)?this.load(a):(this.is_open===!0&&this.close(),this.open())},b.prototype.is_new_url=function(a){return a!==this._loaded_URL},b.prototype.cache_url=function(a){this._loaded_URL=a,this._URL=!1},b.prototype.cache_data=function(a){this._cached=a.clone().hide()},b.prototype.get_cached_data=function(){return this._cached.clone().show()},b}(),r=function(b){function c(){return this.toggle=B(this.toggle,this),c.__super__.constructor.apply(this,arguments)}return C(c,b),c.prototype.toggle=function(a){return this.is_open===!1&&this.iface.preview.overlay.velocity("stop").velocity("fadeIn"),c.__super__.toggle.call(this,a)},c.prototype.open=function(a){var b;return this.iface.preview.content.css("height",""),this.iface.preview.container.css({top:"",display:"block"}),this.iface.preview.content.html(a),b=this.iface.preview.content.height(),this.iface.preview.content.css({height:b,display:"none"}),o.doAction("ajax_popup.before_open"),this.iface.preview.content.velocity("stop").velocity({properties:"slideDown",options:{easing:"easeInOutQuint",display:"block",complete:function(a){return function(){a.is_open=!0}}(this)}})},c.prototype.close=function(b){var c;return c=new a.Deferred,c.promise(),this._IS_LOADING&&b===!0&&this._AJAX.abort(),this.is_new_url(this._URL)&&b!==!0||this.iface.preview.overlay.velocity("stop").velocity({properties:"fadeOut",options:{easing:"easeOutQuad",duration:400}}),this.is_open?(this.iface.preview.container.velocity({properties:{top:0},options:{easing:"easeInOutQuint",duration:400}}),this.iface.preview.content.velocity({properties:"slideUp",options:{easing:"easeOutQuint",duration:400,complete:function(a){return function(){a.is_open=!1,c.resolve()}}(this)}}),c):(c.resolve(),c)},c}(t),a(window).load(function(){var b,c,d,e,f;return f={preview:{overlay:a("#overlay"),content:a("#ajax-popup-content"),container:a("#ajax-popup")},content:"#content .entry-content"},e=new r(f),b=a(".sf-menu .with-ajax > a, .acid-ajax-link > a, a.acid-ajax-link"),c=a("#popup-arrow"),d=!1,b.click(function(b){var c;return b.preventDefault(),d=a(b.srcElement||b.target),c=d.attr("href"),e.toggle(c)}),o.addAction("ajax_popup.before_open",function(){return c.velocity({left:d.offset().left},{duration:200})}),a("#overlay").click(function(b){return d=a(b.srcElement||b.target),"overlay"===d.attr("id")?e.close(!0):void 0}),a(document).on("keyup",function(a){return 27===a.keyCode?e.close(!0):void 0})}),a("#content").imagesLoaded(function(){var b,c;return b=a(".purejs__slider--control"),c=a(".purejs__slider"),null!=c.length?(c.find("li").length>1&&(null!=b.length&&b.flexslider({animation:"slide",controlNav:!0,animationLoop:!1,slideshow:!1,itemWidth:125,itemMargin:5,asNavFor:c,smoothHeight:!1}),c.flexslider({animation:"swing",controlNav:!1,animationLoop:!1,slideshow:!1,sync:b,smoothHeight:!0,video:!0,itemWidth:"100%"})),a(".purejs__slider .popup-image").colorbox({top:10,rel:"portfolio",maxWidth:"100%",maxHeight:"100%"})):void 0}),jQuery(function(a){var b,c,d,e,f;a(document.body).append('<div id="follower"><span class="text"></span><div id="follower-arrow"></div</div>'),b=a("#follower").css("display","none"),e=b.find(".text"),d=0,f=0,a(".box [title]").attr("title",""),a(".box").append('<div class="dim">'),a("#scrollbar").on("tscroll",function(){b.hide()}),c={mouseenter:function(){var c;c=a(this).data("followerColor"),a(e).html(a(this).find(".entry-title").text()),b.show().css({width:a(e).textWidth()+30,"background-color":c}),a("#follower-arrow").css({"border-color":c+" transparent transparent transparent"}),d=b.outerHeight()+25,f=b.width()},mouseleave:function(){b.hide()},mousemove:function(a){b.css({top:a.pageY-d,left:a.pageX})},click:function(b){var c,d,e,f;if(!b.isTrigger&&(d=a(this),c=d.find(".js--link").first(),!c.is(".js--ignore")))return c.is(".colorbox")?c.click():(f=c.attr("href"),e=c.attr("target"),b.metaKey||null!=e&&"_blank"===e.toLowerCase()?window.open(f,"_blank"):window.location.href=f),b.preventDefault()}},a(document.body).on(c,".box")}),n.is_enabled("footer_toggle",!0)&&(g=a("#footer-content"),e=a("#footer-arrow"),f=e.find("span"),x=!1,e.click(function(){return x?(f.text("+"),g.velocity({properties:"slideUp",options:{duration:400,easing:"easeOutQuad"}})):(f.text("-"),g.velocity({properties:"slideDown",options:{duration:400,easing:"easeOutQuad"}})),x=!x})),a=jQuery,p=function(){function b(){this.refresh=B(this.refresh,this),this.setup=B(this.setup,this),this.$scrollbar=a("#scrollbar"),this.$content=a("#content"),this.is={enabled:this.maybe_enable_horizontal_scroll(),setup:!1},this.properties={scrollbar:{height:a("#scrollbar").find("> .scrollbar").height()},canvas:!1,width:a(window).width()},a(document).on("ready",this.setup),a(window).on("load debouncedresize",this.refresh)}return b.prototype.setup=function(){return this.is.setup||!this.is.enabled?!1:(this.is.setup=!0,a("body").data("ready","fired"),a("html").css("overflow-y","hidden"),this.$scrollbar.tinyscrollbar({axis:"x",invertscroll:!0}))},b.prototype.refresh=function(){var b,c,d,e,f,g,h,i,j,k;return this.is.enabled=this.maybe_enable_horizontal_scroll(),this.is.enabled?(this.is.setup===!1&&this.setup(),j=a(window).height(),k=a(window).width(),f=this.$content.height()-this.properties.scrollbar.height,this.update_cover_images(),this.$content.find(".vertical-title").css("width",Math.round(f)),f!==this.properties.canvas||k!==this.properties.width?(this.properties.canvas=f,this.properties.width=k,g=1,h=2,d=Math.round(f/h),e=Math.round(d*g),i=".hscol { \n	width: "+e+"px; \n}\n.hscol .box {\n	width: "+e+"px; \n	height: "+e+"px; \n}\n.hscol.full, .hscol.full .box { \n	width: "+f+"px; \n	height: "+f+"px; \n}",b=a(document.head),c=b.find("#js__style"),1===c.length?c.html(i):b.append('<style id="js__style" type="text/css">'+i+"</style>"),this.update_scrollbar("relative")):void 0):!1},b.prototype.get_total_width=function(b){var c,d,e,f,g;for(g=0,e=d=0,f=b.length;f>d;e=++d)c=b[e],g+=a(c).outerWidth();return g},b.prototype.resize_columns=function(b,c){var d,e,f,g,h,i;return null==c&&(c=.5),d=a(b),h=Math.floor(this.$content.height()*c),f=parseInt(d.find(".wp-post-image").first().attr("height"),10),g=parseInt(d.find(".wp-post-image").first().attr("width"),10),isNaN(f)||isNaN(g)||0===g||0===f?void 0:(e=f/g,i=Math.round(h/e),d.find(".box").css({height:h,width:i}))},b.prototype.update_cover_images=function(){var b;return b=this.$content.find(".cover-image"),b.length>=1?(b.each(function(b,c){var d,e,f;return d=a(c),e=d.find(".wp-post-image"),1===e.length?(d.css("position","static"),f=e.outerWidth(!0),d.css({width:f,position:"relative"})):void 0}),this.update_scrollbar("relative")):void 0},b.prototype.update_scrollbar=function(b){return this.is.setup?(this.$content.width(this.get_total_width(a(".hscol"))),this.$scrollbar.tinyscrollbar_update(b)):!1},b.prototype.maybe_enable_horizontal_scroll=function(){return"on"!==a("#primary").data("horizontal-scroll")?!1:a("body").hasClass("horizontal-scroll")?a(window).width()<768?(a("body").removeClass("horizontal-scroll").addClass("js-no-tinyscroll"),a("html").css("overflow-y","visible"),!1):!0:a(window).width()>=768?(a("body").addClass("horizontal-scroll").removeClass("js-no-tinyscroll"),!0):!1},b}(),q=new p,l=q.$scrollbar,c=a("#content"),b=a("body"),a(document).keydown(function(a){return 37===a.keyCode||38===a.keyCode||39===a.keyCode||40===a.keyCode?(a.preventDefault(),(37===a.keyCode||38===a.keyCode)&&l.tinyscrollbar_updatescroll(60),39===a.keyCode||40===a.keyCode?l.tinyscrollbar_updatescroll(-60):void 0):void 0}),l.one("tscroll",function(){var b;return b=!0,a(".blinking-arrow").remove()}),a("#main").imagesLoaded(function(){var b,d,e,f;return q.maybe_enable_horizontal_scroll()?(q.refresh(),b=a("#page-thumbnail"),b.length>0&&(d=b.find(".wp-post-image"),l.on("tscroll",function(a,b){d.css("left",.75*b)})),n.is_enabled("blinking_arrow",!0)&&a(".vertical-title-container").first().append('<div class="blinking-arrow"></div>'),a("ul.page-numbers").length>0?(f=.65*c.width()-a(window).width(),a(".page-links, .page-numbers").hide(),c.infinitescroll({navSelector:"ul.page-numbers",nextSelector:"ul.page-numbers .next",finishedMsg:!0,msgText:!0,itemSelector:"#content .hscol",errorCallback:function(){return l.off("tscroll",e),a("#infscr-loading").remove(),q.update_scrollbar("relative")}},function(b){a(b).find(".box").append('<div class="dim">'),a(".colorbox").colorbox({rel:"portfolio",maxHeight:"100%",maxWidth:"100%"}),q.refresh(),f=.8*c.width()-a(window).width()}),a(window).unbind(".infscr"),e=function(a,b){f!==!1&&b>=f&&(f=!1,c.infinitescroll("retrieve"))},l.on("tscroll",e),e(null,0)):void 0):!1}),o=wp.hooks,a=jQuery,j=a("#navigation"),i=a("#logo"),j.find(".logo-placeholder").length>0?(k=j.find(".logo-placeholder").first(),h=i.hide().clone().attr("id","js-logo").show().insertBefore(k).wrap('<li id="logo-container" class="menu-item"/>'),k.remove()):(y=a(".sf-menu > .menu-item").length,y>0?(A=Math.ceil(y/2),a("#logo").hide().clone().attr("id","js-logo").show().insertAfter(".sf-menu > .menu-item:nth-child("+A+")").wrap('<li id="logo-container" class="menu-item"/>')):a("#logo").addClass("center-block")),a(document).ready(function(a){return a("#menu-main-menu").clone().attr("id","responsive-menu-selectnav").insertAfter("#menu-main-menu").find(".logo-placeholder, #js-logo").remove(),selectnav("responsive-menu-selectnav",{label:"Menu",nested:!0,indent:"-",activeclass:"current-menu-item"}),a("#responsive-menu-selectnav").remove(),j=a(".selectnav"),j.wrapAll('<div class="selectnav-wrap">'),a("#content").fitVids(),a("#wpadminbar").length>0&&a(".sf-container").addClass("offset"),a(".sf-menu").superfish({hoverClass:"sfHover",pathLevels:1,delay:500,animation:{height:"toggle"},speed:175,autoArrows:!0,disableHI:!1,onShow:function(){a(this).css("overflow","visible")}}),a(".colorbox").colorbox({rel:"portfolio",maxHeight:"100%",maxWidth:"100%"})}),a=jQuery,m=a(window),d=a(document),u=function(a){return"prev-post"===a?"right":"left"},w=function(b){return a(b).textWidth()!==m.width()?a(b).textWidth():0},v=function(){var b;return b=(m.width()-a("#container").outerWidth())/2},z=function(){var b;return b=v(),a("#prev-post .meta").css({right:b,position:"absolute"}),a("#next-post .meta").css({left:b,position:"absolute"})},d.ready(function(){var b,c;return z(),b=!1,c=w(w("#prev-post")>w("#next-post")?"#prev-post":"#next-post"),c+=90,a("#next-post, #prev-post").velocity({properties:{width:v()},options:{duration:600,delay:250,easing:"easeInOutQuart",complete:function(){a("#next-post, #prev-post").css({overflow:"visible"}),b=!0}}}),a(".js--post-link").hoverIntent({over:function(){return b===!0?(a(this).css({backgroundColor:a(this).data("color")}),a(this).find(".meta").velocity({width:c},{duration:300,easing:"easeOutExpo"})):void 0},out:function(){return b===!0?(a(this).css({backgroundColor:a("#content").data("color")}),a(this).find(".meta").velocity({width:0},{duration:250,easing:"easeInQuad"})):void 0},timeout:100,interval:150}),a(".js--post-link").click(function(b){var c;c=a(this).find(".adjacent-title a").attr("href"),null!=c&&(b.metaKey?window.open(c,"_blank"):window.location=c)}),m.on("resize",function(){return z(),a(".js--post-link").css({width:v()})})})}).call(this);