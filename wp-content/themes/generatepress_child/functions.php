<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
function generatepress_child_enqueue_scripts() {
	// Enqueue parent theme stylesheet.
	wp_enqueue_style( 'generatepress-parent-style', get_template_directory_uri() . '/style.css' );

	// Enqueue child theme stylesheet.
	wp_enqueue_style( 'generatepress-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'generatepress-parent-style' ), '1.0.0' );

	// Enqueue Google Fonts.
	wp_enqueue_style( 'generatepress-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts' );

/**
 * Add favicon meta tags to the head.
 */
function generatepress_child_add_favicon_meta_tags() {
	$theme_dir = get_stylesheet_directory_uri();
	?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $theme_dir; ?>/assets/apple-touch-icon.png">
        <link rel="icon" href="<?php echo $theme_dir; ?>/assets/favicon.ico" sizes="any">
        <link rel="icon" href="<?php echo $theme_dir; ?>/assets/favicon.svg" type="image/svg+xml">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $theme_dir; ?>/assets/favicon-96x96.png">
        <link rel="manifest" href="<?php echo $theme_dir; ?>/assets/site.webmanifest">
        <link rel="mask-icon" href="<?php echo $theme_dir; ?>/assets/safari-pinned-tab.svg" color="#1d2d3c">
        <meta name="msapplication-TileColor" content="#1d2d3c">
        <meta name="theme-color" content="#ffffff">
	<?php
}
add_action( 'wp_head', 'generatepress_child_add_favicon_meta_tags' );