<?php
/**
 * Recommended plugins
 *
 * @package StoreCommerce
 */

if ( ! function_exists( 'storecommerce_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function storecommerce_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'WooCommerce', 'storecommerce' ),
                'slug'     => 'woocommerce',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Contact Form 7', 'storecommerce' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'storecommerce' ),
                'slug'     => 'yith-woocommerce-wishlist',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Blockspare - Beautiful Page Building Gutenberg Blocks for WordPress', 'storecommerce' ),
                'slug'     => 'blockspare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Latest Posts Block Lite', 'storecommerce' ),
                'slug'     => 'latest-posts-block-lite',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Magic Content Box Lite', 'storecommerce' ),
                'slug'     => 'magic-content-box-lite',
                'required' => false,
            ),

            array(
                'name'     => esc_html__( 'Woo Total Sales', 'storecommerce' ),
                'slug'     => 'woo-total-sales',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Woo Set Price Note', 'storecommerce' ),
                'slug'     => 'woo-set-price-note',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WP Post Author', 'storecommerce' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'storecommerce' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'storecommerce_recommended_plugins' );
