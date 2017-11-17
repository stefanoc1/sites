<?php
get_header();

// Get global variables
global $post, $theme_labels;

// Define variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Get sidebar values
$sidebar_pos 			= cityestate_option( 'sidebar_position' );
$sidebar_type			= cityestate_option( 'page_sidebar' );
$have_sidebar			= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false;
$agent_property_list 	= cityestate_option( 'agent_property_list' );

// Get agent info
$agent_office 		= get_post_meta( get_the_ID(), 'agent_office', true );
$agent_office 		= str_replace( array( '(',')',' ','-' ), '', $agent_office );
$agent_position 	= get_post_meta( get_the_ID(), 'agent_position', true );
$agent_company 		= get_post_meta( get_the_ID(), 'agent_company', true );
$agent_mobile 		= get_post_meta( get_the_ID(), 'agent_mobile', true );
$agent_mobile 		= str_replace( array( '(',')',' ','-' ), '', $agent_mobile );
$agent_fax 			= get_post_meta( get_the_ID(), 'agent_fax', true );
$agent_email 		= get_post_meta( get_the_ID(), 'agent_email', true );

// Get agent social media
$agent_facebook 	= get_post_meta( get_the_ID(), 'agent_facebook', true );
$agent_instagram 	= get_post_meta( get_the_ID(), 'agent_instagram', true );
$agent_pinterest 	= get_post_meta( get_the_ID(), 'agent_pinterest', true );
$agent_twitter 		= get_post_meta( get_the_ID(), 'agent_twitter', true );
$agent_linkedin 	= get_post_meta( get_the_ID(), 'agent_linkedin', true );
$agent_googleplus 	= get_post_meta( get_the_ID(), 'agent_googleplus', true );
$agent_youtube 		= get_post_meta( get_the_ID(), 'agent_youtube', true );
$agent_vimeo 		= get_post_meta( get_the_ID(), 'agent_vimeo', true );
$agent_logo 		= get_post_meta( get_the_ID(), 'agent_logo', true );
$agent_website 		= get_post_meta( get_the_ID(), 'agent_website', true );

// Get row class
if( $have_sidebar ){
	$row_class = 6;
} else {
	$row_class = 4;
} ?>

<section id="main-content" class="container">

<!-- Add vertical space -->
<div class="vertical-space-80"></div><?php

// Left Sidebar
if( ('left' == $sidebar_pos) ) { ?>
	<aside class="col-md-4 col-sm-12 sidebar leftside" id="sidebar">
		<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
			<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
				<!-- Get dynamic left sidebar -->
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
	// Check post content is available
	if( have_posts() ): 
		while( have_posts() ): the_post(); ?>
			<div class="agent-detail-container-section">
                <div class="agent-detail-inner-section">
                    <div class="row">
                    	<div class="col-xs-12 co-sm-4 col-md-4">
							<div class="agent-detial-image-container">
								<!-- Show agnet photo -->
								<?php if( has_post_thumbnail( $post->ID ) ){ 
									the_post_thumbnail( 'cityestate_image_265_260' );
		                        } else {
		                            // Show default agent photo
		                            echo cityestate_image_placeholder( 'cityestate_image_265_260' );
		                        } ?>
		                        <!-- Show agent social media -->
								<?php if( !empty($agent_facebook) || !empty($agent_twitter) || !empty($agent_linkedin) || !empty($agent_googleplus) || !empty($agent_youtube) || !empty($agent_instagram) || !empty($agent_pinterest) || !empty($agent_vimeo) ){ ?>
									<ul class="agent-detail-social-list">
										<!-- Agent facebook social media -->
										<?php if( !empty( $agent_facebook ) ) { ?>
			                                <li><a class="btn-facebook" href="<?php echo esc_url( $agent_facebook ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent twitter social media -->
			                            <?php if( !empty( $agent_twitter ) ) { ?>
			                                <li><a class="btn-twitter" href="<?php echo esc_url( $agent_twitter ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent linkedin social media -->
			                            <?php if( !empty( $agent_linkedin ) ) { ?>
			                                <li><a class="btn-linkedin" href="<?php echo esc_url( $agent_linkedin ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent google plus social media -->
			                            <?php if( !empty( $agent_googleplus ) ) { ?>
			                                <li><a class="btn-google-plus" href="<?php echo esc_url( $agent_googleplus ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent youtube social media -->
			                            <?php if( !empty( $agent_youtube ) ) { ?>
			                                <li><a class="btn-youtube" href="<?php echo esc_url( $agent_youtube ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent instagram social media -->
			                            <?php if( !empty( $agent_instagram ) ) { ?>
			                                <li><a class="btn-instagram" href="<?php echo esc_url( $agent_instagram ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent pinterest social media -->
			                            <?php if( !empty( $agent_pinterest ) ) { ?>
			                                <li><a class="btn-pinterest" href="<?php echo esc_url( $agent_pinterest ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			                            <?php } ?>

			                            <!-- Agent vimeo social media -->
			                            <?php if( !empty( $agent_vimeo ) ) { ?>
			                                <li><a class="btn-vimeo" href="<?php echo esc_url( $agent_vimeo ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li>
			                            <?php } ?>
									</ul>
								<?php } ?>
							</div>
						</div>
						<div class="col-xs-12 co-sm-8 col-md-8">
							<!-- Show agent name -->
							<h3 class="agnet-detail-name-title"><?php the_title(); ?></h3>
							<!-- Show agent position -->
							<p><?php if( !empty( $agent_position) ){ echo esc_attr( $agent_position ).' '; }
                            	if( !empty( $agent_company) ) { echo esc_attr($theme_labels['at']); echo ' ' . esc_attr( $agent_company ); } ?></p>
							<p><?php the_content(); ?></p>
							<!-- Show agent office number -->
							<?php if( !empty($agent_office) ) { ?>
                                <p class="agent-detail-contact-detail"><?php echo esc_html($theme_labels['office']); ?> <b><a href="tel:<?php echo esc_attr( $agent_office ); ?>"><?php echo esc_attr( $agent_office ); ?></a></b></p>
                            <?php } ?>
                            <!-- Show agent mobile number -->
                            <?php if( !empty( $agent_mobile ) ) { ?>
                                <p class="agent-detail-contact-detail"><?php echo esc_attr($theme_labels['mobile']); ?> <b><a href="tel:<?php echo esc_attr( $agent_mobile ); ?>"><?php echo esc_attr( $agent_mobile ); ?></a></b></p>
                            <?php } ?>
                            <!-- Show agent fax number  -->
                            <?php if( !empty( $agent_fax ) ) { ?>
                                <p class="agent-detail-contact-detail"><?php echo esc_html($theme_labels['fax']); ?> <b><a><?php echo esc_attr( $agent_fax ); ?></a></b></p>
                            <?php } ?>
                            <!-- Show agent email address -->
                            <?php if( !empty( $agent_email ) ) { ?>
                                <p class="agent-detail-contact-detail"><?php echo esc_html($theme_labels['email']); ?> <b><a href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_attr( $agent_email ); ?></a></b></p>
                            <?php } ?>
                            <!-- Show agent website url -->
                            <?php if( !empty( $agent_website ) ) { ?>
                                <p class="agent-detail-contact-detail"><?php echo esc_html($theme_labels['website']); ?> <b><a target="_blank" href="<?php echo esc_url( $agent_website ); ?>"><?php echo esc_url( $agent_website ); ?></a></b></p>
                            <?php } ?>
						</div>
                    </div>                    
               	</div><?php
               	// Check is agent singular page
	            if( is_singular( 'cityestate_agent' ) ){
				    global $post;			    
				    $agent_name = get_the_title();
				} else if( is_author() ){
				    // Get current user info as author
				    global $current_author;
				    $agent_email = $current_author->user_email;
				    $agent_name = $current_author->display_name;
				}

				// Check agent email id okay
				$agent_email = is_email( $agent_email );

				// Check show cotact form 7 in agent and contact form 7 id
				$contact_form_7_in_agent_page 	= cityestate_option( 'contact_form_7_in_agent_page' );
				$contact_form_7_for_agent_page 	= cityestate_option( 'contact_form_7_for_agent_page' ); ?>				
				
				<div class="agent-detail-contact-inner-section"><?php
				    // Show contact from 7 in agent page
				    if( $contact_form_7_in_agent_page != 1 ) {
				        // Check agent email is set
				        if( $agent_email ){ ?>
				        	<!-- Contact agent form title -->
				            <h3 class="form-title"><?php echo esc_html($theme_labels['contact_me']); ?></h3>
				            <!-- Contact agent form fields -->
				            <form id="agnet-send-message" name="contact_form" method="post">
								<div class="row">
									<!-- Visiter fist name -->
									<div class="col-xs-12 co-sm-6 col-md-6 custom-padding-right">
						            	<input id="first_name" class="first_name" name="first_name" placeholder="<?php esc_html_e( 'First Name', 'cityestate' ); ?>" type="text">
						            </div>

						            <!-- Visiter last name -->
						            <div class="col-xs-12 co-sm-6 col-md-6 custom-padding-left">
						            	<input id="last_name" class="last_name" name="last_name" placeholder="<?php esc_html_e( 'Last Name', 'cityestate' ); ?>" type="text">
						            </div>

						            <!-- Visiter email address -->
									<div class="col-xs-12 co-sm-6 col-md-6 custom-padding-right">
										<input id="emailid" class="email_address" name="email_address" placeholder="<?php esc_html_e( 'Email Address', 'cityestate' ); ?>" type="email">
									</div>

									<!-- Visiter phone number -->
									<div class="col-xs-12 co-sm-6 col-md-6 custom-padding-left">
										<input id="pnumber" class="p_number" name="p_number" placeholder="<?php esc_html_e( 'Phone Number', 'cityestate' ); ?>" type="text">
									</div>

									<!-- Visiter message -->
									<div class="col-xs-12 co-sm-12 col-md-12">
										<textarea class="message" placeholder="<?php esc_html_e( 'Message', 'cityestate' ); ?>" name="message" ><?php echo sprintf(esc_html__('Hi %s, I saw your profile on %s and wanted to see if you could help me', 'cityestate' ), $agent_name, get_option('blogname')); ?></textarea>
									</div>

									<!-- Send message button -->
									<div class="col-xs-12 co-sm-12 col-md-12">
										<button class="agent_detail_contact" name="submtinow"><?php echo esc_html($theme_labels['submit_now']); ?></button>
										<div class="form_messages"></div>
									</div>

									<!-- Store few information in hide element -->
									<input type="hidden" name="agent_contact_form_ajax" value="<?php echo wp_create_nonce('agent_contact_form_nonce'); ?>"/>
									<input type="hidden" name="agent_author_email" value="<?php echo antispambot($agent_email); ?>">
						            <input type="hidden" name="action" value="agent_contact_send_message">
								</div>
							</form>
				        <?php }
				    } else {
				    	// Show contact form 7 for send message to agent
				        echo do_shortcode( $contact_form_7_for_agent_page );
				    } ?>
				</div>
			</div>             
            <?php			
		endwhile;
	endif;

    global $wp_query;

    // Get agnet id
    $agent_id = $post->ID;
    
    // Get agent property list
    $agent_listing_args = array( 'post_type' => 'property', 'posts_per_page' => '-1', 'meta_query' => array( array( 'key' => 'agents', 'value' => $agent_id, 'compare' => '=' ) ) );

    // Call wp query
    $wp_query = new WP_Query( $agent_listing_args );

    echo '<div class="vertical-space-60"></div>';
    
    // Check and show how many agent property found
    if( $wp_query->found_posts != 0 ){
    	if( $wp_query->found_posts > 1 ){ 
    		echo '<h3 class="my-property-label">'.$theme_labels['my_properties'].'</h3>'; 
    	} else { 
    		echo '<h3 class="my-property-label">'.$theme_labels['my_property'].'</h3>'; 
    	}
    }

    // List agent property
	if ( $wp_query->have_posts() ) :
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
        	if( $agent_property_list == "list_list_view" ){
        		if( !$have_sidebar ){ ?>
	        		<!-- Property list view -->
					<div class="property_list_list col-xs-12 col-sm-12 col-md-12" >
						<div class="property_list_list property-listing-list-full">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 property_list_list-image">
									<div class="recent-proeprty-box1-img-box"><?php
										// Property thumbnail image
										if( has_post_thumbnail() ){
											the_post_thumbnail('cityestate_property_thumb');								
										} else {
											// Property default image
											cityestate_image_placeholder('cityestate_property_thumb');
										}
										// Property featured label
										echo include( get_template_directory() . '/template-parts/property_featured_label.php' ); ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-8 property_list_list-info">
									<div class="col-xs-12 col-sm-8 col-md-8 property_list_list-right">
										<div class="recent-proeprty-box1-inner">
											<!-- Property link -->
											<a href="<?php echo esc_url( get_permalink() ); ?>">
												<h3 class="property-box1-title">
													<!-- Property title -->
													<?php the_title(); ?>
												</h3>
											</a>
											<!-- Property location label -->
											<?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>
											<!-- Property neighborhood label -->
											<?php echo include( get_template_directory() . '/template-parts/property_neighborhood_label.php' ); ?>
											<!-- Property agent name label -->
											<?php echo include( get_template_directory() . '/template-parts/property_agent_name.php'); ?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 property_list_list-left">
										<!-- Property price -->
										<?php echo cityestate_get_property_price(); ?>
										<!-- Property status label -->
										<?php echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
									</div>
									<?php if( $have_sidebar ){ ?>
										<div class="col-xs-12 col-sm-12 col-md-8 property_list_list-facility">
									<?php } else { ?>
										<div class="col-xs-12 col-sm-12 col-md-9 property_list_list-facility">
									<?php } ?>
										<div class="pull-left">
										<ul class="property-basic-info">
											<!-- Property basic detail -->
											<?php echo cityestate_basic_info(); ?>
										</ul>
										</div>
										<div class="pull-right property-link"><?php
											// Check property submit by user
											$property_submit_by_user = cityestate_option( 'property_submit_by_user' );
											if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
												// Property favorite option
												echo include( get_template_directory() . '/template-parts/property_favorite.php' );
											} ?>
										</div>
									</div>
									<?php if( $have_sidebar ){ ?>
										<div class="col-xs-12 col-sm-12 col-md-4 property_list_list-link">
									<?php } else { ?>
										<div class="col-xs-12 col-sm-12 col-md-3 property_list_list-link">
									<?php } ?>
										<!-- Property read more link -->
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-btn-link"><?php esc_html_e( 'MORE DETAILS >', 'cityestate' ); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div><?php
	        		} else { ?>
	        		<!-- Property listing view -->
					<div class="property_list_list list-list-with-sidebar" >
						<div class="property_list_list property-listing-list-full">
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4 property_list_list-image">
									<div class="recent-proeprty-box1-img-box"><?php
										// Show property image
										if( has_post_thumbnail() ){
											the_post_thumbnail('cityestate_property_thumb');								
										} else {
											// Show default image of property
											cityestate_image_placeholder('cityestate_property_thumb');
										}								
										// get property featured label
										echo include( get_template_directory() . '/template-parts/property_featured_label.php'); ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-8 property_list_list-info">
									<div class="col-xs-12 col-sm-8 col-md-8 property_list_list-right">
										<div class="recent-proeprty-box1-inner">
											<!-- Set property detail link -->
											<a href="<?php echo esc_url( get_permalink() ); ?>">
												<h3 class="property-box1-title">
													<!-- Show property title -->
													<?php the_title(); ?>
												</h3>
											</a>
											<!-- Set property location info -->
											<?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>

											<!-- Set property neighborhood label -->
											<?php echo include( get_template_directory() . '/template-parts/property_neighborhood_label.php' ); ?>

											<!-- Set property agent name -->
											<?php echo include( get_template_directory() . '/template-parts/property_agent_name.php'); ?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 property_list_list-left">
										<!-- Set property price -->
										<?php echo cityestate_get_property_price(); ?>
										
										<!-- Set property status labrl -->
										<?php echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
									</div>
									<?php if( $have_sidebar ){ ?>
										<div class="col-xs-12 col-sm-12 col-md-8 property_list_list-facility">
									<?php } else { ?>
										<div class="col-xs-12 col-sm-12 col-md-9 property_list_list-facility">
									<?php } ?>
										<div class="pull-left">
										<ul class="property-basic-info">
											<!-- Set property basic detail -->
											<?php echo cityestate_basic_info(); ?>
										</ul>
										</div>
										<div class="pull-right property-link">
											<!-- Check property submit by user via frontend -->
											<?php $property_submit_by_user = cityestate_option( 'property_submit_by_user' );
											if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
												// Set property favorite option	
												echo include( get_template_directory() . '/template-parts/property_favorite.php');
											} ?>
										</div>
									</div>
									<?php if( $have_sidebar ){ ?>
										<div class="col-xs-12 col-sm-12 col-md-4 property_list_list-link">
									<?php } else { ?> 
										<div class="col-xs-12 col-sm-12 col-md-3 property_list_list-link">
									<?php } ?>
										<!-- Property more detail link -->
										<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-btn-link"><?php esc_html_e( 'MORE DETAILS >', 'cityestate' ); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div><?php
				}
			} else { ?>
				<!-- Property grid view -->
				<div class="property_list_grid col-xs-12 col-sm-<?php echo esc_attr($row_class); ?> col-md-<?php echo esc_attr($row_class); ?> recent-property-box1" >
					<div class="recent-proeprty-box1-img-box"><?php
						// Property thumbnail
						if( has_post_thumbnail() ){
							the_post_thumbnail('cityestate_property_thumb');								
						} else {
							// Property default image
							cityestate_image_placeholder('cityestate_property_thumb');
						}
						// Property featured label
						echo include( get_template_directory() . '/template-parts/property_featured_label.php' );
						// Property status label
						echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
					</div>
					<div class="recent-proeprty-box1-inner">
						<!-- Property link -->
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<h3 class="property-box1-title">
								<!-- Property title -->
								<?php the_title(); ?>
							</h3>
						</a>
						<!-- Property location info -->
						<?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>
						<ul class="property-basic-info">
							<!-- Property basic detail -->
							<?php echo cityestate_basic_info(); ?>
						</ul>
					</div>
					<div class="recent-proeprty-box1-price-info">
						<!-- Property price -->
						<?php echo cityestate_get_property_price();
						// Check submit property by user
						$property_submit_by_user = cityestate_option('property_submit_by_user');
						if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
							// Property favorite option
							echo include( get_template_directory() . '/template-parts/property_favorite.php' );
						} ?>
					</div>
				</div><?php
			}
        endwhile;
        // Reset wp query
        wp_reset_postdata();
    else:
    	// Show no property found message
        get_template_part( 'template-parts/property_none' );
    endif;

echo '</div>';

// Check have sidebar
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