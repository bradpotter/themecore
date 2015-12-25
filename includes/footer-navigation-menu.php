<?php

add_action( 'genesis_before_footer', 'themecore_do_footernav' );
/**
 * Echo the "Footer Navigation" menu
 *
 * @author Brad Potter
 *
 * @link http://www.bradpotter.com
 *
 * Based on code from the StudioPress Genesis Framework 2.2
 */
function themecore_do_footernav() {

	//* Do nothing if menu not supported
	if ( ! genesis_nav_menu_supported( 'footer' ) )
		return;

	$class = 'menu genesis-nav-menu menu-footer';
	if ( genesis_superfish_enabled() ) {
		$class .= ' js-superfish';
	}

	if ( genesis_a11y( 'headings' ) ) {
		printf( '<h2 class="screen-reader-text">%s</h2>', __( 'Footer navigation', 'themecore' ) );
	}

	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'menu_class'     => $class,
	) );

}

add_filter( 'genesis_attr_nav-footer', 'themecore_attributes_nav_footernav' );
/**
 * Add Attributes for Footer Navigation Menu.
 * 
 * @author Brad Potter
 * 
 * @link http://www.bradpotter.com
 *
 * Based on code from the StudioPress Genesis Framework 2.2
 */
function themecore_attributes_nav_footernav( $attributes ) {

	$attributes['itemscope'] = true;
	$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';

	return $attributes;
}
