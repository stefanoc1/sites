<?php

// Cityestate title shortcode
function cityestate_maxtitle_shortcode( $atts, $content = null ){	
	// Extract title value
	extract( shortcode_atts( array(
		'type'					=> '1',
		'heading'				=> '1',
		'maxtitle_content'		=> '',
		'maxtitle_color'		=> '#323a45',
		'position'				=> 'left',
	), $atts ) );

	// Set title color
	$maxtitle_color = $maxtitle_color ? ' style="color: ' . $maxtitle_color . ';"' : '';

	// Title element is ready to show
	$output = '
	<div class="max-title max-title' . $type . '">
		<h' . $heading. $maxtitle_color . ' class="text-'.$position.'">'. sprintf( esc_html__( '%s', 'cityestate' ), $maxtitle_content ) .'</h' . $heading.'>
	</div>';

	return $output;
}
add_shortcode( 'maxtitle', 'cityestate_maxtitle_shortcode' );

?>