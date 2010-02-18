/*
 * Product Zoomer
 * 
 * A hover discovery zoom that display a better resolution of the product
 *
 * Copyright (c) 2008 Cedric Dugas - http://www.position-absolute.com
 * Licenced under the MIT licence
 */
 
$(document).ready(function() {
	$("a.products").productsMagnifier({
		speed:300
	})
});

jQuery.fn.productsMagnifier = function(settings) {
	
 	settings = jQuery.extend({
		speed:300
	}, settings);	
	
	return this.each(function(){
		var caller = this   				 // needed to remember the cliqued
		$("a.products img.front").css("display","block")
		$("a.products img.preview").css("display","none")
		$("a.products img").css("border","none")
		
		/* PRODUCT WIDTH AND HEIGHT*/
		 var loadWidth = $(this).find("img.front").attr("width")
		 var loadHeight = $(this).find("img.front").attr("height")
		
			/* THIS IS USED TO CREATE THE RATIO NEEDED FOR THE MOUSE INTERACTION */
			 var loadWidthPreview5 = $(this).find("img.preview").attr("width")
			 var loadWidthSmallPreview5 = $(this).find("img.front").attr("width")
			
			 var loadHeightPreview5 = $(this).find("img.preview").attr("height")
			 var loadHeightSmallPreview5 = $(this).find("img.front").attr("height")
			
			 var ratioWidth =  (loadWidthPreview5 - loadWidthSmallPreview5 ) / loadWidthSmallPreview5 
			 var ratioHeight =  (loadHeightPreview5 - loadHeightSmallPreview5 ) / loadHeightSmallPreview5 
			

		 var loadWidthPreview = $(this).find("img.preview").attr("width")
		 loadWidthPreview =  loadWidthPreview+"px"
		  loadWidth =  loadWidth+"px"
		
		 var loadHeightPreview = $(this).find("img.preview").attr("height")
		 loadHeightPreview =  loadHeightPreview+"px"
		 loadHeight =  loadHeight+"px"
		$(this).css({
			width: loadWidth,
			height: loadHeight
		})
		$(this).find("img.preview").css({
			position:"absolute",
			width: loadWidth,
			height:loadHeight,
			top:0,
			left:0
		})
		$(this).bind("mouseover",  function(evt){loadPreview(caller,evt)})	
		$(this).bind("mouseout", function(){unloadPreview(caller)})	

		var loadPreview = function(object,evt) {
			$("a.products img.preview").stop()
			 loadAnim = true
			 xLoadAnim = true
			 yLoadAnim = true
	
			$(object).find("img.preview").stop()
			$(object).find("img.front").css("display","none")
			$(object).find("img.preview").css("display","block")
			
			openLink = $(object)
			imgPreview = $(object).find("img.preview")
			imgFront = $(object).find("img.front")

			 var x = ((evt.pageX - $(object).offset().left)* (- ratioWidth));
			 var y = ((evt.pageY - $(object).offset().top)* (- ratioHeight));
			
			openLink.bind("mousemove",  function(evt){movingMouse(imgFront,imgPreview,evt,object)})	
			 /* STARTING ANIMATION */
			imgPreview.animate({
				width:"230px",
				height:loadHeightPreview,
				top: y,
				left: x
			},settings.speed)
		};
		var unloadPreview = function(callback) {
			 imgPreview.stop()
			 openLink.unbind("mousemove",   function(){movingMouse})	
			 imgFront.css("display","block")
			 imgPreview.css("display","none")
	
			 imgPreview.css({
				position:"absolute",
				width: loadWidth,
				height: loadHeight,
				top:0,
				left:0
			})
		};
		var movingMouse = function(imgFront,imgPreview,evt,object) {
			/* GIVE COORDONATE */
			if ( imgPreview.css("width") ==  loadWidthPreview ||  imgPreview.css("height") ==  loadHeightPreview){
				 loadAnim = false
			}	
			 imgPreview.stop()
			 
			 var x = ((evt.pageX -  $(object).offset().left)* (- ratioWidth));
			 var y = ((evt.pageY -  $(object).offset().top)* (- ratioHeight));
			
			if( loadAnim == true){
					 imgPreview.animate({
						width: loadWidthPreview,
						height: loadHeightPreview,
						top: y,
						left: x
					},settings.speed)
			}else{
				 imgPreview.css("top", y)
				 imgPreview.css("left", x)
			}
		};
	});	
};