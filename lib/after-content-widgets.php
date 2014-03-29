<?php

/**
 * Register after content widget areas based on the number of widget areas the user wishes to create with `add_theme_support()`.
 *
 * Based on code from the Genesis Framework
 */
add_action( 'after_setup_theme', 'themeoptions_register_after_content_widget_areas' );
function themeoptions_register_after_content_widget_areas() {

	$after_content_widgets = get_theme_support( 'genesis-after-content-widgets' );

	if ( ! $after_content_widgets || ! isset( $after_content_widgets[0] ) || ! is_numeric( $after_content_widgets[0] ) )
		return;

	$after_content_widgets = (int) $after_content_widgets[0];

	$counter = 1;

	while ( $counter <= $after_content_widgets ) {
		genesis_register_sidebar(
			array(
				'id'               => sprintf( 'after-content-%d', $counter ),
				'name'             => sprintf( __( 'After Content %d', 'genesis' ), $counter ),
				'description'      => sprintf( __( 'After Content %d widget area.', 'genesis' ), $counter ),
				'_genesis_builtin' => true,
			)
		);

		$counter++;
	}

}

/**
 * Echo the markup necessary to facilitate the after content widget areas.
 *
 * Based on code from the Genesis Framework
 */
add_action( genesis_after_entry_content, 'genesis_after_content_widget_areas' );
function genesis_after_content_widget_areas() {

	$after_content_widgets = get_theme_support( 'genesis-after-content-widgets' );

	if ( ! $after_content_widgets || ! isset( $after_content_widgets[0] ) || ! is_numeric( $after_content_widgets[0] ) )
		return;

	$after_content_widgets = (int) $after_content_widgets[0];

	//* Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
	if ( ! is_active_sidebar( 'after-content-1' ) )
		return;

	$inside  = '';
	$output  = '';
 	$counter = 1;

	while ( $counter <= $after_content_widgets ) {

		//* Darn you, WordPress! Gotta output buffer.
		ob_start();
		dynamic_sidebar( 'after-content-' . $counter );
		$widgets = ob_get_clean();

		$inside .= sprintf( '<div class="after-content-widgets-%d widget-area">%s</div>', $counter, $widgets );

		$counter++;

	}

	if ( $inside ) {
	
		$output .= genesis_markup( array(
			'html5'   => '<div %s>',
			'xhtml'   => '<div id="after-content-widgets" class="after-content-widgets">',
			'context' => 'after-content-widgets',
		) );
	
		$output .= genesis_structural_wrap( 'after-content-widgets', 'open', 0 );
		
		$output .= $inside;
		
		$output .= genesis_structural_wrap( 'after-content-widgets', 'close', 0 );
		
		$output .= '</div>';

	}

	echo apply_filters( 'genesis_after_content_widget_areas', $output, $after_content_widgets );

}