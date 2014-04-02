( function( window, $, undefined ) {
	'use strict';

	$( '.nav-header' ).before( '<button class="menu-toggle header-toggle" role="button" aria-pressed="false"></button>' ); // Add toggle to header menu
	$( '.nav-primary' ).before( '<button class="menu-toggle primary-toggle" role="button" aria-pressed="false"></button>' ); // Add toggle to primary menu
	$( '.nav-secondary' ).before( '<button class="menu-toggle secondary-toggle" role="button" aria-pressed="false"></button>' ); // Add toggle to secondary menu
	$( '.nav-tertiary' ).before( '<button class="menu-toggle tertiary-toggle" role="button" aria-pressed="false"></button>' ); // Add toggle to tertiary menu
	$( 'nav .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to all sub menus

	// Show/hide the navigation
	$( '.menu-toggle, .sub-menu-toggle' ).on( 'click', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});

		$this.toggleClass( 'activated' );
		$this.next( 'nav, .sub-menu' ).slideToggle( 'fast' );

	});

})( this, jQuery );