<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Automobile Car Dealer
 */
get_header(); ?>

<main role="main" id="skip_content" class="content_box">
    <div class="container">
        <div class="page-content">
            <h1><?php echo esc_html(get_theme_mod('automobile_car_dealer_page_not_found_heading',__('404 Not Found','automobile-car-dealer')));?></h1>
            <p class="text-404"><?php echo esc_html(get_theme_mod('automobile_car_dealer_page_not_found_text',__('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.','automobile-car-dealer')));?></p>
            <?php if( get_theme_mod('automobile_car_dealer_page_not_found_button','Back to Home Page') != ''){ ?>
                <div class="read-moresec">
                    <a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php echo esc_html(get_theme_mod('automobile_car_dealer_page_not_found_button',__('Back to Home Page','automobile-car-dealer')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('automobile_car_dealer_page_not_found_button',__('Back to Home Page','automobile-car-dealer')));?></span></a>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</main>

<?php get_footer(); ?>