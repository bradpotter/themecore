<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'ThemeCore' );
define( 'CHILD_THEME_URL', 'http://www.themecore.com/' );
define( 'CHILD_THEME_VERSION', '2.0.2' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'themecore_enqueue_scripts' );
function themecore_enqueue_scripts() {
	wp_enqueue_script( 'themecore-responsive-menu', get_stylesheet_directory_uri() . '/assets/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
}

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'themecore_enqueue_styles' );
function themecore_enqueue_styles() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'themecore-responsive-menu-style', get_stylesheet_directory_uri() . '/assets/css/responsive-menu.css', array(), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
}

//* Add new image sizes
add_image_size( 'Slider-Large', 1080, 652, TRUE );
add_image_size( 'Slider-Medium', 680, 410, TRUE );
add_image_size( 'Slider-Small', 280, 169, TRUE );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'themecore_post_info_filter' );
function themecore_post_info_filter($post_info) {
	$post_info = '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

//* Change the footer text
add_filter('genesis_footer_creds_text', 'themecore_footer_creds_filter');
function themecore_footer_creds_filter( $creds ) {
	$creds = 'Copyright [footer_copyright] &middot; <a href="http://www.themecore.com">ThemeCore</a> on <a href="http://www.studiopress.com">Genesis Framework</a> &middot; All Rights Reserved';
	return $creds;
}

//* Include and add support for before content widgets
require_once( CHILD_DIR . '/includes/before-content-widgets.php' );
add_theme_support( 'genesis-before-content-widgets', 2 );

//* Include and add support for after content widgets
require_once( CHILD_DIR . '/includes/after-content-widgets.php' );
add_theme_support( 'genesis-after-content-widgets', 2 );

//* Include and hook tertiary navigation menu
require_once( CHILD_DIR . '/includes/tertiary-navigation-menu.php' );
add_action( 'genesis_before_footer', 'genesis_do_subnavtwo' );

// Register Genesis Menus
add_theme_support( 'genesis-menus', array( 'primary'   => __( 'Primary Navigation Menu', 'genesis' ), 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ), 'tertiary' => __( 'Tertiary Navigation Menu', 'genesis' ), ) );