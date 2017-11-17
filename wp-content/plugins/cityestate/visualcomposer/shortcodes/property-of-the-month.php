<?php

// Cityestate property of the month shortcode
function cityestate_property_of_month( $atts, $content = null ){
	// Extract property of the month values
	extract( shortcode_atts( array(
		'property_month'			=> '',
		'property_label'			=> 'Property Of The Month',
		'property_word_limit'		=> '20',
		'property_more_btn'			=> 'Explore More',
		'property_more_btn_link'	=> '',
	), $atts ) );	

	$output = '';
	// Check property of the month is not empty
	if( !empty($property_month) ){
		global $post;
		// Get detail of property of the month
		$property_month = get_post( $property_month );		
		$output .= '
		<section class="sectionPropertyMonth">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-xs-12 col-md-6 left">';
						// Get the property of the month image
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $property_month->ID ), "full" );
						if( !empty($full_image) ){
							$output .='<img src="'.esc_url($full_image[0]).'" alt="properymonthimg"/>';
						} else {
							$img_width = 968; $img_height = 524; $img_text = get_bloginfo('name');
							$output .= '<img src="http://placehold.it/' . $img_width . 'x' . $img_height . '&text=' . urlencode( $img_text ) . '" />';
						} 						
					$output .= '
					</div>
					<div class="col-sm-12 col-xs-12 col-md-6 right">
						<div class="vertical-space-80"></div>
						<span class="section-property-month">'.sprintf( esc_html__( '%s', ' cityestate' ), $property_label).'</span>
						<span class="section-on-rent">'.sprintf( esc_html__( '%s', ' cityestate' ), cityestate_taxonomy_detail_id('property_status','names',$property_month->ID) ).'</span>
						<h2 class="section-title">'.sprintf( esc_html__( '%s', ' cityestate' ), $property_month->post_title );
						// Address of property of the month
						$property_address = get_post_meta( $property_month->ID, 'property_address', true );						
						if( !empty($property_address) ){							
							$output .= sprintf( esc_html__( ', %s', ' cityestate' ), $property_address );
						}
						// Short description of property of the month
						$output .= '</h2>
						<p class="section-description">
							'.wp_trim_words( $property_month->post_content, $property_word_limit, '...' ).'
						</p>';

						// Get bedrooms of property of the month
						$property_bedrooms 	= get_post_meta( $property_month->ID, 'property_bedrooms', true );
						// Get bathrooms of propert of the month
						$property_bathrooms = get_post_meta( $property_month->ID, 'property_bathrooms', true );
						// Get garages of proprty of the month
						$property_garage 	= get_post_meta( $property_month->ID, 'property_garage', true );

						// Checl bedrooms or bathrooms or garages is not empty
						if( !empty($property_bedrooms) || !empty($property_bathrooms) || !empty($property_garage) ){
							$output .='
							<div class="features">
								<ul>';
								// Check bedrooms is available
								if( !empty($property_bedrooms) ){
									$output .='
									<li>
										<img src="'.get_template_directory_uri().'/images/badroom.png" alt="badroom"/>
										<p><span>'.sprintf( esc_html__( '%s', ' cityestate' ), $property_bedrooms ).' </span>'.esc_html__( 'Bedrooms', 'cityestate' ).'<span class="space"></span></p>
									</li>';
								}
								// Check bathrooms is available
								if( !empty($property_bathrooms) ){
									$output .='
									<li>
										<img src="'.get_template_directory_uri().'/images/bathroom.png" alt="badroom"/>
										<p><span>'.sprintf( esc_html__( '%s', ' cityestate' ), $property_bathrooms ).' </span>'.esc_html__( 'Bathrooms', 'cityestate' ).'<span class="space"></span></p>
									</li>';
								}
								// Check garages is available
								if( !empty($property_garage) ){
									$output .='
									<li>
										<img src="'.get_template_directory_uri().'/images/garage.png" alt="badroom"/>
										<p><span>'.sprintf( esc_html__( '%s', ' cityestate' ), $property_garage ).' </span>'.esc_html__( 'Garages', 'cityestate' ).'<span class="space"></span></p>
									</li>';
								}
								$output .='
								</ul>
							</div>';
						}
						// Property detail link
						if( !empty($property_more_btn_link) ){
							$link = $property_more_btn_link;
						} else {
							$link = get_permalink($property_month->ID);
						}
						// More about propert link
						$output .= '<a class="explore" href="'.esc_attr($link).'">'.sprintf( esc_html__( '%s', ' cityestate' ), $property_more_btn ).'</a>';
						
						// Set favorite property option
						$frontend_submission = cityestate_option('property_submit_by_user');
						if( isset( $frontend_submission ) && $frontend_submission != "no" ){
							$output .='
							<a class="like-property add-favorite" data-propertyid="'.intval( $property_month->ID ).'" href="javascript:void(0);">
								<i class="fa fa-heart-o" aria-hidden="true"></i>
							</a>';
						}
					$output .='
					</div>
				</div>
			</div>
		</section>';
	}

	return $output;
}
add_shortcode( 'property_of_month', 'cityestate_property_of_month' );

?>