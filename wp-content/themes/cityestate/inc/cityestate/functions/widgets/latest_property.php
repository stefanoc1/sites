<?php

// Latest property widget
class cityestate_latest_properties extends WP_Widget {
	
	// Define construct
	public function __construct(){
		
		parent::__construct(
	 		'cityestate_latest_properties',
			esc_html__( 'Cityestate: Latest Properties', 'cityestate' ),
			array( 'description' => esc_html__( 'Show latest properties', 'cityestate' ), )
		);
		
	}

	
	public function widget( $args, $instance ){
		// Define global variable
		global $before_title, $after_title;
		extract( $args );

		// Get widget title
		$title = apply_filters( 'widget_title', $instance['title'] );

		$widget_title 	= apply_filters( 'widget_title', $instance['title'] );
		$items_number 	= $instance['items_number'];
			
	    echo '<div class="widget widget-property-status blog_info blog-thumbnail">';

		// Check widget title is set
		if( !empty($widget_title) )
			echo $before_title.esc_html($widget_title).$after_title;

		// Call latest property query
		$latest_post = new WP_Query( array( 'post_type' => 'property', 'posts_per_page' => $items_number, 'order' => 'DESC', 'ignore_sticky_posts' => 1, 'post_status' => 'publish' ) );
		if( $latest_post->have_posts() ) : ?>				
			<div class="widget-body">
				<ul class="archieves"><?php
					while( $latest_post->have_posts()) : $latest_post->the_post(); ?>
						<li>
							<div class="col-md-4 padding_none">
								<div class="blogimage_thumbnail"><?php
									// Property thumbnail
									if( has_post_thumbnail() ){
										the_post_thumbnail('cityestate_property_small');								
									} else {
										// Default Property image
										cityestate_image_placeholder('cityestate_property_small');
									} ?>
								</div>
							</div>
							<div class="col-md-8">
								<div class="blogimagedescription">
									<h3 class="recentposttitle">
										<!-- Property title -->
										<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
									</h3>
									<span class="tagtext"><?php $property_address = get_post_meta( get_the_ID(), 'property_address', true ); printf( esc_html__( '%s', 'cityestate' ), $property_address ); ?></span>
									<span class="price"><?php
									// Get property price
									$first_price         = get_post_meta( get_the_ID(), 'property_price', true );
							        $second_price       = get_post_meta( get_the_ID(), 'property_second_price', true );
							        $price_postfix      = get_post_meta( get_the_ID(), 'property_price_postfix', true );

							        // Check first price is set
							        if( !empty($first_price) ){
							        	// Price pstfix
							            if( !empty($price_postfix) ){
							                $price_postfix = '&#47;' . $price_postfix;
							            }
							            // Check first and second price is set
							            if( !empty($first_price) && !empty($second_price) ){
							            	// Get property filter price
							                echo cityestate_filter_property_price($first_price);
							                // Check second price
							                if( !empty($second_price) ){
							                    echo '<span class="tagtext"> ';
							                    echo cityestate_filter_property_price($second_price) . $price_postfix;
							                    echo '</span>';
							                }                
							            } else {
							            	// Check first price
							                if( !empty( $first_price ) ){
							                    echo cityestate_filter_property_price($first_price) . $price_postfix;								                    
							                }
							            }
							        } ?>	
							        </span>									
								</div>
							</div>
						</li><?php
					endwhile; ?>										
				</ul>
			</div><?php				
		endif; 
		wp_reset_postdata(); ?>
		</div><?php
	}	
	
	public function update( $new_instance, $old_instance ){
		// Update widget form
		$instance = array();
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['items_number'] 	= strip_tags( $new_instance['items_number'] );
		return $instance;		
	}	
	
	public function form( $instance ){
		// Get form data
		$defaults = array( 'title' => esc_html__( 'Latest Properties', 'cityestate' ), 'items_number' => '4', );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'cityestate' ); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'items_number' ) ); ?>"><?php esc_html_e( 'Maximum posts to show:', 'cityestate' ); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'items_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'items_number' ) ); ?>" value="<?php echo esc_attr( $instance['items_number'] ); ?>" size="1" />
		</p><?php
	}

}

if( ! function_exists( 'cityestate_latest_properties_loader' ) ){
    // Call latest property widget
    function cityestate_latest_properties_loader(){
    	register_widget( 'cityestate_latest_properties' );
    }

    add_action( 'widgets_init', 'cityestate_latest_properties_loader' );

}