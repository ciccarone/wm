<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

include 'inc/person.php';
// include 'inc/memorial.php';



function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


// WordPress function to automatically
// add ALT tags to images on upload.

function alt_tag_adder( $post_ID ) {
  if ( wp_attachment_is_image( $post_ID ) ) {
    $tc_title = get_post( $post_ID )->post_title;
    $tc_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $tc_title );
    $tc_title = ucwords( strtolower( $tc_title ) );
    $tc_meta = array(
      'ID'  =>  $post_ID,
    );
    update_post_meta( $post_ID, '_wp_attachment_image_alt', $tc_title );
    wp_update_post( $tc_meta );
  }
}

add_action( 'add_attachment', 'alt_tag_adder' );
