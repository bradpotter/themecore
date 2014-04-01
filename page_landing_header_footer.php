<?php
/**
 * This file adds the Landing Page template to ThemeCore.
 *
 * @author Brad Potter
 * @package ThemeCore
 * @subpackage Customizations
 */

/*
Template Name: Landing Page - Header/Footer
*/

//* Add custom body class to the head
add_filter( 'body_class', 'themecore_add_body_class' );
function themecore_add_body_class( $classes ) {

   $classes[] = 'themecore-landing';
   return $classes;
   
}

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Run the Genesis loop
genesis();
