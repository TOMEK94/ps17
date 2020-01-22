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
			autoplay: auto_play_carousel,
			loop: true,
			slideSpeed: 800,
		});
	}
	
	if($(".product-carousel2").length) {		
		var productCarousel2 = $(".product-carousel2");			
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		productCarousel2.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:p2_itemsDesktop
				},
				991:{
					items:p2_itemsDesktopSmall
				},
				768:{
					items:p2_itemsTablet
				},
				481:{
					items:p2_itemsMobile
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
			nav: p2_nav,
			dots: p2_pag,
			loop: true,
			autoplay: p2_auto_play_carousel,
			slideSpeed: 800,
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

	if($(".brand-carousel").length) {
		var brandCarousel = $(".brand-carousel");		
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		brandCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:brand_itemsDesktop
				},
				991:{
					items:brand_itemsDesktopSmall
				},
				768:{
					items:brand_itemsTablet
				},
				481:{
					items:brand_itemsMobile
				},
				0: {
					items:1
				}
			},
				rtl: rtl,
				margin: 30,
				nav: p_nav_brand,
		        dots: p_pag_brand,
				autoplay:auto_play_brand,
				loop: true,
				slideSpeed: 800,	
		});
	}

	if($(".blog-carousel").length) {
		var blogCarousel = $(".blog-carousel");		
		var rtl = false;
		if ($("body").hasClass("rtl")) rtl = true;				
		blogCarousel.owlCarousel({
			responsiveClass:true,
			responsive:{			
				1199:{
					items:blog_itemsDesktop
				},
				991:{
					items:blog_itemsDesktopSmall
				},
				768:{
					items:blog_itemsTablet
				},
				481:{
					items:blog_itemsMobile
				},
				0: {
					items:1
				}
			},
				rtl: rtl,
				margin: 0,
				nav: p_nav_blog,
		        dots: p_pag_blog,
				autoplay:auto_play_blog,
				loop: true,
				slideSpeed: 800,	
		});
	}
});


jQuery(document).ready(function($) {
	var menu = $(".jms-row.menu");
	var close = $(".menu .left .addon-box:first-child");
	var verMegaMenu = $(".page-index #jms-vermegamenu-container");

	$(window).scroll(function () {
    	if ($(window).scrollTop()){
			menu.addClass("fixed");
			close.addClass("closed");
			verMegaMenu.removeClass('in');

    	} else {
			menu.removeClass("fixed");
			close.removeClass("closed");
			verMegaMenu.addClass('in');
    	}
    });
    
	$('.ver_menu_mobile').click(function(event) {
		$(this).parent().toggleClass('open');
	}); 
	
	$("#mobile-vermegamenu").addClass('collapse');
	$("#jms-vermegamenu-container").addClass('collapse');
	verMegaMenu.addClass('collapse in');
	$('.page-index .ver_menu').click(function(event) {
		$(this).parent().toggleClass('closed');
	});
	$(".product_tab .product-miniature").hover(function(){
	    $(".product_tab").css("z-index", "3");
		}, function(){
        $(".product_tab").css("z-index", "1");
	});
	$(".most_view .product-miniature").hover(function(){
	    $(".most_view").css("z-index", "3");
		}, function(){
        $(".most_view").css("z-index", "1");
	});
});