<?php

add_action( 'admin_menu', 'automobile_car_dealer_gettingstarted' );
function automobile_car_dealer_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'automobile-car-dealer'), esc_html__('About Theme', 'automobile-car-dealer'), 'edit_theme_options', 'automobile-car-dealer-guide-page', 'automobile_car_dealer_guide');   
}

function automobile_car_dealer_admin_theme_style() {
   wp_enqueue_style('automobile-car-dealer-custom-admin-style', get_template_directory_uri() . '/inc/dashboard/get_started_info.css');
}
add_action('admin_enqueue_scripts', 'automobile_car_dealer_admin_theme_style');

function automobile_car_dealer_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {?>
    <div class="notice notice-success is-dismissible getting_started">
		<div class="notice-content">
			<h2><?php esc_html_e( 'Thanks for installing Automobile Car Dealer Lite, you rock!', 'automobile-car-dealer' ) ?> </h2>
			<p><?php esc_html_e( 'Take benefit of a variety of features, functionalities, elements, and an exclusive set of customization options to build your own professional automobile website. Please Click on the link below to know the theme setup information.', 'automobile-car-dealer' ) ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=automobile-car-dealer-guide-page' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Getting Started', 'automobile-car-dealer' ); ?></a></p>
		</div>
	</div>
	<?php }
}
add_action('admin_notices', 'automobile_car_dealer_notice');

/**
 * Theme Info Page
 */
function automobile_car_dealer_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'automobile-car-dealer' ); ?>

	<div class="wrap getting-started">
		<div class="getting-started__header">
			<div class="row">
				<div class="col-md-5 intro">
					<div class="pad-box">
						<h2><?php esc_html_e( 'Welcome to Automobile Car Dealer', 'automobile-car-dealer' ); ?></h2>
						<p>Version: <?php echo esc_html($theme['Version']);?></p>
						<span class="intro__version"><?php esc_html_e( 'Congratulations! You are about to use the most easy to use and flexible WordPress theme.', 'automobile-car-dealer' ); ?>	
						</span>
						<div class="powered-by">
							<p><strong><?php esc_html_e( 'Theme created by Buy WP Templates', 'automobile-car-dealer' ); ?></strong></p>
							<p>
								<img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/theme-logo.png'); ?>"/>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="pro-links">
				    	<a href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'automobile-car-dealer'); ?></a>
						<a href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_BUY_PRO ); ?>"><?php esc_html_e('Buy Pro', 'automobile-car-dealer'); ?></a>
						<a href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'automobile-car-dealer'); ?></a>
					</div>
					<div class="install-plugins">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/responsive1.png'); ?>" alt="" />
					</div>
				</div>
			</div>
			<h2 class="tg-docs-section intruction-title" id="section-4"><?php esc_html_e( '1). Setup Automobile Car Dealer Theme', 'automobile-car-dealer' ); ?></h2>
			<div class="row">
				<div class="theme-instruction-block col-md-7">
					<div class="pad-box">
	                    <p><?php esc_html_e( 'Automobile car dealer theme is a responsive WordPress theme that is created by the team of professionals with optimized codes and interactive designs to make it secure and stunning at the same time. This SEO friendly, robust WordPress theme by Buywptemplates is perfect for dealers of new or used cars, motorbikes, and motorcycles. Its Mega Menu allows showcasing the portfolio of products in best possible ways. Simple and adaptable car Dealer WordPress Theme is clean, user-friendly, and responsive. It is professional in both looks and functionalities. It is flexible enough and allows customizing via personalization options. Right from publishing automotive news or blogs on the website or sharing it on different social media platforms; everything becomes easy and hassle-free with Automobile car dealer themes. With clean code, this multi-purpose mobile-friendly WordPress theme is ideal for motorhome and car dealers. From an effective call to action button to amazingly designed landing page, this theme is well-equipped with all the functionalities and functions to streamline the entire automobile business process right from browsing till purchase.', 'automobile-car-dealer' ); ?><p><br>
						<ol>
							<li><?php esc_html_e( 'Start','automobile-car-dealer'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','automobile-car-dealer'); ?></a> <?php esc_html_e( 'your website.','automobile-car-dealer'); ?> </li>
							<li><?php esc_html_e( 'Automobile Car Dealer','automobile-car-dealer'); ?> <a target="_blank" href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation','automobile-car-dealer'); ?></a> </li>
						</ol>
                    </div>
              	</div>
				<div class="col-md-5">
					<div class="pad-box">
              			<img class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/screenshot.png'); ?>"/>
              		 </div> 
              	</div>
            </div>
			<div class="col-md-12 text-block">
					<h2 class="dashboard-install-title"><?php esc_html_e( '2.) Premium Theme Information.','automobile-car-dealer'); ?></h2>
					<div class="row">
						<div class="col-md-7">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/responsive.png'); ?>" alt="">
							<div class="pad-box">
								<h3><?php esc_html_e( 'Pro Theme Description','automobile-car-dealer'); ?></h3>
	                    		<p class="pad-box-p"><?php esc_html_e( 'The premium Automotive WordPress theme is a multipurpose theme for all the automobile businesses. It is designed keeping in mind the wide range of purposes it is going to fulfill. It can be used for the business of car and/or truck lift, resale vehicle, automobile manufacturing unit, automobile showroom etc. It is jam-packed with all the overwhelmingly amazing features that you wish to see on your site. It is important to have a good website design to reflect your good business skills and valuable services. This theme will give the best professional look to your business. Its easy navigation and user-friendly interface will make visitors experience soothing. It is developed and well written by our expert developers to make it bug-free. This ultimately makes it SEO friendly hence ranking it higher in Google search. The unique design of our premium Automotive WordPress theme makes your site stand out among hundreds of other sites. It has all the possible colours in its colour palette to give any colour to your website. These all features in your site will definitely attract more customers towards it.', 'automobile-car-dealer' ); ?><p>
	                    	</div>
						</div>
						<div class="col-md-5 install-plugin-right">
							<div class="pad-box">								
								<h3><?php esc_html_e( 'Pro Theme Features','automobile-car-dealer'); ?></h3>
								<div class="dashboard-install-benefit">
									<ul>
										<li><?php esc_html_e( 'Car listing Shortcode with category','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Car listing Shortcode','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Multiple image feature for each property with slider.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Brand Listing Section','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Car Brand(categories) Option','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Car Tags(categories) Option','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Testimonial listing.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Testimonial shortcode.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Social icons widget.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Latest post with the image widget.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Live customize editor for the About US section.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Font Awesome integrated.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Advanced Color options and color pallets.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( '100+ Font Family Options.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Enable-Disable options on All sections.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Well sanitized as per WordPress standards.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Allow to set site title, tagline, logo.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Sticky post & Comment threads.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Left and Right Sidebar.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Customizable Home Page.','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Footer Widgets & Editor style','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Gallery & Banner functionality','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Multiple inner page templates','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Full-width Template','automobile-car-dealer'); ?></li>
										<li><?php esc_html_e( 'Custom Menu, Colors Editor','automobile-car-dealer'); ?></li>
									</ul>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="dashboard__blocks">
			<div class="row">
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Get Support','automobile-car-dealer'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_FREE_SUPPORT ); ?>"><?php esc_html_e( 'Free Theme Support','automobile-car-dealer'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_PRO_SUPPORT ); ?>"><?php esc_html_e( 'Premium Theme Support','automobile-car-dealer'); ?></a></li>
					</ol>
				</div>

				<div class="col-md-3">
					<h3><?php esc_html_e( 'Getting Started','automobile-car-dealer'); ?></h3>
					<ol>
						<li><?php esc_html_e( 'Start','automobile-car-dealer'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','automobile-car-dealer'); ?></a> <?php esc_html_e( 'your website.','automobile-car-dealer'); ?> </li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Help Docs','automobile-car-dealer'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_FREE_DOC ); ?>"><?php esc_html_e( 'Free Theme Documentation','automobile-car-dealer'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_PRO_DOC ); ?>"><?php esc_html_e( 'Premium Theme Documentation','automobile-car-dealer'); ?></a></li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Buy Premium','automobile-car-dealer'); ?></h3>
					<ol>
						<a href="<?php echo esc_url( AUTOMOBILE_CAR_DEALER_BUY_PRO ); ?>"><?php esc_html_e('Buy Pro', 'automobile-car-dealer'); ?></a>
					</ol>
				</div>
			</div>
		</div>
	</div>

<?php }?>