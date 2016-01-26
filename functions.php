<?php
/**
 * ThemeCore setup and initialization.
 *
 * @package      ThemeCore
 * @author       Brad Potter
 * @link         http://www.bradpotter.com/
 * @copyright    Copyright (c) 2015, Brad Potter
 * @license      GPL-2.0+
 * @since        2.2.6
 */

defined( 'ABSPATH' ) || exit;

define( 'CHILD_THEME_NAME', 'ThemeCore' );
define( 'CHILD_THEME_URL', 'http://www.themecore.com' );
define( 'CHILD_THEME_VERSION', '2.2.6' );

add_action( 'after_setup_theme', 'themecore_load_textdomain' );
/**
 * Load ThemeCore textdomain.
 */
function themecore_load_textdomain() {
	load_child_theme_textdomain(
		'themecore',
		trailingslashit( get_stylesheet_directory() ) . 'languages'
	);
}

add_action( 'init', 'themecore_register_image_sizes', 5 );
/**
 * Register custom image sizes.
 */
function themecore_register_image_sizes() {
	add_image_size( 'custom-full', 1140, 641, TRUE );
	add_image_size( 'custom-large', 740, 416, TRUE );
	add_image_size( 'custom-medium', 340, 191, TRUE );
}

add_filter('image_size_names_choose', 'themecore_merge_image_sizes');
/**
 * Show custom image sizes in WordPress Uploader.
 */
function themecore_merge_image_sizes($sizes) {
	$addsizes = array(
		'custom-full'  => __('Custom Full'),
		'custom-large' => __('Custom Large'),
		'custom-medium'  => __('Custom Medium'),
	);

	$newsizes = array_merge($sizes, $addsizes);
		return $newsizes;
}

add_action( 'genesis_setup', 'themecore_setup', 15 );
/**
 * Setup ThemeCore.
 */
function themecore_setup() {
	
	add_theme_support( 'genesis-responsive-viewport' );
	
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'search-form',
		'gallery',
		'caption',
	) );
	
	add_theme_support( 'custom-background' );
	
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'menu-footer',
		'site-inner',
		'footer-widgets',
		'footer',
	) );
	
	add_theme_support( 'genesis-menus', array(
		'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
		'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
		'footer'    => __( 'Footer Navigation Menu', 'genesis' ),
	) );
	
	add_theme_support( 'genesis-accessibility', array(
		'404-page',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	) );
	
	add_theme_support( 'genesis-footer-widgets', 3 );

}

add_action( 'genesis_setup', 'themecore_includes', 15 );
/**
 * Load functions and helpers.
 */
function themecore_includes() {
	require_once( CHILD_DIR . '/includes/accessibility.php' );
	require_once( CHILD_DIR . '/includes/footer-navigation-menu.php' );
}

add_action( 'wp_enqueue_scripts', 'themecore_enqueue_scripts' );
/**
 * Enqueue scripts and styles.
 */
function themecore_enqueue_scripts() {
	wp_enqueue_script( 'themecore-drop-down-menu', get_stylesheet_directory_uri() . '/assets/js/drop-down-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'themecore-responsive-menu', get_stylesheet_directory_uri() . '/assets/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_style( 'themecore-responsive-menu-css', get_stylesheet_directory_uri() . '/assets/css/responsive-menu.css', array(), '1.0.0' );
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
}

add_filter( 'genesis_post_info', 'themecore_post_info_filter' );
/**
 * Customize entry meta in the entry header.
 */
function themecore_post_info_filter($post_info) {
	$post_info = '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

add_filter('genesis_footer_creds_text', 'themecore_footer_creds_filter');
/**
 * Customize footer credits.
 */
function themecore_footer_creds_filter( $creds ) {
	$creds = 'Copyright [footer_copyright] &middot; <a href="http://www.themecore.com">ThemeCore</a> on <a href="http://www.studiopress.com">Genesis Framework</a> &middot; All Rights Reserved';
	return $creds;
}

/**
 * Load Genesis
 */
require_once get_template_directory() . '/lib/init.php';
