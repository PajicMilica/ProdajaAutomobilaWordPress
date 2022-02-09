<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="skip_content" role="main">
  <?php do_action( 'automobile_car_dealer_above_slider' ); ?>

  <?php if( get_theme_mod('automobile_car_dealer_slider_hide',false) != '' || get_theme_mod( 'automobile_car_dealer_display_slider',false) != ''){ ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $automobile_car_dealer_slider_page = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'automobile_car_dealer_slider' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $automobile_car_dealer_slider_page[] = $mod;
            }
          }
          if( !empty($automobile_car_dealer_slider_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $automobile_car_dealer_slider_page,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>     
          <div class="carousel-inner" role="listbox">
            <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
              <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                <?php the_post_thumbnail(); ?>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                    <h1><?php the_title(); ?></h1>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( automobile_car_dealer_string_limit_words( $excerpt, esc_attr(get_theme_mod('automobile_car_dealer_slider_excerpt_number','30')))); ?></p>
                    <?php if (get_theme_mod( 'automobile_car_dealer_show_slider_button',true) != '' || get_theme_mod( 'automobile_car_dealer_display_slider_button',true) != ''){ ?>
                      <?php if( get_theme_mod('automobile_car_dealer_slider_button_text','READ MORE') != ''){ ?>
                        <div class="slide-button">
                          <a class="read-more" href="<?php the_permalink(); ?>"><i class="<?php echo esc_attr(get_theme_mod('automobile_car_dealer_slider_button_icon','fas fa-long-arrow-alt-right')); ?>"></i><?php echo esc_html( get_theme_mod('automobile_car_dealer_slider_button_text',__('READ MORE','automobile-car-dealer'))); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('automobile_car_dealer_slider_button_text',__('READ MORE','automobile-car-dealer'))); ?></span></a>
                        </div> 
                      <?php }?>  
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php $i++; endwhile; 
            wp_reset_postdata();?>
          </div>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('automobile_car_dealer_slider_previous_icon','fas fa-chevron-left')); ?>" ></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','automobile-car-dealer' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="<?php echo esc_attr(get_theme_mod('automobile_car_dealer_slider_next_icon','fas fa-chevron-right')); ?>" ></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','automobile-car-dealer' );?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section> 
  <?php }?>

  <?php do_action( 'automobile_car_dealer_above_project' ); ?>

  <?php if( get_theme_mod('automobile_car_dealer_sec_title') != '' || get_theme_mod( 'automobile_car_dealer_project_single_post' )!= '' ||get_theme_mod('automobile_car_dealer_project_category') != ''){ ?>
    <section id="project">
      <div class="container">
        <?php if( get_theme_mod('automobile_car_dealer_sec_title') != ''){ ?>
          <h2><i class="fas fa-car"></i><?php echo esc_html(get_theme_mod('automobile_car_dealer_sec_title','')); ?></h2>
        <?php }?>
        <div class="row m-0">
          <div class="col-md-7 col-sm-7">
            <?php
            $automobile_car_dealer_postData =  get_theme_mod('automobile_car_dealer_project_single_post');
            if($automobile_car_dealer_postData){
              $args = array( 'name' => esc_html($automobile_car_dealer_postData ,'automobile-car-dealer'));
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="mainbox">
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( automobile_car_dealer_string_limit_words( $excerpt, esc_attr(get_theme_mod('automobile_car_dealer_about_excerpt_number','25')))); ?></p>
                  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a>
                </div>
              <?php endwhile; 
            wp_reset_postdata();?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php
            endif;} ?>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-5 col-sm-5">
            <?php 
              $catData=  get_theme_mod('automobile_car_dealer_project_category');
              if($catData){
                $page_query = new WP_Query(array( 'category_name' => esc_html( $catData ,'automobile-car-dealer')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="categorybox row">
                  <div class="col-md-4 col-sm-4">
                    <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                  </div>
                  <div class="col-md-8 col-sm-8">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( automobile_car_dealer_string_limit_words( $excerpt, esc_attr(get_theme_mod('automobile_car_dealer_category_excerpt_number','15')))); ?></p>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            }?>
          </div>
        </div>
      </div> 
    </section>
  <?php }?>

  <?php do_action( 'automobile_car_dealer_above_content' ); ?>

  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="new-text"><?php the_content(); ?></div>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>