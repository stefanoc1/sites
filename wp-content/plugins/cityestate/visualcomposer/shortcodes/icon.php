<?php

// Cityestate icon shortcode
function cityestate_icon( $atts, $content = null ){
	// Extract icon values
	extract( shortcode_atts( array(
		'name'	=> '',
		'size'	=> '',
		'color'	=> '',		
	), $atts ) );

	// Define icon style
	$style = 'style="';

	// Size of icon
	if( $size )
		$style .= ' font-size:' . $size. ';';
	// Color of icon
	if( $color )
		$style .= ' color:' . $color. ';';	
	
	$style .= '"';			
				
	// Icon element
	$output = '<i class="'. $name .'" '.$style.'></i>';
	
	return $output;
}
add_shortcode( 'icon', 'cityestate_icon' );

?>