<?php
/**
 * @package Automobile Car Dealer
 * @subpackage automobile-car-dealer
 * @since automobile-car-dealer 1.0
 * Setup the WordPress core custom header feature.
 * @uses automobile_car_dealer_header_style()
*/

function automobile_car_dealer_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'automobile_car_dealer_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 120,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'automobile_car_dealer_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'automobile_car_dealer_custom_header_setup' );

if ( ! function_exists( 'automobile_car_dealer_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see automobile_car_dealer_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'automobile_car_dealer_header_style' );
function automobile_car_dealer_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$automobile_car_dealer_custom_css = "
        #header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		    background-size: 100% 100%;
		}";
	   	wp_add_inline_style( 'automobile-car-dealer-basic-style', $automobile_car_dealer_custom_css );
	endif;
}
endif; // automobile_car_dealer_header_style