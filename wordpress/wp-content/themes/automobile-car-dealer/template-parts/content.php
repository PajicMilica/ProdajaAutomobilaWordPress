<?php
/**
 * The template part for displaying content
 * @package Automobile Car Dealer
 * @subpackage automobile_car_dealer
 * @since 1.0
 */
?>
<?php $automobile_car_dealer_theme_lay = get_theme_mod( 'automobile_car_dealer_post_layouts','Layout 1');
if($automobile_car_dealer_theme_lay == 'Layout 1'){ 
  get_template_part('template-parts/Post-layouts/layout1'); 
}else if($automobile_car_dealer_theme_lay == 'Layout 2'){ 
  get_template_part('template-parts/Post-layouts/layout2'); 
}else if($automobile_car_dealer_theme_lay == 'Layout 3'){ 
  get_template_part('template-parts/Post-layouts/layout3'); 
}else{ 
  get_template_part('template-parts/Post-layouts/layout1'); 
}