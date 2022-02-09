jQuery(function($){
 "use strict";
   jQuery('.main-menu-navigation > ul').superfish({
     delay:       500,                            
     animation:   {opacity:'show',height:'show'},  
     speed:       'fast'                        
   });

});

function automobile_car_dealer_responsive_menu_open() {
	jQuery(".menu-brand").addClass('show');
}
function automobile_car_dealer_responsive_menu_close() {
	jQuery(".menu-brand").removeClass('show');
}

var automobile_car_dealer_Keyboard_loop = function (elem) {

    var automobile_car_dealer_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

    var automobile_car_dealer_firstTabbable = automobile_car_dealer_tabbable.first();
    var automobile_car_dealer_lastTabbable = automobile_car_dealer_tabbable.last();
    /*set focus on first input*/
    automobile_car_dealer_firstTabbable.focus();

    /*redirect last tab to first input*/
    automobile_car_dealer_lastTabbable.on('keydown', function (e) {
        if ((e.which === 9 && !e.shiftKey)) {
            e.preventDefault();
            automobile_car_dealer_firstTabbable.focus();
        }
    });

    /*redirect first shift+tab to last input*/
    automobile_car_dealer_firstTabbable.on('keydown', function (e) {
        if ((e.which === 9 && e.shiftKey)) {
            e.preventDefault();
            automobile_car_dealer_lastTabbable.focus();
        }
    });

    /* allow escape key to close insiders div */
    elem.on('keyup', function (e) {
        if (e.keyCode === 27) {
            elem.hide();
        }
        ;
    });
};

// scroll
jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 0) {
	        jQuery('#scrollbutton').fadeIn();
	    } else {
	        jQuery('#scrollbutton').fadeOut();
	    }
	});
	jQuery(window).on("scroll", function () {
	   document.getElementById("scrollbutton").style.display = "block";
	});
	jQuery('#scrollbutton').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});

});

jQuery(function($){
	$(window).load(function() {
		$(".loader").delay(2000).fadeOut("slow");
	    $(".frame").delay(2000).fadeOut("slow");
	})

	$('.mobiletoggle').click(function () {
        automobile_car_dealer_Keyboard_loop($('.menu-brand'));
    });
});

(function( $ ) {

	$(window).scroll(function(){
		var sticky = $('.sticky-header'),
		scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('fixed-header');
		else sticky.removeClass('fixed-header');
	});

})( jQuery );