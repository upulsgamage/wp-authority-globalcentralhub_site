<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GeneratePress_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
function generatepress_child_enqueue_scripts() {
	wp_enqueue_style( 'generatepress-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'generatepress-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'generatepress-style' ),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts' );

/**
 * Enqueue Google Fonts
 */
function generatepress_child_enqueue_google_fonts() {
    wp_enqueue_style( 'generatepress-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_google_fonts' );
