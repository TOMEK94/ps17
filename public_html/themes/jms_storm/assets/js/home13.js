/**
* 2007-2018 PrestaShop
*
* Joommasters Theme
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/
$(window).load(function(){
	if($('.slider').length > 0)
	$('.slider').fractionSlider({	
		'slideTransition' : jmsslider_trans,
		'slideEndAnimation' : jmsslider_end_animate,
		'transitionIn' : jmsslider_trans_in,
		'transitionOut' : jmsslider_trans_out,
		'fullWidth' : jmsslider_full_width,
		'delay' : jmsslider_delay,
		'timeout' : jmsslider_duration,
		'speedIn' : jmsslider_speed_in,
		'speedOut' : jmsslider_speed_out,
		'easeIn' : jmsslider_ease_in,
		'easeOut' : jmsslider_ease_out,
		'controls' : jmsslider_navigation,
		'pager' : jmsslider_pagination,
		'autoChange' : jmsslider_autoplay,
		'pauseOnHover' : jmsslider_pausehover,
		'backgroundAnimation' : jmsslider_bg_animate,
		'backgroundEase' : jmsslider_bg_ease,
		'responsive' : jmsslider_responsive,
		'dimensions' : jmsslider_dimensions,
		'fullscreen' : true
	});
});

jQuery(function ($) {
    "use strict";
    if($(".product-carousel").length) {		
		var productCarousel = $(".product-carousel");			
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		productCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:p_itemsDesktop
				},
				991:{
					items:p_itemsDesktopSmall
				},
				768:{
					items:p_itemsTablet
				},
				481:{
					items:p_itemsMobile
				},
				361:{
					items:1
				},
				0:{
					items:1
				}
			},
			rtl: rtl,
			margin:0,
			nav: p_nav,
			dots: p_pag,
			loop: true,
			autoplay: auto_play_carousel,
			slideSpeed: 800,
		});
	}

	if($(".product-carousel-col1").length) {		
		var productCarouselcol1 = $(".product-carousel-col1");			
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		productCarouselcol1.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:p1_itemsDesktop
				},
				991:{
					items:p1_itemsDesktopSmall
				},
				768:{
					items:p1_itemsTablet
				},
				481:{
					items:p1_itemsMobile
				},
				361:{
					items:1
				},
				0:{
					items:1
				}
			},
			rtl: rtl,
			margin:0,
			nav: p1_nav,
			dots: p1_pag,
			loop: true,
			autoplay: p1_auto_play_carousel,
			slideSpeed: 800,
		});
	}

	if($(".categorytab-carousel").length) {
		var categorytabCarousel = $(".categorytab-carousel");			
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		categorytabCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:cattab_itemsDesktop
				},
				991:{
					items:cattab_itemsDesktopSmall
				},
				768:{
					items:cattab_itemsTablet
				},
				481:{
					items:cattab_itemsMobile
				},
				361:{
					items:1
				},
				0: {
					items:1
				}
			},
			rtl: rtl,
				margin: 0,
			    nav: cattab_nav,
		        dots: cattab_pag,
				autoplay: cattab_auto_play_carousel,
				loop:true,
			    navigationText: ["", ""],
			    slideSpeed: 200
		});
	}

	if($(".instagram-carousel").length) {
		var instagramCarousel = $(".instagram-carousel");
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		instagramCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:5
					},
				991:{
					items:4
				},
				768:{
					items:3
				},
				481:{
					items:2
					},
				0: {
					items:2
				}
			},
			rtl: rtl,
			margin: 0,
			nav: false,
			dots: false,
			autoplay: true,
			slideSpeed: 200,
			loop: true
		});
	}
	
	if($(".producttab-carousel").length) {
		var producttabCarousel = $(".producttab-carousel");			
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		producttabCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:tab_itemsDesktop
				},
				991:{
					items:tab_itemsDesktopSmall
				},
				768:{
					items:tab_itemsTablet
				},
				481:{
					items:tab_itemsMobile
				},
				361:{
					items:1
				},
				0: {
					items:1
				}
			},
			rtl: rtl,
				margin: 0,
			    nav: p_nav_tab,
		        dots: p_pag_tab,
				autoplay: auto_play_tab,
				loop:true,
			    navigationText: ["", ""],
			    slideSpeed: 200
		});
	}

	if($(".hotdeal-carousel").length) {		
		var hotdealCarousel = $(".hotdeal-carousel");			
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		hotdealCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:h_itemsDesktop
				},
				991:{
					items:h_itemsDesktopSmall
				},
				768:{
					items:h_itemsTablet
				},
				481:{
					items:h_itemsMobile
				},
				361:{
					items:1
				},
				0:{
					items:1
				}
			},
			rtl: rtl,
			margin: 0,
			nav: h_nav,
			dots: h_pag,
			loop:true,
			autoplay: h_auto_play_carousel,
			slideSpeed: 800,
		});
	}
});


jQuery(document).ready(function($) {
	var menu = $(".jms-row.menu");

	$(window).scroll(function () {
    	if ($(window).scrollTop()){
			menu.addClass("fixed");
    	} else {
			menu.removeClass("fixed");
    	}
    });
    
	$(".hot_product .product-miniature").hover(function(){
	    $(".hot_product").css("z-index", "4");
		}, function(){
        $(".hot_product").css("z-index", "2");
	});
	$(".product_tab .product-miniature").hover(function(){
	    $(".product_tab").css("z-index", "5");
		}, function(){
        $(".product_tab").css("z-index", "3");
	});
	$(".men .product-miniature").hover(function(){
	    $(".men").css("z-index", "3");
		}, function(){
        $(".men").css("z-index", "1");
	});
	$(".men .left").hover(function(){
	    $(".men .left").css("z-index", "3");
		}, function(){
        $(".men .left").css("z-index", "1");
	});
});