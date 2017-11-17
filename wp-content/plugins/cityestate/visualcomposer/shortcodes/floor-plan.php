<?php

// Cityestate floor plan shortcode
function cityestate_floor_plan( $atts, $content = null ){
	// Extract floor plan values
	extract( shortcode_atts( array(
		'floor_plans'	=> '',		
	), $atts ) );

	// Parse floor plan
	$floor_plans		= (array) vc_param_group_parse_atts( $floor_plans );
	$floor_plans_info	= array();

	foreach( $floor_plans as $data ):
		// Collect the floor plan info
		$temp 						= $data;
		$temp['floor_name']			= isset( $data['floor_name'] ) ? $data['floor_name'] : '';
		$temp['floor_image']		= isset( $data['floor_image'] ) ? $data['floor_image'] : '';
		$temp['floor_attributes']	= isset( $data['floor_attributes'] ) ? $data['floor_attributes'] : '';
		$temp['floor_desc']			= isset( $data['floor_desc'] ) ? $data['floor_desc'] : '';
		$temp['floor_price']		= isset( $data['floor_price'] ) ? $data['floor_price'] : '';
		$floor_plans_info[] 		= $temp;
	endforeach;	
	
	// Store outer element in variable
	$output 			= '<div class="single-floor-plan">';
	$tab_title 			= '<ul class="nav nav-tabs">';
	$tab_content_outer 	= '<div class="tab-content">';
	$tab_content 		= '';

	$counter = 0;

	// Collect the floor detail
	foreach( $floor_plans_info as $floor_plan ):
		if( is_numeric($floor_plan['floor_image']) ){
			// Floor plan image
			$plan_image = wp_get_attachment_url($floor_plan['floor_image']);			
		}

		// Floor plan attributes
		$attributes = explode( ', ', $floor_plan['floor_attributes'] );
		
		// Unique is for tab
		$token = wp_generate_password(7, false, false);

		// Set active tab
		if( $counter == 0 ){
			$tab_title .= '<li class="active"><a data-toggle="tab" href="#'.esc_attr($token).'">'.sprintf( esc_html__( '%s', 'cityestate' ), $floor_plan['floor_name'] ).'</a>';
		} else {
			$tab_title .= '<li><a data-toggle="tab" href="#'.esc_attr($token).'">'.sprintf( esc_html__( '%s', 'cityestate' ), $floor_plan['floor_name'] ).'</a>';
		}	

		// Set active tab
		if( $counter == 0 ){
			$tab_content .= '<div id="'.esc_attr($token).'" class="tab-pane fade in active">';
		} else {
			$tab_content .= '<div id="'.esc_attr($token).'" class="tab-pane fade">';
		}
		
		// Floor plan content	
		$tab_content .= '		
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-8">
					<img src="'.esc_url($plan_image).'" alt="'.esc_attr($floor_plan['floor_name']).'">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">';
					if( !empty($attributes) ){
						$tab_content .= '<ul class="floor-detail-list-item">';

						foreach( $attributes as $key => $value ){
							$tab_content .= '<li>'.sprintf( esc_html__( '%s', 'cityestate' ), $value ).'</li>';
						}
						$tab_content .= '</ul>';
					}
					$tab_content .= '
					<p>'.$floor_plan['floor_desc'].'</p>
					<span class="floorplan-price">'.sprintf( esc_html__( '%s', 'cityestate' ), $floor_plan['floor_price'] ).'</span>
				</div>
			</div>
		</div>';

		$counter++;

	endforeach;

	// Close the last element
	$tab_title .= '</ul>';
	$output .= $tab_title;	
	// Vertical space
	$output .= '<div class="vertical-space-80"></div>';
	$output .= $tab_content_outer;
	$output .= $tab_content;
	$output .= '</div></div>';

	return $output;
}
add_shortcode( 'floor_plan','cityestate_floor_plan' );

?>