<?php

/**
 * Add accessibility
 *
 * @author Brad Potter
 *
 * @link http://www.bradpotter.com
 */
 
 // Add skip link to Secondary Navigation
add_filter( 'genesis_attr_nav-secondary', 'themecore_add_nav_secondary_id' );
function themecore_add_nav_secondary_id( $attributes ) {
	$attributes['id'] = 'genesis-nav-secondary';
	$attributes['aria-label'] = __( 'Secondary navigation', 'genesis' );
	return $attributes;
}

add_filter( 'genesis_skip_links_output', 'themecore_add_nav_secondary_skip_link' );
function themecore_add_nav_secondary_skip_link( $links ) {
	$new_links = $links;
	array_splice( $new_links, 1 );

	if ( has_nav_menu( 'secondary' ) ) {
		$new_links['genesis-nav-secondary'] = __( 'Skip to secondary navigation', 'themecore' );
	}

	return array_merge( $new_links, $links );
}

// Add heading to Secondary Navigation
add_filter( 'genesis_do_subnav', 'themecore_a11y_subnav_heading' );
function themecore_a11y_subnav_heading( $nav_output ) {
	
	if ( ! has_nav_menu( 'secondary' ) || ! genesis_a11y( 'headings' ) ) {
		return $nav_output;
	}

	$heading =  sprintf( '<h2 class="screen-reader-text">%s</h2>', __( 'Secondary navigation', 'genesis' ) );
		return $heading . $nav_output;
}

// Add skip link to footer navigation
add_filter( 'genesis_attr_nav-footer', 'themecore_add_nav_footer_id' );
function themecore_add_nav_footer_id( $attributes ) {
	$attributes['id'] = 'genesis-nav-footer';
	$attributes['aria-label'] = __( 'Footer navigation', 'genesis' );
	return $attributes;
}

add_filter( 'genesis_skip_links_output', 'themecore_add_nav_footer_skip_link' );
function themecore_add_nav_footer_skip_link( $links ) {
	$new_links = $links;
	array_splice( $new_links, 2 );

	if ( has_nav_menu( 'footer' ) ) {
		$new_links['genesis-nav-footer'] = __( 'Skip to footer navigation', 'themecore' );
	}

	return array_merge( $new_links, $links );
}

// Modify Read More link for accessibility
add_filter('excerpt_more', 'themecore_read_more_link');
add_filter('the_content_more_link', 'themecore_read_more_link');
add_filter( 'get_the_content_more_link', 'themecore_read_more_link' );
function themecore_read_more_link() {
	
	if ( genesis_a11y() ) {
		return ' . . . <a class="more-link" href="' . get_permalink() . '">" . __( 'Read More<span class=\"screen-reader-text\"> about ' . the_title_attribute( 'echo=0' ) . '</span></a>', 'themecore' );

	} else {
		return ' . . . <a class="more-link" href="' . get_permalink() . '">" . __('[Read More]', 'themecore' ) . '</a>';
	}

}

// Add Read More to manually made excertps
add_filter( 'get_the_excerpt', 'themecore_excerpt_more' );
function themecore_excerpt_more( $excerpt ) {
	
	$excerpt_more = '';
	
	if ( has_excerpt() ) {
		$excerpt_more = ' . . . <a class="more-link" href="' . get_permalink() . '">" . __( 'Read More<span class=\"screen-reader-text\"> about ' . the_title_attribute( 'echo=0' ) . '</span></a>', 'themecore' );
	}
		
	return $excerpt . $excerpt_more;
}
