<?php

// Cirtestate tab shortcode
function cityestate_tab( $atts, $content = null ){
	// Extract tab values
	extract( shortcode_atts( array(
		'tabs'	=> '',		
	), $atts ) );

	// Parse tabs
	$tabs		= (array) vc_param_group_parse_atts( $tabs );
	$tabs_data	= array();

	// Collect the tab values
	foreach( $tabs as $data ):
		$temp 						= $data;
		$temp['tab_name']			= isset( $data['tab_name'] ) ? $data['tab_name'] : '';
		$temp['tab_image']			= isset( $data['tab_image'] ) ? $data['tab_image'] : '';
		$temp['dimension_label']	= isset( $data['dimension_label'] ) ? $data['dimension_label'] : '';
		$temp['dimension_size']		= isset( $data['dimension_size'] ) ? $data['dimension_size'] : '';
		$temp['tab_title']			= isset( $data['tab_title'] ) ? $data['tab_title'] : '';
		$temp['tab_desc']			= isset( $data['tab_desc'] ) ? $data['tab_desc'] : '';
		$tabs_data[] 				= $temp;
	endforeach;	
	
	// Collect the outer elements of tab
	$output = '<div id="tabs">';	
	$tab_title = '<ul>';
	$tab_content = '';

	foreach( $tabs_data as $tab ):
		// Get tab image
		if( is_numeric($tab['tab_image']) ){
			$tab_image = wp_get_attachment_url($tab['tab_image']);
		}		
		// Generate unique id for tab
		$token = wp_generate_password(7, false, false);

		// Set tab title
		$tab_title .= '<li><a href="#'.esc_attr($token).'">'.sprintf( esc_html__( '%s', 'cityestate' ), $tab['tab_name'] ).'</a></li>';

		$tab_content .= 
		'<div id="'.esc_attr($token).'">
			<div class="rooom-detial-images">
				<img src="'.esc_url($tab_image).'" alt="'. sprintf( esc_html__( '%s', 'cityestate' ), $tab['tab_name'] ) .'">
				<div class="room-detail-images-infos">
					<span>'. sprintf( esc_html__( '%s', 'cityestate' ), $tab['dimension_label'] ) .'</span>
					<h5>'. sprintf( esc_html__( '%s', 'cityestate' ), $tab['dimension_size'] ) .'</h5>
				</div>						
			</div>
			<h3>'. sprintf( esc_html__( '%s', 'cityestate' ), $tab['tab_title'] ) .'</h3>
			<p>'. sprintf( esc_html__( '%s', 'cityestate' ), $tab['tab_desc'] ) .'</p>
		</div>';

	endforeach;

	// Merge the element of tab
	$tab_title 	.= '</ul>';
	$output 	.= $tab_title;
	$output 	.= $tab_content;
	$output 	.= '</div>';

	return $output;
}
add_shortcode( 'cityestate_tab','cityestate_tab' );

?>