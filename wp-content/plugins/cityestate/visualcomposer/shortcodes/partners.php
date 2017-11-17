<?php

// Cityestate partners shortcode
function cityestate_partners( $atts, $content = null ){
	// Extract partners values
	extract( shortcode_atts( array(
		'partners_logo' => '',
	), $atts ) );

	$partners_images_url = '';

	// Check partners logo is not empty
	if( !empty($partners_logo) ){

		$images_id_array = array();
		// Expload partners images id
		$images_id_array = explode(',',$partners_logo);
		foreach( $images_id_array as $id ){
			// Partners images
			$partners_images_url .= '<li><img alt="partner" src="' .wp_get_attachment_url( $id ) . '"/></li>';
		}

	}
		
	// Merge elements
	$output  = '';
	$output .= '<ul class="our-partner">';
    $output .= $partners_images_url;
	$output .='</ul>';
	
	return $output;
}
add_shortcode( 'partners', 'cityestate_partners' );

?>