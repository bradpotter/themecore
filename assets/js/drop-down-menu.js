/**
 * This script adds keyboard accessibility to a drop down menu.
 *
 * @since 2.2.0
 *
 * need the following css to make it work:
 *
 *  .menu .menu-item:focus {
 * 	  position: static;
 *  }
 *
 *  .menu .menu-item > a:focus + ul.sub-menu,
 *  .menu .menu-item.genesis-hover > ul.sub-menu {
 * 	  left: auto;
 * 	  opacity: 1;
 *  }
 *
*/

var genesis_drop_down_menu = ( function( $ ) {
	'use strict';

	/**
	 * Add class to menu item on hover.
	 *
	 * @since 2.2.0
	 */
	var menuItemEnter = function() {
		$( this ).addClass( 'genesis-hover' );
	},

	/**
	 * Remove a class when focus leaves menu item.
	 *
	 * @since 2.2.0
	 */
	menuItemLeave = function() {
		$( this ).removeClass( 'genesis-hover' );
	},

	/**
	 * Toggle menu item class when a link fires a focus or blur event.
	 *
	 * @since 2.2.0
	 */
	menuItemToggleClass = function() {
		$( this ).parents( '.menu-item' ).toggleClass( 'genesis-hover' );
	},

	/**
	 * Bind behaviour to events.
	 *
	 * @since 2.2.0
	 */
	ready = function() {
		$( '.menu li' )
			.on( 'mouseenter.genesis-hover', menuItemEnter )
			.on( 'mouseleave.genesis-hover', menuItemLeave )
			.find( 'a' )
			.on( 'focus.genesis-hover blur.genesis-hover', menuItemToggleClass );
	};

	// Only expose the ready function to the world
	return {
		ready: ready
	};

})( jQuery );

jQuery( genesis_drop_down_menu.ready );
