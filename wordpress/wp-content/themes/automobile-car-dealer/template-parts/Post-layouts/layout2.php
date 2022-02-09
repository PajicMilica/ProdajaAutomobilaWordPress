<?php
/**
 * The template part for displaying content
 * @package Ecommerce Solution
 * @subpackage automobile_car_dealer
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="layout2">    
    <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>  
    <div class="box-image">
      <?php 
        if(has_post_thumbnail()) { 
          the_post_thumbnail(); 
        }
      ?>
    </div>
    <div class="new-text">
      <?php $excerpt = get_the_excerpt(); echo esc_html( automobile_car_dealer_string_limit_words( $excerpt, esc_attr(get_theme_mod('automobile_car_dealer_post_excerpt_number','30')))); ?> <?php echo esc_html( get_theme_mod('automobile_car_dealer_post_discription_suffix','[...]') ); ?>
    </div> 
    <?php if( get_theme_mod('automobile_car_dealer_button_text','View More') != ''){ ?>
      <div class="postbtn">
        <a class="read-more" href="<?php the_permalink(); ?>"><i class="<?php echo esc_attr(get_theme_mod('automobile_car_dealer_button_icon','fas fa-long-arrow-alt-right')); ?>"></i><?php echo esc_html(get_theme_mod('automobile_car_dealer_button_text',__('View More','automobile-car-dealer' )));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('automobile_car_dealer_button_text',__('View More','automobile-car-dealer' )));?></span></a>
      </div>
    <?php }?>
  </div>
</article>