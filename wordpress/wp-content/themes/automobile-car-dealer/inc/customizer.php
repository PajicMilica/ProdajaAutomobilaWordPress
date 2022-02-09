<?php
/**
 * Automobile Car Dealer Theme Customizer
 * @package Automobile Car Dealer
 */

load_template( trailingslashit( get_template_directory() ) . '/inc/logo-sizer.php' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function automobile_car_dealer_customize_register( $wp_customize ) {	

	load_template( trailingslashit( get_template_directory() ) . 'inc/custom-control.php' );
	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-changer.php' );

	$wp_customize->add_setting( 'automobile_car_dealer_logo_sizer',array(
		'default' => 50,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_logo_sizer',array(
		'label' => esc_html__( 'Logo Sizer','automobile-car-dealer' ),
		'section' => 'title_tagline',
		'priority'    => 9,
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('automobile_car_dealer_site_title_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_site_title_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Site Title','automobile-car-dealer'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting('automobile_car_dealer_site_title_font_size',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control(new automobile_car_dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_site_title_font_size',array(
		'label' => esc_html__( 'Site Title Font Size (px)','automobile-car-dealer' ),
		'section'=> 'title_tagline',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

    $wp_customize->add_setting('automobile_car_dealer_site_tagline_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_site_tagline_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Site Tagline','automobile-car-dealer'),
       'section' => 'title_tagline'
    ));

	//add home page setting pannel
	$wp_customize->add_panel( 'automobile_car_dealer_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'automobile-car-dealer' ),
	    'description' => __( 'Description of what this panel does.', 'automobile-car-dealer' ),
	) );

	$automobile_car_dealer_font_array = array(
		''                       => 'No Fonts',
		'Abril Fatface'          => 'Abril Fatface',
		'Acme'                   => 'Acme',
		'Anton'                  => 'Anton',
		'Architects Daughter'    => 'Architects Daughter',
		'Arimo'                  => 'Arimo',
		'Arsenal'                => 'Arsenal',
		'Arvo'                   => 'Arvo',
		'Alegreya'               => 'Alegreya',
		'Alfa Slab One'          => 'Alfa Slab One',
		'Averia Serif Libre'     => 'Averia Serif Libre',
		'Bangers'                => 'Bangers',
		'Boogaloo'               => 'Boogaloo',
		'Bad Script'             => 'Bad Script',
		'Bitter'                 => 'Bitter',
		'Bree Serif'             => 'Bree Serif',
		'BenchNine'              => 'BenchNine',
		'Cabin'                  => 'Cabin',
		'Cardo'                  => 'Cardo',
		'Courgette'              => 'Courgette',
		'Cherry Swash'           => 'Cherry Swash',
		'Cormorant Garamond'     => 'Cormorant Garamond',
		'Crimson Text'           => 'Crimson Text',
		'Cuprum'                 => 'Cuprum',
		'Cookie'                 => 'Cookie',
		'Chewy'                  => 'Chewy',
		'Days One'               => 'Days One',
		'Dosis'                  => 'Dosis',
		'Droid Sans'             => 'Droid Sans',
		'Economica'              => 'Economica',
		'Fredoka One'            => 'Fredoka One',
		'Fjalla One'             => 'Fjalla One', 
		'Francois One'           => 'Francois One',
		'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
		'Gloria Hallelujah'      => 'Gloria Hallelujah',
		'Great Vibes'            => 'Great Vibes',
		'Handlee'                => 'Handlee',
		'Hammersmith One'        => 'Hammersmith One',
		'Inconsolata'            => 'Inconsolata',
		'Indie Flower'           => 'Indie Flower', 
		'IM Fell English SC'     => 'IM Fell English SC',
		'Julius Sans One'        => 'Julius Sans One',
		'Josefin Slab'           => 'Josefin Slab',
		'Josefin Sans'           => 'Josefin Sans',
		'Kanit'                  => 'Kanit', 
		'Lobster'                => 'Lobster',
		'Lato'                   => 'Lato',
		'Lora'                   => 'Lora',
		'Libre Baskerville'      => 'Libre Baskerville',
		'Lobster Two'            => 'Lobster Two', 
		'Merriweather'           => 'Merriweather',
		'Monda'                  => 'Monda', 
		'Montserrat'             => 'Montserrat',
		'Muli'                   => 'Muli', 
		'Marck Script'           => 'Marck Script', 
		'Noto Serif'             => 'Noto Serif', 
		'Open Sans'              => 'Open Sans', 
		'Overpass'               => 'Overpass',
		'Overpass Mono'          => 'Overpass Mono',
		'Oxygen'                 => 'Oxygen', 
		'Orbitron'               => 'Orbitron',
		'Patua One'              => 'Patua One',
		'Pacifico'               => 'Pacifico',
		'Padauk'                 => 'Padauk',
		'Playball'               => 'Playball',
		'Playfair Display'       => 'Playfair Display', 
		'PT Sans'                => 'PT Sans',
		'Philosopher'            => 'Philosopher',
		'Permanent Marker'       => 'Permanent Marker',
		'Poiret One'             => 'Poiret One',
		'Quicksand'              => 'Quicksand',
		'Quattrocento Sans'      => 'Quattrocento Sans',
		'Raleway'                => 'Raleway',
		'Rubik'                  => 'Rubik', 
		'Rokkitt'                => 'Rokkitt',
		'Russo One'              => 'Russo One',
		'Righteous'              => 'Righteous',
		'Slabo'                  => 'Slabo', 
		'Source Sans Pro'        => 'Source Sans Pro',
		'Shadows Into Light Two' => 'Shadows Into Light Two', 
		'Shadows Into Light'     => 'Shadows Into Light',
		'Sacramento'             => 'Sacramento',
		'Shrikhand'              => 'Shrikhand',
		'Tangerine'              => 'Tangerine',
		'Ubuntu'                 => 'Ubuntu',
		'VT323'                  => 'VT323',
		'Varela Round'           => 'Varela Round',
		'Vampiro One'            => 'Vampiro One',
		'Vollkorn'               => 'Vollkorn', 
		'Volkhov'                => 'Volkhov',
		'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
	);

	//Typography
	$wp_customize->add_section('automobile_car_dealer_typography', array(
		'title'    => __('Typography', 'automobile-car-dealer'),
		'panel'    => 'automobile_car_dealer_panel_id',
	));

	// This is Paragraph Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_paragraph_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_paragraph_color', array(
		'label'    => __('Paragraph Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_paragraph_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_paragraph_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('Paragraph Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	$wp_customize->add_setting('automobile_car_dealer_paragraph_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_paragraph_font_size', array(
		'label'   => __('Paragraph Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_paragraph_font_size',
		'type'    => 'text',
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_atag_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_atag_color', array(
		'label'    => __('"a" Tag Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_atag_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_atag_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('"a" Tag Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_li_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_li_color', array(
		'label'    => __('"li" Tag Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_li_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_li_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('"li" Tag Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_h1_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_h1_color', array(
		'label'    => __('H1 Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_h1_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_h1_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('H1 Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('automobile_car_dealer_h1_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_h1_font_size', array(
		'label'   => __('H1 Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_h1_font_size',
		'type'    => 'text',
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_h2_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_h2_color', array(
		'label'    => __('h2 Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_h2_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control( 'automobile_car_dealer_h2_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('h2 Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('automobile_car_dealer_h2_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_h2_font_size', array(
		'label'   => __('h2 Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_h2_font_size',
		'type'    => 'text',
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_h3_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_h3_color', array(
		'label'    => __('h3 Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_h3_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control( 'automobile_car_dealer_h3_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('h3 Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('automobile_car_dealer_h3_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_h3_font_size', array(
		'label'   => __('h3 Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_h3_font_size',
		'type'    => 'text',
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_h4_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_h4_color', array(
		'label'    => __('h4 Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_h4_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control( 'automobile_car_dealer_h4_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('h4 Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('automobile_car_dealer_h4_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_h4_font_size', array(
		'label'   => __('h4 Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_h4_font_size',
		'type'    => 'text',
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_h5_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_h5_color', array(
		'label'    => __('h5 Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_h5_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control( 'automobile_car_dealer_h5_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('h5 Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('automobile_car_dealer_h5_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_h5_font_size', array(
		'label'   => __('h5 Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_h5_font_size',
		'type'    => 'text',
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting('automobile_car_dealer_h6_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_h6_color', array(
		'label'    => __('h6 Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_typography',
		'settings' => 'automobile_car_dealer_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('automobile_car_dealer_h6_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_h6_font_family', array(
		'section' => 'automobile_car_dealer_typography',
		'label'   => __('h6 Fonts', 'automobile-car-dealer'),
		'type'    => 'select',
		'choices' => $automobile_car_dealer_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('automobile_car_dealer_h6_font_size', array(
			'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('automobile_car_dealer_h6_font_size', array(
		'label'   => __('h6 Font Size', 'automobile-car-dealer'),
		'section' => 'automobile_car_dealer_typography',
		'setting' => 'automobile_car_dealer_h6_font_size',
		'type'    => 'text',
	));

	//layout setting
	$wp_customize->add_section( 'automobile_car_dealer_option', array(
    	'title'      => __( 'Layout Settings', 'automobile-car-dealer' ),
		'priority'   => null,
		'panel' => 'automobile_car_dealer_panel_id'
	) );

	$wp_customize->add_setting('automobile_car_dealer_preloader',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_preloader',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Preloader','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_option'
    ));

    $wp_customize->add_setting('automobile_car_dealer_preloader_type',array(
        'default' => 'First Preloader Type',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control('automobile_car_dealer_preloader_type',array(
        'type' => 'radio',
        'label' => __('Preloader Types','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_option',
        'choices' => array(
            'First Preloader Type' => __('First Preloader Type','automobile-car-dealer'),
            'Second Preloader Type' => __('Second Preloader Type','automobile-car-dealer'),
        ),
	) );

	$wp_customize->add_setting('automobile_car_dealer_preloader_bg_color_option', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_preloader_bg_color_option', array(
		'label'    => __('Preloader Background Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_option',
	)));

	$wp_customize->add_setting('automobile_car_dealer_preloader_icon_color_option', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_preloader_icon_color_option', array(
		'label'    => __('Preloader Icon Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_option',
	)));

	$wp_customize->add_setting('automobile_car_dealer_width_layout_options',array(
        'default' => 'Default',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control('automobile_car_dealer_width_layout_options',array(
        'type' => 'radio',
        'label' => __('Container Box','automobile-car-dealer'),
        'description' => __('Here you can change the Width layout. ','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_option',
        'choices' => array(
            'Default' => __('Default','automobile-car-dealer'),
            'Container Layout' => __('Container Layout','automobile-car-dealer'),
            'Box Layout' => __('Box Layout','automobile-car-dealer'),
        ),
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('automobile_car_dealer_layout_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'	        
	) );
	$wp_customize->add_control('automobile_car_dealer_layout_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_option',
        'choices' => array(
            'One Column' => __('One Column','automobile-car-dealer'),
            'Three Columns' => __('Three Columns','automobile-car-dealer'),
            'Four Columns' => __('Four Columns','automobile-car-dealer'),
            'Grid Layout' => __('Grid Layout','automobile-car-dealer'),
            'Left Sidebar' => __('Left Sidebar','automobile-car-dealer'),
            'Right Sidebar' => __('Right Sidebar','automobile-car-dealer')
        ),
	)  );

	//Global Color
	$wp_customize->add_section('automobile_car_dealer_global_color', array(
		'title'    => __('Theme Color Option', 'automobile-car-dealer'),
		'panel'    => 'automobile_car_dealer_panel_id',
	));

	$wp_customize->add_setting('automobile_car_dealer_first_color', array(
		'default'           => '#dd3333',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_first_color', array(
		'label'    => __('Highlight Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_global_color',
		'settings' => 'automobile_car_dealer_first_color',
	)));

	//Blog Post Settings
	$wp_customize->add_section('automobile_car_dealer_post_settings', array(
		'title'    => __('Post General Settings', 'automobile-car-dealer'),
		'panel'    => 'automobile_car_dealer_panel_id',
	));

	$wp_customize->add_setting('automobile_car_dealer_post_layouts',array(
        'default' => 'Layout 1',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control(new Automobile_Car_Dealer_Image_Radio_Control($wp_customize, 'automobile_car_dealer_post_layouts', array(
        'type' => 'select',
        'label' => __('Post Layouts','automobile-car-dealer'),
        'description' => __('Here you can change the 3 different layouts of post.','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_post_settings',
        'choices' => array(
            'Layout 1' => get_template_directory_uri().'/images/layout1.png',
            'Layout 2' => get_template_directory_uri().'/images/layout2.png',
            'Layout 3' => get_template_directory_uri().'/images/layout3.png',
    ))));

	$wp_customize->add_setting( 'automobile_car_dealer_post_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'automobile_car_dealer_post_excerpt_number', array(
		'label'       => esc_html__( 'Blog Post Content Limit','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_post_settings',
		'type'        => 'number',
		'settings'    => 'automobile_car_dealer_post_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'automobile_car_dealer_post_discription_suffix', array(
		'default'   => __('[...]', 'automobile-car-dealer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'automobile_car_dealer_post_discription_suffix', array(
		'label'       => esc_html__( 'Post Excerpt Suffix','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_post_settings',
		'type'        => 'text',
		'settings'    => 'automobile_car_dealer_post_discription_suffix',
	) );

	$wp_customize->add_setting('automobile_car_dealer_button_text',array(
		'default'=> __('View More', 'automobile-car-dealer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_button_text',array(
		'label'	=> __('Add Button Text','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_button_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_button_icon',array(
		'label'	=> __('Post Button Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_post_settings',
		'type'		=> 'icon'
	)));

	//Single Post Settings
	$wp_customize->add_section('automobile_car_dealer_single_post_settings', array(
		'title'    => __('Single Post Settings', 'automobile-car-dealer'),
		'panel'    => 'automobile_car_dealer_panel_id',
	));

	$wp_customize->add_setting('automobile_car_dealer_metafields_date',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_metafields_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Date ','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

    $wp_customize->add_setting('automobile_car_dealer_post_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_post_date_icon',array(
		'label'	=> __('Post Date Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_single_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('automobile_car_dealer_metafields_author',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Author','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

    $wp_customize->add_setting('automobile_car_dealer_post_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_post_author_icon',array(
		'label'	=> __('Post Author Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_single_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('automobile_car_dealer_metafields_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Comments','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

    $wp_customize->add_setting('automobile_car_dealer_post_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_post_comment_icon',array(
		'label'	=> __('Post Comment Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_single_post_settings',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('automobile_car_dealer_single_post_featured_image',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_single_post_featured_image',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Featured image','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings',
    ));

	$wp_customize->add_setting('automobile_car_dealer_single_post_tags',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_single_post_tags',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Tags','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

    $wp_customize->add_setting( 'automobile_car_dealer_single_post_meta_seperator', array(
		'default'   => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'automobile_car_dealer_single_post_meta_seperator', array(
		'label'       => esc_html__( 'Single Post Meta Box Seperator','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_single_post_settings',
		'description' => __('Here you can add the seperator for meta box. e.g. "|",  ",", "/", etc. ','automobile-car-dealer'),
		'type'        => 'text',
		'settings'    => 'automobile_car_dealer_single_post_meta_seperator',
	) );

	$wp_customize->add_setting( 'automobile_car_dealer_comment_form_width',array(
		'default' => '100',
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new automobile_car_dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_comment_form_width',	array(
		'label' => esc_html__( 'Comment Form Width','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_single_post_settings',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting('automobile_car_dealer_title_comment_form',array(
       'default' => __('Leave a Reply', 'automobile-car-dealer'), 
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('automobile_car_dealer_title_comment_form',array(
       'type' => 'text',
       'label' => __('Comment Form Heading Text','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

    $wp_customize->add_setting('automobile_car_dealer_comment_form_button_content',array(
       'default' => __('Post Comment', 'automobile-car-dealer'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('automobile_car_dealer_comment_form_button_content',array(
       'type' => 'text',
       'label' => __('Comment Form Button Text','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

	$wp_customize->add_setting('automobile_car_dealer_enable_single_post_pagination',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_enable_single_post_pagination',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Pagination','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_single_post_settings'
    ));

	//Social Icons(topbar)
	$wp_customize->add_section('automobile_car_dealer_topbar_header',array(
		'title'	=> __('Social Icon Section','automobile-car-dealer'),
		'description'	=> __('Add Social Link here','automobile-car-dealer'),
		'priority'	=> null,
		'panel' => 'automobile_car_dealer_panel_id',
	));

	$wp_customize->add_setting('automobile_car_dealer_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_facebook_icon',array(
		'label'	=> __('Facebook Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_cont_facebook',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('automobile_car_dealer_cont_facebook',array(
		'label'	=> __('Add Facebook link','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_topbar_header',
		'setting'	=> 'automobile_car_dealer_cont_facebook',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('automobile_car_dealer_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_twitter_icon',array(
		'label'	=> __('Twitter Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_cont_twitter',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('automobile_car_dealer_cont_twitter',array(
		'label'	=> __('Add Twitter link','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_topbar_header',
		'setting'	=> 'automobile_car_dealer_cont_twitter',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('automobile_car_dealer_pinterest_icon',array(
		'default'	=> 'fab fa-pinterest',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_pinterest_icon',array(
		'label'	=> __('Pinterest Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_pinterest',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('automobile_car_dealer_pinterest',array(
		'label'	=> __('Add Pinterest link','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_topbar_header',
		'setting'	=> 'automobile_car_dealer_pinterest',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('automobile_car_dealer_tumblr_icon',array(
		'default'	=> 'fab fa-tumblr',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_tumblr_icon',array(
		'label'	=> __('Tumblr Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_tumblr',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('automobile_car_dealer_tumblr',array(
		'label'	=> __('Add Tumblr link','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_topbar_header',
		'setting'	=> 'automobile_car_dealer_tumblr',
		'type'		=> 'url'
	));

	//Top Bar(topbar)
	$wp_customize->add_section('automobile_car_dealer_contact',array(
		'title'	=> __('Contact Us','automobile-car-dealer'),
		'description'	=> __('Add contact us here','automobile-car-dealer'),
		'priority'	=> null,
		'panel' => 'automobile_car_dealer_panel_id',
	));

	$wp_customize->add_setting( 'automobile_car_dealer_sticky_header',array(
		'default'	=> false,
      	'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ) );
    $wp_customize->add_control('automobile_car_dealer_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Enable / Disable Sticky Header','automobile-car-dealer' ),
        'section' => 'automobile_car_dealer_contact'
    ));

    $wp_customize->add_setting('automobile_car_dealer_menu_font_size_option',array(
		'default'=> 12,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new automobile_car_dealer_Custom_Control( $wp_customize,'automobile_car_dealer_menu_font_size_option',array(
		'label'	=> __('Menu Font Size ','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_contact',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

    $wp_customize->add_setting('automobile_car_dealer_email_icon',array(
		'default'	=> 'fas fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_email_icon',array(
		'label'	=> __('Email Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_mail',array(
		'default'	=> '',
		'sanitize_callback'	=> 'automobile_car_dealer_sanitize_email'
	));
	$wp_customize->add_control('automobile_car_dealer_mail',array(
		'label'	=> __('Email','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_phone_icon',array(
		'default'	=> 'fa fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_phone_icon',array(
		'label'	=> __('Phone Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_phone',array(
		'default'	=> '',
		'sanitize_callback'	=> 'automobile_car_dealer_sanitize_phone_number'
	));	
	$wp_customize->add_control('automobile_car_dealer_phone',array(
		'label'	=> __('Phone No','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_search_icon',array(
		'default'	=> 'fa fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_search_icon',array(
		'label'	=> __('Search Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_button_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('automobile_car_dealer_button_link',array(
		'label'	=> __('Appointment us url','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_contact',
		'setting'	=> 'automobile_car_dealer_button_link',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('automobile_car_dealer_appointment_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_appointment_icon',array(
		'label'	=> __('Appointment Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_responsive_menu_open_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_responsive_menu_open_icon',array(
		'label'	=> __('Responsive Open Menu Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_responsive_menu_close_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_responsive_menu_close_icon',array(
		'label'	=> __('Responsive Close Menu Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_contact',
		'type'		=> 'icon'
	)));

	//home page slider
	$wp_customize->add_section( 'automobile_car_dealer_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'automobile-car-dealer' ),
		'priority'   => null,
		'panel' => 'automobile_car_dealer_panel_id'
	) );

	$wp_customize->add_setting('automobile_car_dealer_slider_hide',array(
       'default' => false,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_slider_hide',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_slidersettings',
    ));

    $wp_customize->add_setting('automobile_car_dealer_show_slider_button',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_show_slider_button',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Slider Button','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_slidersettings'
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'automobile_car_dealer_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'automobile_car_dealer_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'automobile_car_dealer_slider' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'automobile-car-dealer' ),
			'section'  => 'automobile_car_dealer_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('automobile_car_dealer_slider_previous_icon',array(
		'default'	=> 'fas fa-chevron-left',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_slider_previous_icon',array(
		'label'	=> __('Slider Previous Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_slidersettings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_slider_next_icon',array(
		'default'	=> 'fas fa-chevron-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_slider_next_icon',array(
		'label'	=> __('Slider Next Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_slidersettings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_slider_button_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_slider_button_icon',array(
		'label'	=> __('Slider Button Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_slidersettings',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_slider_button_text',array(
		'default'	=> __('READ MORE', 'automobile-car-dealer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_slider_button_text',array(
		'label'	=> __('Slider Button Text','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_slidersettings',
		'type'		=> 'text'
	));

	//content layout
    $wp_customize->add_setting('automobile_car_dealer_slider_content_layout',array(
    'default' => 'Center',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control('automobile_car_dealer_slider_content_layout',array(
        'type' => 'radio',
        'label' => __('Slider Content Layout','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_slidersettings',
        'choices' => array(
            'Center' => __('Center','automobile-car-dealer'),
            'Left' => __('Left','automobile-car-dealer'),
            'Right' => __('Right','automobile-car-dealer'),
        ),
	) );

	$wp_customize->add_setting('automobile_car_dealer_option_slider_height',array(
		'default'=> '550',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_option_slider_height',array(
		'label'	=> __('Slider Height','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_slidersettings',
		'type'=> 'text'
	));

	//Slider excerpt
	$wp_customize->add_setting( 'automobile_car_dealer_slider_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'automobile_car_dealer_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Content Limit','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_slidersettings',
		'type'        => 'number',
		'settings'    => 'automobile_car_dealer_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('automobile_car_dealer_slider_opacity',array(
      'default'              => 0.7,
      'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control( 'automobile_car_dealer_slider_opacity', array(
		'label'       => esc_html__( 'Slider Image Opacity','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_slidersettings',
		'type'        => 'select',
		'settings'    => 'automobile_car_dealer_slider_opacity',
		'choices' => array(
			'0' =>  esc_attr('0','automobile-car-dealer'),
			'0.1' =>  esc_attr('0.1','automobile-car-dealer'),
			'0.2' =>  esc_attr('0.2','automobile-car-dealer'),
			'0.3' =>  esc_attr('0.3','automobile-car-dealer'),
			'0.4' =>  esc_attr('0.4','automobile-car-dealer'),
			'0.5' =>  esc_attr('0.5','automobile-car-dealer'),
			'0.6' =>  esc_attr('0.6','automobile-car-dealer'),
			'0.7' =>  esc_attr('0.7','automobile-car-dealer'),
			'0.8' =>  esc_attr('0.8','automobile-car-dealer'),
			'0.9' =>  esc_attr('0.9','automobile-car-dealer')
		),
	));

	//About
	$wp_customize->add_section('automobile_car_dealer_project',array(
		'title'	=> __('Our Project Section','automobile-car-dealer'),
		'description'	=> __('Add Our Project sections below.','automobile-car-dealer'),
		'panel' => 'automobile_car_dealer_panel_id',
	));

	$wp_customize->add_setting('automobile_car_dealer_sec_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_sec_title',array(
		'label'	=> __('Title','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_project',
		'type'		=> 'text'
	));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$posts[]='Select';  
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('automobile_car_dealer_project_single_post',array(
		'default' =>'select post',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_project_single_post',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','automobile-car-dealer'),
		'section' => 'automobile_car_dealer_project',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('automobile_car_dealer_project_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	));
	$wp_customize->add_control('automobile_car_dealer_project_category',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Latest Post','automobile-car-dealer'),
		'section' => 'automobile_car_dealer_project',
	));

	//About excerpt
	$wp_customize->add_setting( 'automobile_car_dealer_about_excerpt_number', array(
		'default'              => 25,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'automobile_car_dealer_about_excerpt_number', array(
		'label'       => esc_html__( 'Project Content Limit','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_project',
		'type'        => 'number',
		'settings'    => 'automobile_car_dealer_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Category excerpt
	$wp_customize->add_setting( 'automobile_car_dealer_category_excerpt_number', array(
		'default'              => 15,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'automobile_car_dealer_category_excerpt_number', array(
		'label'       => esc_html__( 'Category Content Limit','automobile-car-dealer' ),
		'section'     => 'automobile_car_dealer_project',
		'type'        => 'number',
		'settings'    => 'automobile_car_dealer_category_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );
	
	//footer text
	$wp_customize->add_section('automobile_car_dealer_footer_section',array(
		'title'	=> __('Footer Text','automobile-car-dealer'),
		'panel' => 'automobile_car_dealer_panel_id'
	));

	$wp_customize->add_setting('automobile_car_dealer_footer_bg_color', array(
		'default'           => '#121212',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'automobile_car_dealer_footer_bg_color', array(
		'label'    => __('Footer Background Color', 'automobile-car-dealer'),
		'section'  => 'automobile_car_dealer_footer_section',
	)));

	$wp_customize->add_setting('automobile_car_dealer_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'automobile_car_dealer_footer_bg_image',array(
        'label' => __('Footer Background Image','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_footer_section'
	)));

	$wp_customize->add_setting('footer_widget_areas',array(
        'default'           => 4,
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
    ));
    $wp_customize->add_control('footer_widget_areas',array(
        'type'        => 'radio',
        'label'       => __('Footer widget area', 'automobile-car-dealer'),
        'section'     => 'automobile_car_dealer_footer_section',
        'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'automobile-car-dealer'),
        'choices' => array(
            '1'     => __('One', 'automobile-car-dealer'),
            '2'     => __('Two', 'automobile-car-dealer'),
            '3'     => __('Three', 'automobile-car-dealer'),
            '4'     => __('Four', 'automobile-car-dealer')
        ),
    ));

    $wp_customize->add_setting('automobile_car_dealer_hide_show_scroll',array(
        'default' => true,
        'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
	));
	$wp_customize->add_control('automobile_car_dealer_hide_show_scroll',array(
     	'type' => 'checkbox',
      	'label' => __('Enable / Disable Back To Top','automobile-car-dealer'),
      	'section' => 'automobile_car_dealer_footer_section',
	));

	$wp_customize->add_setting('automobile_car_dealer_back_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Automobile_Car_Dealer_Icon_Changer(
        $wp_customize,'automobile_car_dealer_back_to_top_icon',array(
		'label'	=> __('Back to Top Icon','automobile-car-dealer'),
		'transport' => 'refresh',
		'section'	=> 'automobile_car_dealer_footer_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('automobile_car_dealer_scroll_icon_font_size',array(
		'default'=> 22,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control(new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_scroll_icon_font_size',array(
		'label'	=> __('Back To Top Icon Font Size','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_footer_section',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));

	$wp_customize->add_setting('automobile_car_dealer_footer_options',array(
        'default' => 'Right align',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control('automobile_car_dealer_footer_options',array(
        'type' => 'radio',
        'label' => __('Back To Top','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_footer_section',
        'choices' => array(
            'Left align' => __('Left align','automobile-car-dealer'),
            'Right align' => __('Right align','automobile-car-dealer'),
            'Center align' => __('Center align','automobile-car-dealer'),
        ),
	) );

	$wp_customize->add_setting( 'automobile_car_dealer_top_bottom_scroll_padding',array(
		'default' => 12,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_top_bottom_scroll_padding',	array(
		'label' => esc_html__( 'Top Bottom Scroll Padding (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_left_right_scroll_padding',array(
		'default' => 17,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_left_right_scroll_padding',	array(
		'label' => esc_html__( 'Left Right Scroll Padding (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_back_to_top_border_radius',array(
		'default' => 50,
		'transport' => 'postMessage',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_back_to_top_border_radius', array(
		'label' => esc_html__( 'Back to Top Border Radius (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_footer_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));
	
	$wp_customize->add_setting('automobile_car_dealer_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('automobile_car_dealer_footer_copy',array(
		'label'	=> __('Copyright Text','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_footer_section',
		'description'	=> __('Add some text for footer like copyright etc.','automobile-car-dealer'),
		'type'		=> 'text'
	));

	//Responsive Media Settings
	$wp_customize->add_section('automobile_car_dealer_responsive_media',array(
		'title'	=> __('Responsive Media','automobile-car-dealer'),
		'panel' => 'automobile_car_dealer_panel_id',
	));

    $wp_customize->add_setting('automobile_car_dealer_display_slider',array(
       'default' => false,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_display_slider',array(
       'type' => 'checkbox',
       'label' => __('Display Slider','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_responsive_media'
    ));

    $wp_customize->add_setting('automobile_car_dealer_display_slider_button',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_display_slider_button',array(
       'type' => 'checkbox',
       'label' => __('Display Slider Button','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_responsive_media'
    ));

	$wp_customize->add_setting('automobile_car_dealer_display_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_display_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Display Sidebar','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_responsive_media'
    ));

    $wp_customize->add_setting('automobile_car_dealer_display_scrolltop',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_display_scrolltop',array(
       'type' => 'checkbox',
       'label' => __('Display Back To Top','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_responsive_media'
    ));

    $wp_customize->add_setting('automobile_car_dealer_display_fixed_header',array(
       'default' => false,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_display_fixed_header',array(
       'type' => 'checkbox',
       'label' => __('Display Sticky Header','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_responsive_media'
    ));

    $wp_customize->add_setting('automobile_car_dealer_display_preloader',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_display_preloader',array(
       'type' => 'checkbox',
       'label' => __('Display Preloader','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_responsive_media'
    ));

	//404 Page Setting
	$wp_customize->add_section('automobile_car_dealer_page_not_found',array(
		'title'	=> __('404 Page Not Found / No Result','automobile-car-dealer'),
		'panel' => 'automobile_car_dealer_panel_id',
	));	

	$wp_customize->add_setting('automobile_car_dealer_page_not_found_heading',array(
		'default'=> __('404 Not Found', 'automobile-car-dealer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_page_not_found_heading',array(
		'label'	=> __('404 Heading','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_page_not_found_text',array(
		'default'=> __('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.', 'automobile-car-dealer'), 
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_page_not_found_text',array(
		'label'	=> __('404 Content','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_page_not_found_button',array(
		'default'=> __('Back to Home Page','automobile-car-dealer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_page_not_found_button',array(
		'label'	=> __('404 Button','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_no_search_result_heading',array(
		'default'=> __('Nothing Found', 'automobile-car-dealer'), 
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_no_search_result_heading',array(
		'label'	=> __('No Search Results Heading','automobile-car-dealer'),
		'description'=>__('The search page heading display when no results are found.','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_page_not_found',
		'type'=> 'text'
	));

	$wp_customize->add_setting('automobile_car_dealer_no_search_result_text',array(
		'default'=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'automobile-car-dealer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('automobile_car_dealer_no_search_result_text',array(
		'label'	=> __('No Search Results Text','automobile-car-dealer'),
		'description'=>__('The search page text display when no results are found.','automobile-car-dealer'),
		'section'=> 'automobile_car_dealer_page_not_found',
		'type'=> 'text'
	));

	//Woocommerce Section
	$wp_customize->add_section( 'automobile_car_dealer_woocommerce_section' , array(
    	'title'      => __( 'Woocommerce Settings', 'automobile-car-dealer' ),
    	'description'=>__('The below settings are apply on woocommerce pages.','automobile-car-dealer'),
		'priority'   => null,
		'panel' => 'automobile_car_dealer_panel_id'
	) );

	$wp_customize->add_setting( 'automobile_car_dealer_per_columns' , array(
		'default'           => 3,
		'transport'         => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_choices',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'automobile_car_dealer_per_columns', array(
		'label'    => __( 'Product per columns', 'automobile-car-dealer' ),
		'section'  => 'automobile_car_dealer_woocommerce_section',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
	) ) );

	$wp_customize->add_setting('automobile_car_dealer_product_per_page',array(
		'default'	=> 9,
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('automobile_car_dealer_product_per_page',array(
		'label'	=> __('Product per page','automobile-car-dealer'),
		'section'	=> 'automobile_car_dealer_woocommerce_section',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('automobile_car_dealer_shop_sidebar_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_shop_sidebar_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable shop page sidebar','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_woocommerce_section',
    ));

    $wp_customize->add_setting('automobile_car_dealer_product_page_sidebar_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_product_page_sidebar_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product page sidebar','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_woocommerce_section',
    ));

    $wp_customize->add_setting('automobile_car_dealer_related_product_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_related_product_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related product','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_woocommerce_section',
    ));

    $wp_customize->add_setting( 'automobile_car_dealer_woo_product_sale_border_radius',array(
		'default' => 100,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control(new automobile_car_dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woo_product_sale_border_radius', array(
        'label'  => __('Woocommerce Product Sale Border Radius','automobile-car-dealer'),
        'section'  => 'automobile_car_dealer_woocommerce_section',
        'type'        => 'number',
        'input_attrs' => array(
        	'step'=> 1,
            'min' => 0,
            'max' => 50,
        )
    )));

    $wp_customize->add_setting('automobile_car_dealer_woo_product_sale_top_bottom_padding',array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new automobile_car_dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woo_product_sale_top_bottom_padding',array(
		'label'	=> __('Woocommerce Product Sale Top Bottom Padding ','automobile-car-dealer'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'automobile_car_dealer_woocommerce_section',
		'type'=> 'number'
	)));

	$wp_customize->add_setting('automobile_car_dealer_woo_product_sale_left_right_padding',array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new automobile_car_dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woo_product_sale_left_right_padding',array(
		'label'	=> __('Woocommerce Product Sale Left Right Padding','automobile-car-dealer'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'automobile_car_dealer_woocommerce_section',
		'type'=> 'number'
	)));

	$wp_customize->add_setting('automobile_car_dealer_woo_product_sale_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'automobile_car_dealer_sanitize_choices'
	));
	$wp_customize->add_control('automobile_car_dealer_woo_product_sale_position',array(
        'type' => 'select',
        'label' => __('Woocommerce Product Sale Position','automobile-car-dealer'),
        'section' => 'automobile_car_dealer_woocommerce_section',
        'choices' => array(
            'Right' => __('Right','automobile-car-dealer'),
            'Left' => __('Left','automobile-car-dealer'),
        ),
	));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_button_padding_top',array(
		'default' => 12,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_button_padding_right',array(
		'default' => 12,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_button_padding_right',	array(
		'label' => esc_html__( 'Button Right Left Padding (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_button_border_radius',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

    $wp_customize->add_setting('automobile_car_dealer_woocommerce_product_border_enable',array(
       'default' => true,
       'sanitize_callback'	=> 'automobile_car_dealer_sanitize_checkbox'
    ));
    $wp_customize->add_control('automobile_car_dealer_woocommerce_product_border_enable',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product border','automobile-car-dealer'),
       'section' => 'automobile_car_dealer_woocommerce_section',
    ));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_product_padding_top',array(
		'default' => 10,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_product_padding_top',	array(
		'label' => esc_html__( 'Product Top Bottom Padding (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_product_padding_right',array(
		'default' => 10,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_product_padding_right',	array(
		'label' => esc_html__( 'Product Right Left Padding (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_product_border_radius',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_product_border_radius',array(
		'label' => esc_html__( 'Product Border Radius (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));

	$wp_customize->add_setting( 'automobile_car_dealer_woocommerce_product_box_shadow',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'automobile_car_dealer_sanitize_integer'
	));
	$wp_customize->add_control( new Automobile_Car_Dealer_Custom_Control( $wp_customize, 'automobile_car_dealer_woocommerce_product_box_shadow',array(
		'label' => esc_html__( 'Product Box Shadow (px)','automobile-car-dealer' ),
		'section' => 'automobile_car_dealer_woocommerce_section',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	)));
	
}

add_action( 'customize_register', 'automobile_car_dealer_customize_register' );	

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Automobile_Car_Dealer_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Automobile_Car_Dealer_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Automobile_Car_Dealer_Customize_Section_Pro(
				$manager,
				'automobile_car_dealer_example_1',
				array(
					'title'   =>  esc_html__( 'Automobile Pro', 'automobile-car-dealer' ),
					'pro_text' => esc_html__( 'Go Pro', 'automobile-car-dealer' ),
					'pro_url'  => esc_url('https://www.buywptemplates.com/themes/premium-automotive-wordpress-theme'),
					'priority'   => 9
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'automobile-car-dealer-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'automobile-car-dealer-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}

	//Footer widget areas
	function automobile_car_dealer_sanitize_choices( $input ) {
	    $valid = array(
	        '1'     => __('One', 'automobile-car-dealer'),
	        '2'     => __('Two', 'automobile-car-dealer'),
	        '3'     => __('Three', 'automobile-car-dealer'),
	        '4'     => __('Four', 'automobile-car-dealer')
	    );
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
}

// Doing this customizer thang!
Automobile_Car_Dealer_Customize::get_instance();