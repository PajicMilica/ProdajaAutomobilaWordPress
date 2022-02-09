<?php
/**
 * The template part for displaying video post
 * @package Automobile Car Dealer
 * @subpackage automobile_car_dealer
 * @since 1.0
 */
?>

<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video   = false;
  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>    
  <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>  
  <div class="box-image">
    <?php
      if ( ! is_single() ) {
        // If not a single post, highlight the video file.
        if ( ! empty( $video ) ) {
        foreach ( $video as $video_html ) {
          echo '<div class="entry-video">';
            echo $video_html;
          echo '</div>';
         }
        };
      };
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
</article>