<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'ThemeCore' );
define( 'CHILD_THEME_URL', 'http://www.themecore.com/' );
define( 'CHILD_THEME_VERSION', '2.0.2' );

//* Enqueue Google fonts
add_action( 'wp_enqueue_scripts', 'themecore_google_fonts' );
function themecore_google_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );