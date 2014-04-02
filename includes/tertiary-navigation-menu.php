<?php

/**
 * Echo the "Tertiary Navigation" menu.
 *
 * The preferred option for creating menus is the Custom Menus feature in WordPress. There is also a fallback to using
 * the Genesis wrapper functions for creating a menu of Pages, or a menu of Categories (maintained only for backwards
 * compatibility).
 *
 * Either output can be filtered via `genesis_do_subnavtwo`.
 *
 * @since 1.0.0
 *
 * @uses genesis_nav_menu_supported() Checks for support of specific nav menu. (Commented Out)
 * @uses genesis_markup()             Contextual markup.
 * @uses genesis_html5()              Check for HTML5 support.
 * @uses genesis_structural_wrap()    Adds optional internal wrap divs.
 * 
 * Based on code from the StudioPress Genesis Framework 2.0
 */
function genesis_do_subnavtwo() {

	//* Do nothing if menu not supported
	// if ( ! genesis_nav_menu_supported( 'tertiary' ) )
		// return;

	register_nav_menu( 'tertiary', 'Tertiary Navigation Menu' );
	
	//* If menu is assigned to theme location, output
	if ( has_nav_menu( 'tertiary' ) ) {

		$class = 'menu genesis-nav-menu menu-tertiary';
		if ( genesis_superfish_enabled() )
			$class .= ' js-superfish';

		$args = array(
			'theme_location' => 'tertiary',
			'container'      => '',
			'menu_class'     => $class,
			'echo'           => 0,
		);

		$subnavtwo = wp_nav_menu( $args );

		//* Do nothing if there is nothing to show
		if ( ! $subnavtwo )
			return;

		$subnavtwo_markup_open = genesis_markup( array(
			'html5'   => '<nav %s><div class="wrap">',
			'xhtml'   => '<div id="subnavtwo"><div class="wrap">',
			'context' => 'nav-tertiary',
			'echo'    => false,
		) );
		$subnavtwo_markup_open .= genesis_structural_wrap( 'menu-tertiary', 'open', 0 );

		$subnavtwo_markup_close  = genesis_structural_wrap( 'menu-tertiary', 'close', 0 );
		$subnavtwo_markup_close .= genesis_html5() ? '</div></nav>' : '</div></div>';

		$subnavtwo_output = $subnavtwo_markup_open . $subnavtwo . $subnavtwo_markup_close;

		echo apply_filters( 'genesis_do_subnavtwo', $subnavtwo_output, $subnavtwo, $args );

	}

}


add_filter( 'genesis_attr_nav-tertiary', 'themecore_attributes_nav_subnavtwo' );
/**
 * Add Attributes for Tertiary Navigation Menu.
 * 
 * @author Brad Potter
 * 
 * @link http://www.bradpotter.com
 *
 * Based on code from the StudioPress Genesis Framework 2.0
 */
function themecore_attributes_nav_subnavtwo( $attributes ) {

	$attributes['role']      = 'navigation';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';

	return $attributes;
}