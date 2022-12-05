<?php

/* ------------------------------------------------------------
Inherit parent theme styles & enques scripts and styles
------------------------------------------------------------ */

function my_parent_theme_enqueue_styles() {
    //load parent theme styles
    $parenthandle = 'twenty-twenty-one-style'; // This is 'twenty-twenty-one-style' for the Twenty Twenty-one theme.
    $theme = wp_get_theme();
    //wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
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
		'main-menu' => 'Main Menu'
	)
);


/* -------------------------------------------------------
Register Custom BS 5 Navigation Walker
 ------------------------------------------------------- */

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
	'dropdown-menu-start',
	'dropdown-menu-end',
	'dropdown-menu-sm-start',
	'dropdown-menu-sm-end',
	'dropdown-menu-md-start',
	'dropdown-menu-md-end',
	'dropdown-menu-lg-start',
	'dropdown-menu-lg-end',
	'dropdown-menu-xl-start',
	'dropdown-menu-xl-end',
	'dropdown-menu-xxl-start',
	'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
	$dropdown_menu_class[] = '';
	foreach($this->current_item->classes as $class) {
	  if(in_array($class, $this->dropdown_menu_alignment_values)) {
		$dropdown_menu_class[] = $class;
	  }
	}
	$indent = str_repeat("\t", $depth);
	$submenu = ($depth > 0) ? ' sub-menu' : '';
	$output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
	$this->current_item = $item;

	$indent = ($depth) ? str_repeat("\t", $depth) : '';

	$li_attributes = '';
	$class_names = $value = '';

	$classes = empty($item->classes) ? array() : (array) $item->classes;

	$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
	$classes[] = 'nav-item';
	$classes[] = 'nav-item-' . $item->ID;
	if ($depth && $args->walker->has_children) {
	  $classes[] = 'dropdown-menu dropdown-menu-end';
	}

	$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
	$class_names = ' class="' . esc_attr($class_names) . '"';

	$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
	$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

	$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

	$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
	$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
	$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
	$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

	$active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
	$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
	$attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

	$item_output = $args->before;
	$item_output .= '<a' . $attributes . '>';
	$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
	$item_output .= '</a>';
	$item_output .= $args->after;

	$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}



/* -------------------------------------------------------
Register a Custom post type for Bootstrap slider
 ------------------------------------------------------- */

function custom_bootstrap_slider() {
	$labels = array(
		'name'               => _x( 'Slider', 'post type general name'),
		'singular_name'      => _x( 'Slide', 'post type singular name'),
		'menu_name'          => _x( 'Homepage Slider', 'admin menu'),
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



