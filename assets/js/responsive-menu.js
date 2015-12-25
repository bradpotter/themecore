( function( window, $, undefined ) {
	'use strict';

	// Add toggle to menus
	$( '.nav-header' ).before( '<button class="menu-toggle header-toggle" role="button" aria-pressed="false">Menu</button>' );
	$( '.nav-primary' ).before( '<button id="genesis-primary-mobile" class="menu-toggle primary-toggle" role="button" aria-pressed="false">Menu</button>' );
	$( '.nav-secondary' ).before( '<button id="genesis-secondary-mobile" class="menu-toggle secondary-toggle" role="button" aria-pressed="false">Menu</button>' );
	$( '.nav-footer' ).before( '<button id="genesis-footer-mobile" class="menu-toggle footer-toggle" role="button" aria-pressed="false">Menu</button>' );
	
	// Add toggles to sub menus
	$( 'nav .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"><span class="screen-reader-text">Submenu</span></button>' );

	// Change skip link when loading below defined width
	$(window).load(function() {
		if(window.innerWidth < 768) {
			
			$( 'ul.genesis-skip-link a[href="#genesis-nav-primary"]' ).attr('href', '#genesis-primary-mobile');
			$( 'ul.genesis-skip-link a[href="#genesis-nav-secondary"]' ).attr('href', '#genesis-secondary-mobile');
			$( 'ul.genesis-skip-link a[href="#genesis-nav-footer"]' ).attr('href', '#genesis-footer-mobile');
		}	
	});

	// Change skip link and reset menu on resize
	$(window).resize(function() {
		if(window.innerWidth < 768) {
			
			$( 'ul.genesis-skip-link a[href="#genesis-nav-primary"]' ).attr('href', '#genesis-primary-mobile');
			$( 'ul.genesis-skip-link a[href="#genesis-nav-secondary"]' ).attr('href', '#genesis-secondary-mobile');
			$( 'ul.genesis-skip-link a[href="#genesis-nav-footer"]' ).attr('href', '#genesis-footer-mobile');

		} else if(window.innerWidth > 768) {

			$( 'ul.genesis-skip-link a[href="#genesis-primary-mobile"]' ).attr('href', '#genesis-nav-primary');
			$( 'ul.genesis-skip-link a[href="#genesis-secondary-mobile"]' ).attr('href', '#genesis-nav-secondary');
			$( 'ul.genesis-skip-link a[href="#genesis-footer-mobile"]' ).attr('href', '#genesis-nav-footer');
			$( '.menu-toggle, .sub-menu-toggle' ).removeClass( 'activated' ).attr( 'aria-expanded', false ).attr( 'aria-pressed', false );
			$( 'nav, .sub-menu' ).attr( 'style', '' );
		}
	});

	// Show or hide the menu
	$( '.menu-toggle, .sub-menu-toggle' ).on( 'click', function() {
		
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});

		$this.toggleClass( 'activated' );
		$this.next( 'nav, .sub-menu' ).slideToggle( 'fast' );

	});

})( this, jQuery );
