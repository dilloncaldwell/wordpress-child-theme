<?php

/* ------------------------------------------------------------
Inherit parent theme styles & enques scripts and styles
------------------------------------------------------------ */

function my_parent_theme_enqueue_styles() {
    //load parent theme styles
    $parenthandle = 'twenty-twenty-one-style'; // This is 'twenty-twenty-one-style' for the Twenty Twenty-one theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
	//load child style.css
	wp_enqueue_style('child-style', get_stylesheet_uri(), array( $parenthandle ), $theme->get('Version'));
    //load Bootstrap css
    wp_register_style('bootstrap_css', get_stylesheet_directory_uri().'/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap_css');
    //load Bootstrap js
    wp_register_script('bootstrap_js', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array('jquery'), NULL, true);
    wp_enqueue_script('bootstrap_js');
    //load main custom styles
    wp_register_style( 'main_custom_css', get_stylesheet_directory_uri().'/css/main.css', array(), false, 'all');
    wp_enqueue_style('main_custom_css');
}
add_action( 'wp_enqueue_scripts', 'my_parent_theme_enqueue_styles' );

/* ------------------------------------------------------------------
Remove unused scripts and styles that come with wordpress by default
-------------------------------------------------------------------- */

// Remove emoji support
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
// Remove rss feed links
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
// Remove wp-embed
add_action( 'wp_footer', function(){
    wp_dequeue_script( 'wp-embed' );
});
add_action( 'wp_enqueue_scripts', function(){
    // Remove block library css
    wp_dequeue_style( 'wp-block-library' );
    // Remove comment reply JS
    wp_dequeue_script( 'comment-reply' );
});

/* -------------------------------------------------------
Register Nav Menu Locations
 ------------------------------------------------------- */

register_nav_menus(
	array(
		'footer-menu-1' => 'Footer Menu 1',
		'footer-menu-2' => 'Footer Menu 2',
		'mobile-menu' => 'Mobile Menu',
	)
);


/* -------------------------------------------------------
Register a Custom post type for Bootstrap slider
 ------------------------------------------------------- */

function custom_bootstrap_slider() {
	$labels = array(
		'name'               => _x( 'Slider', 'post type general name'),
		'singular_name'      => _x( 'Slide', 'post type singular name'),
		'menu_name'          => _x( 'Bootstrap Slider', 'admin menu'),
		'name_admin_bar'     => _x( 'Slide', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'Slide'),
		'add_new_item'       => __( 'Name'),
		'new_item'           => __( 'New Slide'),
		'edit_item'          => __( 'Edit Slide'),
		'view_item'          => __( 'View Slide'),
		'all_items'          => __( 'All Slide'),
		'featured_image'     => __( 'Featured Image', 'text_domain' ),
		'search_items'       => __( 'Search Slide'),
		'parent_item_colon'  => __( 'Parent Slide:'),
		'not_found'          => __( 'No Slide found.'),
		'not_found_in_trash' => __( 'No Slide found in Trash.'),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	     => 'dashicons-star-half',
    	'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title','thumbnail')
	);

	register_post_type( 'slider', $args );
}
add_action( 'init', 'custom_bootstrap_slider' );