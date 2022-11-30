<?php
// inherit parent theme styles
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'twenty-twenty-one-style'; // This is 'twenty-twenty-one-style' for the Twenty Twenty-one theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'custom-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}


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
} );