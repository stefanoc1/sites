<?php

// Cityestate button shortcode
function cityestate_buttons( $atts, $content = null ){
	// Extract button values
	extract( shortcode_atts( array(
		'btn_content'   => '',
		'shape'     	=> '',
		'url'      		=> '#',
		'target'   		=> '_self',
		'color'    		=> 'theme-skin',
		'size'     		=> 'small',
		'border'   		=> 'false',
		'icon'     		=> ''
	), $atts ) );

	// Check border
	$border = ( 'true' == $border ) ? 'bordered-bot' : '';
	// Button with icon
	$icon_str = !empty($icon)? '<i class="'.$icon.'"></i>' : '';
	// Button link 	
 	$output = '<a href="'. $url . '" class="button '.$color.' '.$shape.' '.$size.' '.$border.' " target="'.$target.'">'. $icon_str . $btn_content . '</a>';
 	
 	return $output;
}
add_shortcode( 'button', 'cityestate_buttons' );

?>