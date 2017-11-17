<?php
// Cityestate property carousel shortcode
function cityestate_properties_carousel( $atts, $content = null ){	
	// Extract property carousel value
	extract( shortcode_atts( array(
		'property_type'			=> '',
		'property_status'		=> '',
		'property_city'			=> '',
		'property_area'			=> '',
		'property_location'		=> '',
		'property_label'		=> '',
		'featured_property'		=> '',
		'property_id'			=> '',
		'posts_limit'			=> '',
		'offset'				=> '',
		'property_list_style'	=> '',
		'number_of_item'		=> '6',
		'slider_infinite'		=> '',
		'slider_auto'			=> '',
		'slider_auto_speed'		=> '5000',
		'slider_description_border' => 'true',
 	), $atts ) );	

	ob_start();

	global $post;

	// Set slider setting
	$slider_setting  = '';
	$slider_setting .= ' data-wrap="'.$slider_infinite.'"';
	$slider_setting .= ' data-ride="'.$slider_auto.'"';	
	$slider_setting .= ' data-interval="'.$slider_auto_speed.'"';
	
	// Get the property as per filter
	$cityestate_query = cityestate_slider_property::get_wp_query($atts);

	$output = '';

	$border_class="";
	if($slider_description_border == "false") {
		$border_class = "border_none";
	}
	// If have property find
	if( $cityestate_query->have_posts() ) :
		// Generate unique id for slider
		$token = wp_generate_password(7, false, false);
		// Proerty slider for style one
		if( $property_list_style == 0 ){
			// Property slider start
			$output .= '<div id="property-carousel-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.'>
				<ol class="carousel-indicators">';
					// Counter of slider for active page
					$i = 0;
					$counter = 0;

					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
						$active_class = '';
						if( $i % $number_of_item == 0 ){
							// Set active page
							if( $i == 0 ){						
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
							} else {
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
							}
							$counter++;
						}	
						$i++;
					endwhile;
				$output .= '</ol>
				
				<div class="carousel-inner" role="listbox">';
					$i = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
					
					global $post;

					// Set active class
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
								'<div class="col-xs-12 col-sm-4 col-md-4 recent-property-box1">
									<div class="recent-proeprty-box1-img-box">';
										// Property image
										$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "cityestate_property_thumb" );
										if( !empty($post_thumbnail) ){
											$output .= '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.esc_attr($post->post_title).'" />';
										} else {
											$output .= cityestate_image_placeholder('cityestate_property_thumb');
										}
										// Property featured label
										$output .= include( get_template_directory() . '/template-parts/property_featured_label.php' );
										// Property status label
										$output .= include( get_template_directory() . '/template-parts/property_status_label.php' );
									$output .=
									'</div>
									<div class="recent-proeprty-box1-inner '.$border_class.'">
										<a href="'.esc_url( get_permalink() ).'">
											<h3 class="property-box1-title">
												'.sprintf( esc_html__( '%s', 'cityestate' ), get_the_title($post->ID) ).'
											</h3>
										</a>';
										// Property location detail
										$output .= include( get_template_directory() . '/template-parts/property_location_info.php' );
										// Property basic detail
										$output .= '<ul class="property-basic-info">';
											$output .= cityestate_basic_info();
										$output .= '</ul>
									</div>
									<div class="recent-proeprty-box1-price-info '.$border_class.'">';
										// Property favorite option
										$output .= cityestate_get_property_price();
										$frontend_submission = cityestate_option('property_submit_by_user');
										if( isset( $frontend_submission ) && $frontend_submission != "no" ){
											$output .= include( get_template_directory() . '/template-parts/property_favorite.php' );
										}
									$output .=
									'</div>
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
		} else if( $property_list_style == 1 ){
			$output .= '
			<div id="property-carousel-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.'>
				<ol class="carousel-indicators">';
					// Counter of slider for active page
					$i = 0;
					$counter = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
						$active_class = '';
						if( $i % $number_of_item == 0 ){
							// Set active page
							if( $i == 0 ){						
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
							} else {
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
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
					// Set active class
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
								'<div class="col-xs-12 col-sm-4 col-md-4 featured-property-box1">
									<div class="featured-property-box1-inner">';
										// Property image
										$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "cityestate_property_thumb" );
										if( !empty($post_thumbnail) ){
											$output .= '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.esc_attr($post->post_title).'" />';
										} else {
											$output .= cityestate_image_placeholder('cityestate_property_thumb');
										}
										$output .=									
										'<div class="featured-property-box1-overley">';
											// Property featured label
											$output .= include( get_template_directory() . '/template-parts/property_featured_label.php' );
											// Horizontal space
											$output .= '<div class="vertical-space-90"></div>';											
											$output .= '<div class="featured-property-box1-info">
												<a href="'.get_the_permalink().'"><h4 class="property-box1-title">'.sprintf( esc_html__( '%s', 'cityestate' ), get_the_title($post->ID) ).'</h4></a>';
												// Property price
												$output .= cityestate_get_property_price( 'featured_list' );
												
												// Property status label
												$output .= include( get_template_directory() . '/template-parts/property_status_label.php' );
												$output .= '<div class="horizontal-line"></div>';
												
												// Property location detail
												$output .= include( get_template_directory() . '/template-parts/property_location_info.php' );
												
												// Property favorite option
												$frontend_submission = cityestate_option('property_submit_by_user');
												if( isset( $frontend_submission ) && $frontend_submission != "no" ){
													$output .= include( get_template_directory() . '/template-parts/property_favorite.php' );
												}
											$output .=
											'</div>
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
		} else if( $property_list_style == 2 ){
			$output .= '<div id="property-carousel-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.'>
				<ol class="carousel-indicators bottom-side">';
					// Proprty counter
					$i = 0;
					$counter = 0;
					while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
						$active_class = '';
						// Set active page
						if( $i % $number_of_item == 0 ){
							if( $i == 0 ){						
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
							} else {
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
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
								'<div class="col-xs-12 col-sm-4 col-md-4 recent-property-box1">
									<div class="recent-proeprty-box1-img-box">';
										// Property image
										$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "cityestate_property_thumb" );
										if( !empty($post_thumbnail) ){
											$output .= '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.esc_attr($post->post_title).'" />';
										} else {
											$output .= cityestate_image_placeholder('cityestate_property_thumb');
										}

										// Property featured label
										$output .= include( get_template_directory() . '/template-parts/property_featured_label.php' );

										// Property status label
										$output .= include( get_template_directory() . '/template-parts/property_status_label.php' );
									$output .=
									'</div>
									<div class="recent-proeprty-box1-inner '.$border_class.'">
										<a href="'.esc_url( get_permalink() ).'">
											<h3 class="property-box1-title">'.sprintf( esc_html__( '%s', 'cityestate' ), get_the_title($post->ID) ).'</h3>
										</a>';
										
										// Property location detail
										$output .= include( get_template_directory() . '/template-parts/property_location_info.php' );

										// Property basic detail
										$output .= '<ul class="property-basic-info">';
											$output .= cityestate_basic_info();
										$output .= '</ul>
									</div>
									<div class="recent-proeprty-box1-price-info  '.$border_class.'">';
										// Property price
										$output .= cityestate_get_property_price();
										
										// Property favorite option
										$frontend_submission = cityestate_option('property_submit_by_user');
										if( isset( $frontend_submission ) && $frontend_submission != "no" ){
											$output .= include( get_template_directory() . '/template-parts/property_favorite.php' );
										}
									$output .=
									'</div>
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
		}
	endif;

	return $output;
}
add_shortcode( 'cityestate_carousel', 'cityestate_properties_carousel' );

// Get property for slider with filter
class cityestate_slider_property {

	static $fake_loop_offset = 0;

    static function cityestate_slider_args( $atts = '', $paged = '' ){
    	// Extract property filter values
        extract( shortcode_atts( array(
            'property_type'         => '',
            'property_status'       => '',
            'property_city'         => '',
            'property_area'         => '',            
            'property_location'     => '',
            'property_label'        => '',
            'featured_property'     => '',
            'property_ids'          => '',
            'posts_limit'           => '',
            'offset'                => '',
        ), $atts ) );

        // Declare taxonomy query
        $tax_query = array();        

        // Ignore sticky property
        $query_args = array(
            'ignore_sticky_posts' => 1
        );        
        
        // Filter property as property area taxonomy
        if( !empty($property_area) ){
            $tax_query[] = array(
                'taxonomy'  => 'property_area',
                'field'     => 'id',
                'terms'     => $property_area
            );
        }

        // Filter property as property stauts taxonomy
        if( !empty($property_status) ){
            $tax_query[] = array(
	            'taxonomy'  => 'property_status',
	            'field'     => 'id',
	            'terms'     => $property_status
	        );
        }

        // Filter property as property location taxonomy
        if( !empty($property_location) ){
            $tax_query[] = array(
                'taxonomy'  => 'property_location',
                'field'     => 'id',
                'terms'     => $property_location
            );
        }

        // Filter property as property label taxonomy
        if( !empty($property_label) ){
            $tax_query[] = array(
                'taxonomy'  => 'property_label',
                'field'     => 'id',
                'terms'     => $property_label
            );
        }

        // Filter property as property type taxonomy
        if( !empty($property_type) ){
            $tax_query[] = array(
                'taxonomy'  => 'property_type',
                'field'     => 'id',
                'terms'     => $property_type
            );
        }

        // Filter property as property city taxonomy
        if( !empty($property_city) ){
            $tax_query[] = array(
                'taxonomy'  => 'property_city',
                'field'     => 'id',
                'terms'     => $property_city
            );
        }                

        // Explode property ids
        $property_id = explode(',', $property_ids);

        // Check property id is not empty
        if( !empty($property_ids) ){
            $query_args['post__in'] = $property_id;
        }

        // Checl how many property found
        $tax_count = count( $tax_query );        

        // Set taxonomy relation
        if( $tax_count > 1 ){
            $tax_query['relation'] = 'AND';
        }
        if( $tax_count > 0 ){
            $query_args['tax_query'] = $tax_query;
        }

        // Check featured property is empty or not
        if( !empty($featured_property) ){            
            if( $featured_property == "yes" ){
                $query_args['meta_key'] = 'featured';
                $query_args['meta_value'] = '1';
            } else {
                $query_args['meta_key'] = 'featured';
                $query_args['meta_value'] = '0';
            }
        }

        // Set property per page
        if( empty($posts_limit) ){
            $posts_limit = get_option('posts_per_page');
        }
        $query_args['posts_per_page'] = $posts_limit;

        // Get property which is status is publish
        $query_args['post_status'] = 'publish';

        // Set pagination for property
        if( !empty($paged) ){
            $query_args['paged'] = $paged;
        } else {
            $query_args['paged'] = 1;
        }

        // Set property offset
        if( !empty($offset) and $paged > 1 ){
            $query_args['offset'] = $offset + ( ($paged - 1) * $posts_limit );
        } else {
            $query_args['offset'] = $offset;
        }        

        // Finally set post type
        $query_args['post_type'] = 'property';

        return $query_args;
    }

	static function &get_wp_query( $atts = '', $page = '' ){
    	// Get property as per property filter arguments
        $args = self::cityestate_slider_args($atts, $page);        
        // Call the wordpress query for get property
        $cityestate_query = new WP_Query($args);        
        return $cityestate_query;
    }
}

?>