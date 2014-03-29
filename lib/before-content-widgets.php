<?php

/**
 * Register before content widget areas based on the number of widget areas the user wishes to create with `add_theme_support()`.
 *
 * Based on code from the Genesis Framework
 */
add_action( 'after_setup_theme', 'themecore_register_before_content_widget_areas' );
function themecore_register_before_content_widget_areas() {

	$before_content_widgets = get_theme_support( 'genesis-before-content-widgets' );

	if ( ! $before_content_widgets || ! isset( $before_content_widgets[0] ) || ! is_numeric( $before_content_widgets[0] ) )
		return;

	$before_content_widgets = (int) $before_content_widgets[0];

	$counter = 1;

	while ( $counter <= $before_content_widgets ) {
		genesis_register_sidebar(
			array(
				'id'               => sprintf( 'before-content-%d', $counter ),
				'name'             => sprintf( __( 'Before Content %d', 'genesis' ), $counter ),
				'description'      => sprintf( __( 'Before Content %d widget area.', 'genesis' ), $counter ),
				'_genesis_builtin' => true,
			)
		);

		$counter++;
	}

}

/**
 * Echo the markup necessary to facilitate the before content widget areas.
 *
 * Based on code from the Genesis Framework
 */
add_action( genesis_before_entry_content, 'genesis_before_content_widget_areas' );
function genesis_before_content_widget_areas() {

	$before_content_widgets = get_theme_support( 'genesis-before-content-widgets' );

	if ( ! $before_content_widgets || ! isset( $before_content_widgets[0] ) || ! is_numeric( $before_content_widgets[0] ) )
		return;

	$before_content_widgets = (int) $before_content_widgets[0];

	if ( ! is_active_sidebar( 'before-content-1' ) )
		return;

	$inside  = '';
	$output  = '';
 	$counter = 1;

	while ( $counter <= $before_content_widgets ) {

		ob_start();
		dynamic_sidebar( 'before-content-' . $counter );
		$widgets = ob_get_clean();

		$inside .= sprintf( '<div class="before-content-widgets-%d widget-area">%s</div>', $counter, $widgets );

		$counter++;

	}

	if ( $inside ) {
	
		$output .= genesis_markup( array(
			'html5'   => '<div %s>',
			'xhtml'   => '<div id="before-content-widgets" class="before-content-widgets">',
			'context' => 'before-content-widgets',
		) );
	
		$output .= genesis_structural_wrap( 'before-content-widgets', 'open', 0 );
		
		$output .= $inside;
		
		$output .= genesis_structural_wrap( 'before-content-widgets', 'close', 0 );
		
		$output .= '</div>';

	}

	echo apply_filters( 'genesis_before_content_widget_areas', $output, $before_content_widgets );

}