<?php

add_action( 'after_setup_theme', 'ts_setup' );

if ( ! function_exists( 'ts_setup' ) ):

function ts_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'slider-post-thumbnail', 940, 394, true ); // Slider Thumbnail
		add_image_size( 'portfolio-post-thumbnail', 280, 150, true ); // Portfolio Thumbnail
		add_image_size( 'portfolio2-post-thumbnail', 390, 150, true ); // Portfolio2 Thumbnail
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', 'templatesquare' ),
	) );
}
endif;


/* Slider */
function ts_post_type_slider() {
	register_post_type( 'slider',
                array( 
				'label' => __('Slider'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'supports' => array(
				                     'title',
									 'excerpt',
									 'custom-fields',
                                     'thumbnail')
					) 
				);
}

add_action('init', 'ts_post_type_slider');


/* Portfolio */
function ts_post_type_portfolio() {
	register_post_type( 'portfolio',
                array( 
				'label' => __('Portfolio'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'supports' => array(
				                     'title',
									 'editor',
                                     'thumbnail',
                                     'excerpt',
                                     'custom-fields',
                                     'revisions')
					) 
				);
	register_taxonomy('portfoliocat', 'portfolio', array('hierarchical' => true, 'label' => __('Portfolio Categories'), 'singular_name' => 'Category'));
}

add_action('init', 'ts_post_type_portfolio');


/* Testimonial */
function ts_post_type_testimonial() {
	register_post_type( 'testimonial',
                array( 
				'label' => __('Testimonials'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'supports' => array(
				                     'title',
									 'custom-fields',
									 'editor'
                                     )
					) 
				);
}

add_action('init', 'ts_post_type_testimonial');

?>