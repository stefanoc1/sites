<?php global $tab_class; ?>
<!-- Similar property -->
<div id="similar_properties" class="similar_property property-detail-section <?php echo esc_attr($tab_class); ?>">
  	<!-- Similar property section title -->
  	<h3 class="title"><?php esc_html_e( 'Similar Properties','cityestate' ); ?></h3><?php
  	// Get number of property to show
  	$number_of_property = cityestate_option( 'property_page_similar' );
  	
  	// Get property type
  	$property_type 		= wp_get_object_terms( $post->ID, 'property_type', array('fields' => 'ids') );
	
	// Get property status
	$property_status 	= wp_get_object_terms( $post->ID, 'property_status', array('fields' => 'ids') );

	// Collect similar property query
	$args = array( 'post_type' => 'property', 'post_status' => 'publish', 'posts_per_page' => $number_of_property, 'orderby' => 'rand', 'tax_query' => array( 'relation' => 'OR', array( 'taxonomy' => 'property_type', 'field' => 'id', 'terms' => $property_type ), array( 'taxonomy' => 'property_status', 'field' => 'id', 'terms' => $property_status ), ), 'post__not_in' => array($post->ID) );
	$cityestate_query = new WP_Query( $args );
	
	// Number of property show in one row
	$number_of_item = 2;

	$token = wp_generate_password(7, false, false);
	
	// Check have property found
	if( $cityestate_query->have_posts() ) : ?>
		<div id="carousel-recent-properties-<?php echo esc_attr($token); ?>" class="carousel slide similar_property" data-ride="carousel">
			<ol class="carousel-indicators"><?php
				// Set property counter
				$i = $counter = 0;
				while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
					$active_class = '';
					if( $i % $number_of_item == 0 ){
						// Add slider indicator
						if( $i == 0 ){						
							echo '<li data-target="#carousel-recent-properties-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'" class="active"></li>';
						} else {
							echo '<li data-target="#carousel-recent-properties-'.esc_attr($token).'" data-slide-to="'.esc_attr($counter).'"></li>';
						}
						$counter++;
					}	
					$i++;
				endwhile; ?>
			</ol>

			<div class="carousel-inner" role="listbox"><?php
				$i = 0;
				
				while( $cityestate_query->have_posts() ) : $cityestate_query->the_post();
				
				// Define active class				
				$active_class = '';				
				if( $i == 0 ){
					$active_class = "active";
				}								

				if( $i % $number_of_item == 0 ){ ?>
					<div class="item <?php echo esc_attr($active_class); ?>">
						<div class="row"><?php
				} ?>					
							<div class="col-xs-12 col-sm-6 col-md-6 recent-property-box1">
								<div class="recent-proeprty-box1-img-box"><?php
									// Show thumbnail image
									if( has_post_thumbnail() ){
										the_post_thumbnail( 'cityestate_property_thumb' );
									} else {
										// Show property default image
										cityestate_image_placeholder( 'cityestate_property_thumb' );
									}
									// Property featured label
									echo include( get_template_directory() . '/template-parts/property_featured_label.php');
									// Property status label
									echo include( get_template_directory() . '/template-parts/property_status_label.php'); ?>
								</div>
								<div class="recent-proeprty-box1-inner">
									<!-- Property link -->
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<h3 class="property-box1-title">
											<!-- Property title -->
											<?php the_title(); ?>
										</h3>
									</a>
									<!-- Property location -->
									<?php echo include( get_template_directory() . '/template-parts/property_location_info.php'); ?>
									<ul class="property-basic-info">
										<!-- Property basic detail -->
										<?php echo cityestate_basic_info(); ?>
									</ul>
								</div>
								<div class="recent-proeprty-box1-price-info">
									<!-- Property price -->
									<?php echo cityestate_get_property_price();
									// Check property submit by user
									$property_submit_by_user = cityestate_option('property_submit_by_user');
									if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
										// Property favorite
										echo include( get_template_directory() . '/template-parts/property_favorite.php');
									} ?>
								</div>
							</div><?php
					if( $i % $number_of_item == $number_of_item-1 ){ ?>						
							</div>
						</div><?php
					}
					// Increase property counter 
					$i++;
				endwhile;
				$i--;				
				if( $i % $number_of_item != $number_of_item-1 ){ ?>
						</div>
					</div><?php
				} ?>				
			</div>
		</div><?php
	endif;
	// Reset wp query
	wp_reset_postdata(); ?>
</div>