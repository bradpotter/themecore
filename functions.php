<?php

/**
 * @package      ThemeCore
 * @author       Brad Potter
 * @link         http://www.bradpotter.com/
 * @copyright    Copyright (c) 2015, Brad Potter
 * @license      GPL-2.0+
 */

// Load child theme textdomain
load_child_theme_textdomain( 'themecore', get_stylesheet_directory() . '/languages' );

add_action( 'genesis_setup', 'themecore_setup', 15 );
/**
 * Setup ThemeCore theme
 *
 * @since 2.2.5
 */
function themecore_setup() {

	// Child theme constants
	define( 'CHILD_THEME_NAME', 'ThemeCore' );
	define( 'CHILD_THEME_URL', 'http://www.themecore.com/' );
	define( 'CHILD_THEME_VERSION', '2.2.5' );

	// Add HTML5 markup structure
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'search-form',
		'gallery',
		'caption',
	) );

	// Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Add theme support for custom background
	add_theme_support( 'custom-background' );

	// Add theme support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'menu-footer',
		'site-inner',
		'footer-widgets',
		'footer',
	) );

	// Add theme support for Genesis Menus
	add_theme_support( 'genesis-menus', array(
		'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
		'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
		'footer'    => __( 'Footer Navigation Menu', 'genesis' ),
	) );

	// Add theme support for footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

	// Add theme support for accessibility
	add_theme_support( 'genesis-accessibility', array(
		'404-page',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	) );

	// Enqueue scripts and styles
	add_action( 'wp_enqueue_scripts', 'themecore_enqueue_scripts' );

	// Make new image sizes available in WordPress Uploader
	add_filter('image_size_names_choose', 'themecore_image_sizes');

	// Customize entry meta in the entry header
	add_filter( 'genesis_post_info', 'themecore_post_info_filter' );

	// Modify footer credits
	add_filter('genesis_footer_creds_text', 'themecore_footer_creds_filter');

	// Include accessibility helper
	require_once( CHILD_DIR . '/includes/accessibility.php' );

	// Include footer navigation menu
	require_once( CHILD_DIR . '/includes/footer-navigation-menu.php' );

}

// Enqueue scripts and styles
function themecore_enqueue_scripts() {
	wp_enqueue_script( 'themecore-dropdown-menu', get_stylesheet_directory_uri() . '/assets/js/drop-down-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'themecore-responsive-menu', get_stylesheet_directory_uri() . '/assets/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_style( 'themecore-responsive-menu-css', get_stylesheet_directory_uri() . '/assets/css/responsive-menu.css', array(), '1.0.0' );
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
}

// Add new image sizes
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'custom-large', 1100, 619, TRUE );
	add_image_size( 'custom-medium', 690, 388, TRUE );
	add_image_size( 'custom-small', 300, 169, TRUE );
	add_image_size( 'custom-mini', 240, 135, TRUE );
}

// Show new image sizes in WordPress Uploader
function themecore_image_sizes($sizes) {
	$addsizes = array(
		'custom-large' => __('Custom Large'),
		'custom-medium' => __('Custom Medium'),
		'custom-small' => __('Custom Small'),
		'custom-mini' => __('Custom Mini')
	);

	$newsizes = array_merge($sizes, $addsizes);
		return $newsizes;
}

// Modify entry meta in the entry header
function themecore_post_info_filter($post_info) {
	$post_info = '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

// Modify footer credits
function themecore_footer_creds_filter( $creds ) {
	$creds = 'Copyright [footer_copyright] &middot; <a href="http://www.themecore.com">ThemeCore</a> on <a href="http://www.studiopress.com">Genesis Framework</a> &middot; All Rights Reserved';
	return $creds;
}
