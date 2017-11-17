<?php

// Declare variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Get sidebar info
$sidebar_pos 	= cityestate_option( 'taxonomies_sidebar_position' );
$sidebar_type	= cityestate_option( 'taxonomies_sidebar' );
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false;

// Set row class
if( $have_sidebar ){
	$row_class = 6;
} else {
	$row_class = 4;
}

// Get term
$current_term 	= get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$taxonomy_id 	= $current_term->term_id;
$taxonomy_name 	= get_query_var( 'taxonomy' ); ?>

<section id="main-content" class="container">
	<div class="vertical-space-60"></div><?php
	// Left sidebar
	if( ( 'left' == $sidebar_pos ) ){ ?>
		<aside class="col-md-4 sidebar leftside" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic left sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php }

	// Chech have sidebar
	if( $have_sidebar ){ ?>
		<section class="<?php  echo('both' == $sidebar_pos ) ?'col-md-6 cntt-w':'col-md-8 cntt-w'; ?>">
			<article><?php 
	} ?>

	<div class="row-wrapper-x taxonomy-term-list">		
		<div class="item">
			<div class="row"><?php
				// Define sort variable
				$sortby = "";

				// Get property default order
				$property_order_type = cityestate_option( 'taxonomies_default_order' );

				// Get property default sort order
				if( isset( $_GET['sortby'] ) ){
				    $sortby = $_GET['sortby'];
				} else {
					$sortby = $property_order_type;
				} ?>
				<div class="list-item-menu-inner col-xs-12 col-sm-12 col-md-12">
					<div class="search-filter-form pull-right" id="search_label_options">
						<!-- Property sort -->
						<select id="property_sort" class="selectpicker" title="<?php esc_html_e( 'Default Order', 'cityestate' ); ?>" name="relevance">
							<!-- Sort property low to high price -->
							<option <?php if( $sortby == 'sort_lh' ){ echo "selected"; } ?> value="sort_lh"><?php esc_html_e( 'Price (Low to High)', 'cityestate' ); ?></option>
				            <!-- Sort property high to low price -->
				            <option <?php if( $sortby == 'sort_hl' ){ echo "selected"; } ?> value="sort_hl"><?php esc_html_e( 'Price (High to Low)', 'cityestate' ); ?></option>
				            <!-- Sort property featured -->
				            <option <?php if( $sortby == 'featured' ) { echo "selected"; } ?> value="featured"><?php esc_html_e( 'Featured', 'cityestate' ); ?></option>
				            <!-- Sort property new to old date -->
				            <option <?php if( $sortby == 'sort_no' ){ echo "selected"; } ?> value="sort_no"><?php esc_html_e( 'Date New to Old', 'cityestate' ); ?></option>
				            <!-- Sort property old to new date -->
				            <option <?php if( $sortby == 'sort_on' ){ echo "selected"; } ?> value="sort_on"><?php esc_html_e( 'Date Old to New', 'cityestate' ); ?></option>
						</select>			
				  	</div>
				  	<!-- Property list icon -->
					<div class="pull-right list-style-change">
			            <!-- Property list view -->
			            <a href="javascript:void(0);" class="property_view_link property_list_view">
			            	<img src="<?php echo get_template_directory_uri() ?>/images/list-view.png" alt="List View">
			            </a>
			            <!-- Property grid view -->
			            <a href="javascript:void(0);" class="property_view_link property_grid_view"><img src="<?php echo get_template_directory_uri() ?>/images/grid-view.png" alt="Grid View"></a>
			        </div>
				</div><?php				

				global $wp_query, $paged;		        

		        // Number of property to list
				$number_of_property = cityestate_option( 'taxonomy_per_page' );
				
				// Sort result
		        if( !$number_of_property ){
    				$number_of_property = 9;
				}
				$sorting_args = array( 'posts_per_page' => $number_of_property, 'post_status' => 'publish' );
                $sorting_args = cityestate_property_sort($sorting_args);

                // Collect query and run query
                $args = array_merge( $wp_query->query_vars, $sorting_args);
                query_posts( $args );

				if ( have_posts() ){
                        while ( have_posts() ) : the_post();
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
				        		<!-- Property list view -->
								<div class="property_list_list list-list-with-sidebar col-xs-12 col-sm-12 col-md-12" >
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
							} ?>
							<!-- Property grid view -->
							<div class="property_list_grid col-xs-12 col-sm-<?php echo esc_attr($row_class); ?> col-md-<?php echo esc_attr($row_class); ?> recent-property-box1" >
								<div class="recent-proeprty-box1-img-box"><?php
									// Set property image
									if( has_post_thumbnail() ){
										the_post_thumbnail('cityestate_property_thumb');								
									} else {
										// Set property default image
										cityestate_image_placeholder('cityestate_property_thumb');
									}
									// Set property featured label
									echo include( get_template_directory() . '/template-parts/property_featured_label.php');
									// Set property status label
									echo include( get_template_directory() . '/template-parts/property_status_label.php'); ?>
								</div>
								<div class="recent-proeprty-box1-inner">
									<!-- Set property detail link -->
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<h3 class="property-box1-title">
											<!-- Set property title -->
											<?php the_title(); ?>
										</h3>
									</a>
									<!-- Set property location info -->
									<?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>
									<ul class="property-basic-info">
										<!-- Set property basic detail -->
										<?php echo cityestate_basic_info(); ?>
									</ul>
								</div>
								<div class="recent-proeprty-box1-price-info">
									<!-- Set property price -->
									<?php echo cityestate_get_property_price();
									// Check property submit by user
									$property_submit_by_user = cityestate_option('property_submit_by_user');
									if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
										// Set property favorite option
										echo include( get_template_directory() . '/template-parts/property_favorite.php' );
									} ?>
								</div>
							</div><?php
						endwhile;
						// Reset wp query
        				wp_reset_postdata();
				} else {
		            // Show no property found message
		            get_template_part('template-parts/property_none');        
		        } ?>
			</div>
		</div>
    </div>
    
    <!-- Property pagination -->
    <?php cityestate_pagination( $wp_query->max_num_pages, $range = 2 ); wp_reset_postdata();
    
    // Check have sidebar
	if( $have_sidebar ){
		echo "</article></section>";
	}

	// Right sidebar
	if( ('right' == $sidebar_pos) ){ ?>
		<aside class="col-md-4 sidebar" id="sidebar">
			<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic right sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php } ?>
	<div class="vertical-space-60"></div>
</section>