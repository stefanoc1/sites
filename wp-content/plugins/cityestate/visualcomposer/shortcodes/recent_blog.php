<?php

// Cityestate recent blog shortcode
function cityestate_recent_blog( $atts, $content = null ){	
	global $post;

	// Extract recent blog values
	extract( shortcode_atts( array(
		'posts_limit'		=> '',
		'category'			=> '',
		'sort'				=> '',
		'order'				=> '',
		'offset'			=> '',
		'list_style'		=> '0',
		'slider_infinite'	=> '',
		'slider_auto'		=> '',
		'slider_auto_speed'	=> '5000',
	), $atts ) );

	// Merge the content
	ob_start();

	// Recent blog slider setting
	$slider_setting  = '';
	$slider_setting .= ' data-wrap="'.$slider_infinite.'"';
	$slider_setting .= ' data-ride="'.$slider_auto.'"';	
	$slider_setting .= ' data-interval="'.$slider_auto_speed.'"';
	
	// Get the recent blog using query
	$args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'numberposts'       => $posts_limit,
        'category'          => $category,
        'orderby'           => $sort,
        'order'             => $order,
        'offset'			=> $offset,
        'suppress_filters'  => 0
    );

	// Recent post results in object
    $recent_posts = wp_get_recent_posts( $args );	

    $output = '';

    // Show recent blog per page
    $number_of_item = 2;

    // Check recent blog is found as per filter
	if( $recent_posts ) :
		// Generate unique id for recent blog slider
		$token = wp_generate_password(7, false, false);

		// For recent blog style one
		if( $list_style == 0 ){
			$output .=
			'<div id="property-carousel-'.esc_attr($token).'" class="carousel slide" '.$slider_setting.' >
				<ol class="carousel-indicators">';
					// Recent blog counter
					$i = 0;
					$counter = 0;
					foreach( $recent_posts as $recent ){
						// Set active class for recent blog
						$active_class = '';
						if( $i % $number_of_item == 0 ){
							if( $i == 0 ){						
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
							} else {
								$output .= '<li data-target="#property-carousel-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
							}
							$counter++;
						}	
						$i++;
					}
				$output .=
				'</ol>

				<div class="carousel-inner" role="listbox">';
					$i = 0;
					foreach( $recent_posts as $recent ){					
					
					// set active tab
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
								'<div class="col-xs-12 col-sm-6 col-md-6 recent-post-box1">
									<div class="recent-post-box1-image">';
										// Recent blog image
										$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), "cityestate_property_thumb" );
										if( !empty($post_thumbnail) ){
											$output .= '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.esc_attr($recent["post_title"]).'" />';
										} else {
											$output .= cityestate_image_placeholder('cityestate_property_thumb');
										}
										$output .= '<div class="image-overley"></div>
									</div>
									<div class="recent-post-box1-content">
										<h3 class="recent-post-box1-heading">'.sprintf( esc_html__( '%s', 'cityestate' ), $recent["post_title"] ).'</h3>';
										// Blog read more text and link
										$blog_readmore_text = cityestate_option('blog_readmore_text');
										$output .= '<a href="'.esc_url( get_permalink($recent["ID"]) ).'" class="recent-post-box1-readmore red_url">'.sprintf( esc_html__( '%s', 'cityestate'), $blog_readmore_text ).'</a>
									</div>
								</div>';
						if( $i % $number_of_item == $number_of_item-1 ){
								$output .=
								'</div>
							</div>';
						}
						$i++;
					}
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

			foreach( $recent_posts as $recent ){
				$output .=
				'<div class="col-xs-12 col-sm-4 col-md-4 recent-post-box2">
					<div class="recent-post-box2-image">';
						// Recen blog photo
						$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), "cityestate_property_thumb" );
						if( !empty($post_thumbnail) ){
							$output .= '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.esc_attr($recent["post_title"]).'" />';
						} else {
							$output .= cityestate_image_placeholder('cityestate_property_thumb');
						}
					$output .=
					'</div>
					<div class="recent-post-box2-content">
						<h3 class="recent-post-box2-heading">'.sprintf( esc_html__( '%s', 'cityestate' ), $recent["post_title"] ).'</h3>';
							// Recent blog date
							$archive_year  = get_the_time('Y',$recent["ID"]); 
							$archive_month = get_the_time('m',$recent["ID"]); 
							$archive_day   = get_the_time('d',$recent["ID"]);
							
							// Recent blog date link
							$output .=
							'<a href="'.esc_url(get_day_link( $archive_year, $archive_month, $archive_day)).'" class="recent-post-box2-url">
								'.get_the_time( get_option( 'date_format' ), $post->ID ).'
							</a>
							<a href="'.get_author_posts_url( $recent["post_author"] ).'" class="recent-post-box2-url">'.get_the_author().'</a>
						<p class="recent-post-box2-detail">'.sprintf( esc_html__( '%s', 'cityestate' ), $recent["post_excerpt"] ).'</p>';
						// Blog read more text and link
						$blog_readmore_text = cityestate_option('blog_readmore_text');
						$output .= '<a href="'.esc_url( get_permalink($recent["ID"]) ).'" class="recent-post-box2-readmore grey_url red_arrow">'.sprintf( esc_html__( '%s', 'cityestate'), $blog_readmore_text ).'</a>
					</div>
				</div>';				
			}
		}
	endif;

	return $output;
	
}
add_shortcode( 'cityestate_recent_blog', 'cityestate_recent_blog' );

?>