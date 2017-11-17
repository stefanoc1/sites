<?php 

// Latest posts widget
class Cityestate_latest_posts extends WP_Widget {
	// Define construct
	function __construct(){
		$params = array( 'description' => esc_html__( 'Display Latest Posts', 'cityestate' ) , 'name' => esc_html__( 'Cityestate: Latest Posts', 'cityestate' ) );
		parent::__construct('cityestate_latest_posts', '', $params);
	}

	public function form($instance){
		// Widget form
		extract($instance); ?>		
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ) ?>"><?php esc_html_e( 'Title:', 'cityestate' ); ?></label><input	type="text"	class="widefat"	id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('number_of_posts') ) ?>"><?php esc_html_e( 'Number of Posts:', 'cityestate' ); ?></label><input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('number_of_posts') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number_of_posts') ); ?>" value="<?php if( isset($number_of_posts) ) echo esc_attr($number_of_posts); ?>" /></p><?php
	}

	public function widget($args, $instance){

		extract($args);
		extract($instance);

		// Get widget title
		$title = apply_filters( 'widget_title', $instance['title'] );

		$widget_title 	= apply_filters( 'widget_title', $instance['title'] );
		//$items_number 	= $instance['items_number'];

		// Check title is set
		if( !isset($title) ) 
			$title= esc_html__( 'Latest Posts', 'cityestate' );

		// Number of posts
		if( !isset($number_of_posts) ) 
			$number_of_posts = 5;
		
		echo '<div class="widget widget-property-status blog_info blog-thumbnail">';

		// Check title is set
		if( !empty($title) )
			echo $before_title.esc_html($title).$after_title;

		// Get latest post
		$wpbp = new WP_Query( array( 'post_type' => 'post', 'paged' => 1, 'posts_per_page' => $number_of_posts, 'order' => 'DESC' ) );
		
		$temp_out = "";
		
		global $post;
		if( $wpbp->have_posts() ) : ?>
			<div class="widget-body">
				<?php while( $wpbp->have_posts() ) : $wpbp->the_post(); 
					// Get post image
					$image_id = get_post_thumbnail_id( $post->ID );
					$url = wp_get_attachment_thumb_url( $image_id ); ?>
					<div class="footer-recent-img">
						<div class="left pull-left">
							<!-- Post image -->
							<img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($post->post_title); ?>" />
						</div>
						<div class="right footer-recent-title">
							<!-- Post link and title -->
							<p><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></p>
						</div>
					</div><?php
				endwhile; ?>
			</div>			
		<?php endif;
		
		echo '</div>';
		
		wp_reset_postdata();
	} 
}

if( ! function_exists( 'register_cityestate_latest_posts' ) ){
    // Call latest post widget
    function register_cityestate_latest_posts(){
    	register_widget( 'Cityestate_latest_posts' );
    }
    add_action( 'widgets_init', 'register_cityestate_latest_posts' );
}