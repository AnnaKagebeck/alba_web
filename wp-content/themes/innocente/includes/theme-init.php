<?php

add_action( 'after_setup_theme', 'ts_setup' );

if ( ! function_exists( 'ts_setup' ) ):

function ts_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'slider-post-thumbnail', 616, 356, true ); // Slider Thumbnail
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
									 'custom-fields',
									 'excerpt',
                                     'thumbnail')
					) 
				);
}

add_action('init', 'ts_post_type_slider');
?>