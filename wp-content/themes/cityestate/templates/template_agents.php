<?php
/*
	Template Name: Agents List
*/

get_header();

// Declare theme labels
global $theme_labels;

// Define variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Set page sidebar
$sidebar_pos 	= get_post_meta( $post->ID, 'sidebar_position' , true);
$sidebar_type	= get_post_meta( $post->ID, 'page_sidebar' , true);
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false; ?>

<section id="main-content" class="container">
	<div class="vertical-space-80"></div><?php
	// Left sidebar
	if( ('left' == $sidebar_pos) ){ ?>
		<aside class="col-md-4 col-sm-12 sidebar leftside" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic left sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php }

	// Check have sidebar
	if( $have_sidebar ){ ?>
		<section class="col-md-8 cntt-w">
			<article><?php 
	}

	echo '<div class="row-wrapper-x">';
		global $wp_query, $paged;

		// Check is front page
	    if( is_front_page() ){
	        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
	    } ?>
	    <div class="agent-list"><?php
	    	// Get agent per page
	        $list_agent_per_page = cityestate_option( 'list_agent_per_page' );
	        
	        // Set default agent per page
	        if( !$list_agent_per_page ){
	            $list_agent_per_page = 4;
	        }

	        // Collect agent args and run query
	        $args = array( 'post_type' => 'cityestate_agent', 'posts_per_page' => $list_agent_per_page, 'paged' => $paged );	        
	        $wp_query = new WP_Query( $args );

	        if( $wp_query->have_posts() ):	        	
	        	while( $wp_query->have_posts() ): $wp_query->the_post();
	        		// Get agent detail
		            $agent_googleplus 	= get_post_meta( get_the_ID(), 'agent_googleplus', true );
		            $agent_youtube 		= get_post_meta( get_the_ID(), 'agent_youtube', true );
		            $agent_pinterest 	= get_post_meta( get_the_ID(), 'agent_instagram', true );
		            $agent_instagram 	= get_post_meta( get_the_ID(), 'agent_pinterest', true );
		            $agent_vimeo 		= get_post_meta( get_the_ID(), 'agent_vimeo', true );
		            $agent_mobile 		= get_post_meta( get_the_ID(), 'agent_mobile', true );
		            $agent_mobile_call	= str_replace( array( '(',')', ' ', '-' ), '', $agent_mobile );
		            $agent_office 		= get_post_meta( get_the_ID(), 'agent_office', true );
					$agent_office_call	= str_replace( array( '(',')', ' ', '-' ), '', $agent_office );
		            $agent_position 	= get_post_meta( get_the_ID(), 'agent_position', true );
		            $agent_company 		= get_post_meta( get_the_ID(), 'agent_company', true );
		            $about_agent 		= get_post_meta( get_the_ID(), 'about_agent', true );
		            $agent_facebook 	= get_post_meta( get_the_ID(), 'agent_facebook', true );
		            $agent_twitter 		= get_post_meta( get_the_ID(), 'agent_twitter', true );
		            $agent_linkedin 	= get_post_meta( get_the_ID(), 'agent_linkedin', true );		            
		            $agent_email 		= get_post_meta( get_the_ID(), 'agent_email', true ); ?>
		        <div class="agent-list-item">
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 padding-right-none">
							<div class="agent-list-image">
								<!-- Set agent photo -->
								<?php if( has_post_thumbnail( $post->ID ) ){
		                            // Show agent photo
		                            the_post_thumbnail( 'cityestate_image_265_260' );
		                        } else {
		                        	// Show default agent page
		                            echo cityestate_image_placeholder( 'cityestate_image_265_260' );
		                        }

		                        if( !empty($agent_facebook) || !empty($agent_twitter) || !empty($agent_linkedin) || !empty($agent_googleplus) || !empty($agent_youtube) || !empty($agent_instagram) || !empty($agent_pinterest) || !empty($agent_vimeo) ){ ?>
									<div class="agent-social-area">	
										<!-- Collapsed agent social icon -->
										<a class="agent_social_media collapsed" href="javascript:void(0);"></a>
										<div class="collapse agent-social agent" role="tabpanel">									
											<!-- Agent facebook social media -->
											<?php if( !empty($agent_facebook) ){ ?>
				                            	<a href="<?php echo esc_url( $agent_facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				                            <?php } ?>
				                            <!-- Agent twitter social media -->
				                            <?php if( !empty($agent_twitter) ){ ?>
				                            	<a href="<?php echo esc_url( $agent_twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				                            <?php } ?>
				                            <!-- Agent linkedin social media -->
				                            <?php if( !empty($agent_linkedin) ){ ?>
				                            	<a href="<?php echo esc_url( $agent_linkedin ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				                            <?php } ?>
				                            <!-- Agent google social media -->
				                            <?php if( !empty($agent_googleplus) ){ ?>
				                                <a href="<?php echo esc_url( $agent_googleplus ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				                            <?php } ?>
				                            <!-- Agent youtube social media -->
				                            <?php if( !empty($agent_youtube) ){ ?>
				                                <a href="<?php echo esc_url( $agent_youtube ); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
				                            <?php } ?>
				                            <!-- Agent instagram social media -->
				                            <?php if( !empty($agent_instagram) ){ ?>
				                                <a href="<?php echo esc_url( $agent_instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
				                            <?php } ?>
				                            <!-- Agent pinterest social media -->
				                            <?php if( !empty($agent_pinterest) ){ ?>
				                                <a href="<?php echo esc_url( $agent_pinterest ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
				                            <?php } ?>
				                            <!-- Agent vimeo social media -->
				                            <?php if( !empty($agent_vimeo) ){ ?>
				                                <a href="<?php echo esc_url( $agent_vimeo ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a>
				                            <?php } ?>									
										</div>
									</div><?php
								} ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-8 agent-list-detail-section padding-left-none">
							<div class="agent-list-info">
								<div class="top-header">
									<!-- Agent page link and agent name -->
									<a href="<?php echo esc_url(get_the_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
									<p><?php
			                            // Collect agent args and call query
			                            $agent_listing_args = array( 'post_type' => 'property', 'posts_per_page' => '-1', 'meta_query' => array( array( 'key' => 'agents', 'value' => get_the_ID(), 'compare' => '=' ) ) );
							            $agent_query = new WP_Query( $agent_listing_args );							            
							            
							            // Check agent is found
							            if( $agent_query->found_posts > 1 ){ 
							            	echo esc_html($agent_query->found_posts).' '.esc_html($theme_labels['agent_found_properties']); 
							            } else { 
							            	echo esc_html($agent_query->found_posts).' '.esc_html($theme_labels['agent_found_property']);
							            } ?>
							        </p>
								</div>
								<!-- Show about agent -->
								<p class="agent-excerpt"><?php echo wp_trim_words( $about_agent, 25 ); ?></p>
								<ul class="agnet-list-contact-info">
									<!-- Agent mobile number -->
									<?php if( !empty($agent_mobile) ){ ?>
		                                <li><a href="tel:<?php echo esc_attr( $agent_mobile_call ); ?>"><?php echo esc_attr( $agent_mobile ); ?></a></li>
		                            <?php } else {
		                            	// Agent office number
		                            	if( !empty($agent_office_num) ){ ?>
		                                	<li><a href="tel:<?php echo esc_attr( $agent_office_call ); ?>"><?php echo esc_attr( $agent_office_num ); ?></a></li>
		                            	<?php }
		                            } ?>	                            
		                            <!-- Agent email address -->
		                            <?php if( !empty($agent_email) ){ ?>
		                                <li class="email"><span><?php esc_html_e('Email:', 'cityestate'); ?></span> <a href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_attr( $agent_email ); ?></a></li>
		                            <?php } ?>										
								</ul>
							</div>
						</div>
					</div>
				</div><?php
		        endwhile;
		        // Reset wp query
	            wp_reset_postdata();
	        endif;
	    echo
	    '</div>
	</div>';
	
	// Agent pagination
	cityestate_pagination( $wp_query->max_num_pages, $range = 2 );	

	// Check have sidenar
	if( $have_sidebar ){
		echo "</article></section>";
	}

	// Right sidebar
	if( ('right' == $sidebar_pos) ){ ?>
		<aside class="col-md-4 col-sm-12 sidebar" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic right sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php } ?>
	<div class="vertical-space-100"></div>
</section>

<?php get_footer(); ?>