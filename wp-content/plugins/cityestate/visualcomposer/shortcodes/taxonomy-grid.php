<?php

// Cityestate taxonomy grid shortcode
function cityestate_taxonomy_grid( $atts, $content = null ){
	// Extract taxonomy grid values	
	extract( shortcode_atts( array(
		'taxonomy_type'			=> 'select',
		'property_type'			=> '',
		'property_status'		=> '',
		'property_feature'		=> '',
		'property_city'			=> '',
		'property_area'			=> '',
		'property_location'		=> '',
		'taxonomy_image'		=> '',
		'show_taxonomy_name'	=> '',
		'custom_taxonomy_label' => '',
		'taxonomy_label'		=> '',
		'show_counter_property'	=> '',
		'custom_counter_label'	=> '',
		'counter_label'			=> '',
	), $atts ) );

	// Check is taxonomy is selected
	if( $taxonomy_type != 'select' && !empty( $taxonomy_type ) ){
		
		// Check taxonomy type which is choosed
		switch ( $taxonomy_type ) {
			case 'property_type':
				$taxonomy = get_term( $property_type, $taxonomy_type );
			break;

			case 'property_status':
				$taxonomy = get_term( $property_status, $taxonomy_type );
			break;

			case 'property_feature':
				$taxonomy = get_term( $property_feature, $taxonomy_type );
			break;

			case 'property_city':
				$taxonomy = get_term( $property_city, $taxonomy_type );
			break;

			case 'property_area':
				$taxonomy = get_term( $property_area, $taxonomy_type );
			break;

			case 'property_location':
				$taxonomy = get_term( $property_location, $taxonomy_type );
			break;
		}

		// Get taxonomy link
		$term_link = get_term_link( $taxonomy->term_id, $taxonomy_type );

		// Get taxonomy image
		if( is_numeric($taxonomy_image) ){
	        $taxonomy_image_src = wp_get_attachment_url( $taxonomy_image );
	    }

		$output = '';

		$output .= '
		<div class="property-type-box-1">
			<a href="'.esc_url($term_link).'">
				<div class="property-type-box1-inner">
					<img src="'.esc_url($taxonomy_image_src).'" class="img-full" alt="'.esc_attr($taxonomy->name).'">
					<div class="property-type-box1-overley">
						<div class="propperty-type-box1-info-inner">';
							// Set taxonomy label or title
							if( $show_taxonomy_name != 'no' ){
								if( $custom_taxonomy_label == 'yes' ){
									$output .= '<h3 class="text-center">'.sprintf( esc_html__( '%s', 'cityestate' ), $custom_taxonomy_label ).'</h3>';
								} else {
									$output .= '<h3 class="text-center">'.sprintf( esc_html__( '%s', 'cityestate' ), $taxonomy->name ).'</h3>';
								}							
							}
							// Set how many property found in selected taxonomy
							if( $show_counter_property != 'no' ){
								$output .= 
								'<span class="status-label">';							
									// Set found property number
									$output .= sprintf( esc_html__( '%s', 'cityestate' ), $taxonomy->count );
									// Set counter label
									if( $custom_counter_label == 'yes' ){
										$output .= sprintf( esc_html__( ' %s', 'cityestate' ), $counter_label );
									} else {
										if( $taxonomy->count < 2 ){
											$output .= esc_html__( ' Property', 'cityestate' );								
										} else {
											$output .= esc_html__( ' Properties', 'cityestate' );
										}
									}
								$output .= '</span>';
							}
							$output .='						
						</div>
					</div>
				</div>
			</a>
		</div>';

		return $output;
	}
}
add_shortcode( 'taxonomy_grid', 'cityestate_taxonomy_grid' );

?>