<?php

// Cityestate testimonials shortcode
function cityestate_testimonials( $atts, $content = null ){	
	// Extract testimonials values
	extract( shortcode_atts( array(
		'posts_limit'		=> '',
		'offset'			=> '',
		'orderby'			=> '',		
		'order'				=> '',
		'list_style'		=> '0',
		'slider_infinite'	=> '',
		'slider_auto'		=> '',
		'slider_auto_speed'	=> '5000',		
	), $atts ) );

	// Merge content
	ob_start();

	// Set testimonials slider
	$slider_setting = '';
	$slider_setting .= ' data-wrap="'.$slider_infinite.'"';
	$slider_setting .= ' data-ride="'.$slider_auto.'"';	
	$slider_setting .= ' data-interval="'.$slider_auto_speed.'"';
	
	// Number of testimonial show to per page
	$number_of_item = 3;

	// Testimonials filter
	$args = array(
        'post_type' 		=> 'ce_testimonials',
        'posts_per_page' 	=> $posts_limit,
        'orderby' 			=> $orderby,
        'order' 			=> $order,
        'offset' 			=> $offset
    );
		
	// Do query	of testimonial
	$cityestate_query = new WP_Query($args);

	$output = '';

	// Check testimonial is found
	if( $cityestate_query->have_posts() ) :
		// Generate unique id of slider
		$token = wp_generate_password(7, false, false); 
		// Testimonial style one
		if( $list_style == 0 ){
			$output .=
			'<div id="carousel-client-testimonial-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.'>
				<ol class="carousel-indicators bottom-side">';
					// Testimonial counter
					$i = 0;				
					$counter = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
						// Active first slide
						$active_class = '';
						if( $i % $number_of_item == 0 ){
							if( $i == 0 ){						
								$output .= '<li data-target="#carousel-client-testimonial-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
							} else {
								$output .= '<li data-target="#carousel-client-testimonial-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
							}
							$counter++;
						}					
						$i++;
					endwhile;
				$output .=				
				'</ol>

				<div class="carousel-inner" role="listbox">';
					$i = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
					
					// Testimonial detail
					$Text 		= get_post_meta( get_the_ID(), 'customer_text', true );
	                $Name 		= get_post_meta( get_the_ID(), 'customer_name', true );
	                $Position 	= get_post_meta( get_the_ID(), 'customer_position', true );                
	                $Photo_id 	= get_post_meta( get_the_ID(), 'customer_photo', true );

	                // Set active tab
	                $active_class = '';
					if( $i == 0 ){
						$active_class = "active";
					}

					if( $i % $number_of_item == 0 ){
						$output .=
						'<div class="item '.esc_attr($active_class).'">
							<div class="row">';
					}
								$output .=
								'<div class="col-xs-12 col-sm-4 col-md-4 client-testimonial-1">
									<div class="client-testimonial-1-inner background-color-white">
										<div class="client-testimonial-1-image">';
											// Customer image
											$full_image = wp_get_attachment_image_src( $Photo_id, "full" );
											$output .= '<img src="'.esc_attr($full_image[0]).'" alt="'.esc_attr($Name).'">
										</div>
										<h3 class="client-testimonial-1-name">'.sprintf( esc_html__( '%s', 'cityestate' ), $Name ).'</h3>
										<h4 class="client-testimonial-1-post">'.sprintf( esc_html__( '%s', 'cityestate' ), $Position ).'</h4>
										<p class="cleint-testimonial-1-detail">'.sprintf( esc_html__( '%s', 'cityestate' ), $Text ).'</p>
									</div>
								</div>';
						if( $i % $number_of_item == $number_of_item-1 ){
								$output .=
								'</div>
							</div>';
						}
						$i++;
					endwhile;
					$i--;
					
					if( $i % $number_of_item != $number_of_item-1 ){
							$output .=
							'</div>
						</div>';
					}
				$output .=
				'</div>
			</div>';
		} else if( $list_style == 1 ){
			$output .=
			'<div id="carousel-client-testimonial-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.'>
				<ol class="carousel-indicators bottom-side">';
					// Set customer counter
					$i = 0;
					$counter = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
						// Active first slide of customer
						$active_class = '';
						if( $i % $number_of_item == 0 ){
							if( $i == 0 ){						
								$output .= '<li data-target="#carousel-client-testimonial-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
							} else {
								$output .= '<li data-target="#carousel-client-testimonial-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
							}
							$counter++;
						}
						$i++;
					endwhile;
				$output .=
				'</ol>

				<div class="carousel-inner" role="listbox">';
					$i = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
					
					// Get detail of customer
					$Text 		= get_post_meta( get_the_ID(), 'customer_text', true );
	                $Name 		= get_post_meta( get_the_ID(), 'customer_name', true );
	                $Position 	= get_post_meta( get_the_ID(), 'customer_position', true );                
	                $Photo_id 	= get_post_meta( get_the_ID(), 'customer_photo', true );

	                // Active the first tab of customer
	                $active_class = '';
					if( $i == 0 ){
						$active_class = "active";
					}

					if( $i % $number_of_item == 0 ){
						$output .=
						'<div class="item '.esc_attr($active_class).'">
							<div class="row">';
					}
								$output .=
								'<div class="col-xs-12 col-sm-4 col-md-4 client-testimonial-2">
									<div class="client-testimonial-2-inner background-color-white">
										<p class="cleint-testimonial-1-detail">'.sprintf( esc_html__( '%s', 'cityestate' ), $Text ).'</p>
									</div>
									<div class="vertical-space-5"></div>
									<div class="media">
										<div class="media-left">';
											// Customer image
											$full_image = wp_get_attachment_image_src( $Photo_id, "full" );
											$output .= '<img src="'.esc_attr($full_image[0]).'" alt="'.esc_attr($Name).'">
										</div>
										<div class="media-body">
											<h3 class="client-testimonial-2-name">'.sprintf( esc_html__( '%s', 'cityestate' ), $Name ).'</h3>
											<h4 class="client-testimonial-2-post">'.sprintf( esc_html__( '%s', 'cityestate' ), $Position ).'</h4>
										</div>
									</div>
								</div>';
						if( $i % $number_of_item == $number_of_item-1 ){
								$output .=
								'</div>
							</div>';
						}
						$i++;
					endwhile;
					$i--;
					
					if( $i % $number_of_item != $number_of_item-1 ){
							$output .=
							'</div>
						</div>';
					}
				$output .=		
				'</div>
			</div>';			
		} else if( $list_style == 2 ){
			// Number of customer per page
			$number_of_item = 2;

			$output .=
			'<div class="client-testimonial-3">
				<div id="carousel-recent-properties-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.' >			
					<ol class="carousel-indicators bottom-side">';
						// Define customer counter
						$i = 0;				
						$counter = 0;
						while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
							// Set active slide of customer
							$active_class = '';
							if( $i % $number_of_item == 0 ){
								if( $i == 0 ){						
									$output .= '<li data-target="#carousel-recent-properties-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
								} else {
									$output .= '<li data-target="#carousel-recent-properties-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
								}
								$counter++;
							}					
							$i++;
						endwhile;
					$output .=				
					'</ol>

					<div class="carousel-inner" role="listbox">';				
						$i = 0;
						while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
						
						// Customer detail
						$Text 		= get_post_meta( get_the_ID(), 'customer_text', true );
		                $Name 		= get_post_meta( get_the_ID(), 'customer_name', true );
		                $Position 	= get_post_meta( get_the_ID(), 'customer_position', true );                
		                $Photo_id 	= get_post_meta( get_the_ID(), 'customer_photo', true );

		                $active_class = '';
						if( $i == 0 ){
							$active_class = "active";
						}

						if( $i % $number_of_item == 0 ){
							$output .=
							'<div class="item '.esc_attr($active_class).'">
								<div class="row row-eq-height">';
						}
									$output .=
									'<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="client-testimonial-3-inner">
											<div class="media">
												<div class="media-left">';
													// Customer image
													$full_image = wp_get_attachment_image_src( $Photo_id, "full" );
													$output .= '<img src="'.esc_attr($full_image[0]).'" alt="'.esc_attr($Name).'">
												</div>
												<div class="media-body media-middle">
													<h4 class="media-heading">'.sprintf( esc_html__( '%s', 'cityestate' ), $Name ).'</h4>
													<h6>'.sprintf( esc_html__( '%s', 'cityestate' ), $Position ).'</h6>
												</div>
											</div>
											<p>'.sprintf( esc_html__( '%s', 'cityestate' ), $Text ).'</p>
										</div>
									</div>';
							if( $i % $number_of_item == $number_of_item-1 ){
									$output .=
									'</div>
								</div>';
							}
							$i++;
						endwhile;
						$i--;
						
						if( $i % $number_of_item != $number_of_item-1 ){
								$output .=
								'</div>
							</div>';
						}
					$output .=
					'</div>
				</div>
			</div>';
		}
	endif;
	return $output;
}
add_shortcode( 'testimonials', 'cityestate_testimonials' );

?>