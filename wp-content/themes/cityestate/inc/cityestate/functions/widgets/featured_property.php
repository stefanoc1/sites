<?php

// Featured property widget
class cityestate_featured_properties extends WP_Widget {
	
	// Register widget
	public function __construct(){
		// Define construct
		parent::__construct(
	 		'cityestate_featured_properties',
			esc_html__( 'Cityestate: Featured Properties', 'cityestate' ),
			array( 'description' => esc_html__( 'Show featured properties', 'cityestate' ), )
		);
		
	}

	
	public function widget( $args, $instance ){
		// Define global variable
		global $before_title, $after_title, $post;
		extract( $args );

		// Apply widget title
		$title = apply_filters( 'widget_title', $instance['title'] );

		$widget_title = apply_filters( 'widget_title', $instance['title'] );
		$items_number = $instance['items_number'];		

		echo '<div class="property-featured-slider-sidebar widget">';
		
		// Widget title
		if( !empty($title) )
            echo $before_title.esc_html($title).$after_title;

        // Get feature property query
		$wp_query = new WP_Query( array( 'post_type' => 'property', 'posts_per_page' => $items_number, 'meta_key' => 'featured', 'meta_value' => '1', 'ignore_sticky_posts' => 1, 'post_status' => 'publish' ) );

		if( $wp_query->have_posts() ) :
			// Get slider id
			$token = wp_generate_password(7, false, false); ?>
			<div id="carousel-recent-<?php echo esc_attr($token); ?>" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators"><?php				
					$i = 0;
					// Slider indicator
					while( $wp_query->have_posts() ) : $wp_query->the_post();							
						if( $i == 0 ){
							echo '<li data-target="#carousel-recent-'.esc_attr($token).'" data-slide-to="'.esc_attr($i).'" class="active"></li>';
						} else {
							echo '<li data-target="#carousel-recent-'.esc_attr($token).'" data-slide-to="'.esc_attr($i).'"></li>';
						}
						$i++;
					endwhile; ?>
				</ol>

				<div class="carousel-inner" role="listbox"><?php
					$i = 0;
					while( $wp_query->have_posts()) : $wp_query->the_post(); ?>
						<div class="item <?php if( $i == 0 ){ echo 'active'; } ?>">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 recent-property-box1 featured-properties-widget">
									<div class="recent-proeprty-box1-img-box"><?php
										// Property thumbnail
										if( has_post_thumbnail() ){
											the_post_thumbnail('cityestate_property_thumb');								
										} else {
											// Default property thumbnail
											cityestate_image_placeholder('cityestate_property_thumb');
										}
										// Property featured label
										echo include( get_template_directory() . '/template-parts/property_featured_label.php' );

										// Property status label
										echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
									</div>
									<div class="recent-proeprty-box1-inner">
										<a href="<?php echo esc_url( get_permalink() ); ?>">
											<h3 class="property-box1-title">
												<!-- Property title -->
												<?php the_title(); ?>
											</h3>
										</a>
										<!-- Property location -->
										<?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>
										<ul class="property-basic-info">
											<!-- Property basic info -->
											<?php echo cityestate_basic_info(); ?>
										</ul>
									</div>
									<div class="recent-proeprty-box1-price-info">
										<!-- Property price -->
										<?php echo cityestate_get_property_price();																					
										// Property submit by user
										$property_submit_by_user = cityestate_option( 'property_submit_by_user' );
										if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
											// Property favorite option
											echo include( get_template_directory() . '/template-parts/property_favorite.php' );
										} ?>
									</div>
								</div>
							</div>
						</div><?php
				$i++;
				endwhile; ?>				
				</div>			
		</div><?php
		endif; ?>
		</div><?php
		// Reset wp query
		wp_reset_postdata();
	}
	
	public function update( $new_instance, $old_instance ){		
		$instance = array();
		// Update widget form
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['items_number'] 	= strip_tags( $new_instance['items_number'] );
		return $instance;		
	}	
	
	// Backend widget form
	public function form( $instance ){
		// Widget form
		$defaults = array( 'title' => esc_html__( 'Featured Properties', 'cityestate' ), 'items_number' => '3' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cityestate' ); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items_number' ) ); ?>"><?php esc_html_e( 'Maximum posts to show:', 'cityestate' ); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'items_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'items_number' ) ); ?>" value="<?php echo esc_attr( $instance['items_number'] ); ?>" size="1" />
		</p><?php
	}
}

if( ! function_exists( 'cityestate_featured_properties_loader' ) ){
    // Call featured property widget
    function cityestate_featured_properties_loader (){
    	register_widget( 'cityestate_featured_properties' );
    }
    
    add_action( 'widgets_init', 'cityestate_featured_properties_loader' );

}