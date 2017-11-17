<?php
/*
	Template Name: Advanced Search Results
*/

get_header();

// Declare global variable
global $wp_query, $paged, $post, $search_query;

// Define sidebar variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Set sidebar status
$sidebar_pos 	= get_post_meta( $post->ID, 'sidebar_position' , true);
$sidebar_type	= get_post_meta( $post->ID, 'page_sidebar' , true);
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false;

// Get number of property to list in search page
$number_of_property = cityestate_option( 'adv_sea_number_property' );

// Set default number of property
if( !$number_of_property ){
    $number_of_property = 9;
}

// Check save search is show
$enable_disable_save_search = cityestate_option( 'enable_disable_save_search' );

// Check is home page
if( is_front_page() ){
    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
}

// Set property list order
$sort_by = '';
if( isset( $_GET['sortby'] ) ){
    $sort_by = $_GET['sortby'];
} else {
	// Set defaulr order
	$sort_by = cityestate_option( 'adv_sea_result_order' );
}

// Collect save search args and run query
$search_query = array( 'post_type' => 'property', 'posts_per_page' => $number_of_property, 'paged' => $paged );
$search_query = apply_filters( 'cityestate_search_parameters', $search_query );

// Set search query sort
$search_query = cityestate_property_sort( $search_query );

// Run property result
$wp_query = new WP_Query( $search_query );

// Set row class as per sideabr
if( $have_sidebar ){
	$row_class = 6;
} else {
	$row_class = 4;
} ?>
<section id="main-content" class="container"><?php
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

	// Check have sidebar
	if( $have_sidebar ){ ?>
		<section class="<?php  echo('both' == $sidebar_pos )?'col-md-6 cntt-w':'col-md-8 cntt-w'; ?>">
			<article><?php 
	} ?>

	<div class="row-wrapper-x">
		<div class="item">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<!-- Check save search is enable -->
					<?php if( $enable_disable_save_search != 0 ){ ?>
	                    <p><?php esc_html_e( 'Save this Search ?', 'cityestate' ); ?></p>
	            	    <?php get_template_part( 'template-parts/save_search' ); ?>
	                <?php } ?>
	            </div>		
	            <div class="col-xs-12 col-sm-12 col-md-12">
	            	<div id="search_label_options" class="search-filter-form pull-right">
			            <!-- Set property order -->
			            <select id="property_sort" class="selectpicker" title="<?php esc_html_e( 'Default Order', 'cityestate' ); ?>" name="relevance">			
							<!-- Property order low to high price -->
							<option <?php if( $sort_by == 'sort_lh' ){ echo "selected"; } ?> value="sort_lh"><?php esc_html_e( 'Price (Low to High)', 'cityestate' ); ?></option>
				            <!-- Property order high to low price -->
				            <option <?php if( $sort_by == 'sort_hl' ){ echo "selected"; } ?> value="sort_hl"><?php esc_html_e( 'Price (High to Low)', 'cityestate' ); ?></option>
				            <!-- Property order featured label -->
				            <option <?php if( $sort_by == 'featured' ){ echo "selected"; } ?> value="featured"><?php esc_html_e( 'Featured', 'cityestate' ); ?></option>
				            <!-- Property order new to old date -->
				            <option <?php if( $sort_by == 'sort_no' ){ echo "selected"; } ?> value="sort_no"><?php esc_html_e( 'Date New to Old', 'cityestate' ); ?></option>
				            <!-- Property order old to new date -->
				            <option <?php if( $sort_by == 'sort_on' ){ echo "selected"; } ?> value="sort_on"><?php esc_html_e( 'Date Old to New', 'cityestate' ); ?></option>
						</select>
					</div>
					<!-- Set property list view -->
					<div class="pull-right list-style-change">
			            <!-- List property list view -->
			            <a href="javascript:void(0);" class="property_view_link property_list_view"><img src="<?php echo get_template_directory_uri() ?>/images/list-view.png" alt="List View"></a>
			            <!-- List property grid view -->
			            <a href="javascript:void(0);" class="property_view_link property_grid_view"><img src="<?php echo get_template_directory_uri() ?>/images/grid-view.png" alt="Grid View"></a>
			        </div>
			        <div class="vertical-space-20"></div>
			    </div>
		        <?php		
				$wp_query = new WP_Query( $search_query );
				if( $wp_query->have_posts() ){
		            while( $wp_query->have_posts() ) : $wp_query->the_post();
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
												<div class="col-xs-12 col-sm-12 col-md-3 property_list_list-link"4
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
								// Property thumbnail image
								if( has_post_thumbnail() ){
									the_post_thumbnail( 'cityestate_property_thumb' );
								} else {
									// Property default image
									cityestate_image_placeholder( 'cityestate_property_thumb' );
								}
								// Property featured label
								echo include( get_template_directory() . '/template-parts/property_featured_label.php' );
								// Property status label
								echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
							</div>
							<div class="recent-proeprty-box1-inner">
								<!-- Propert link -->
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<h3 class="property-box1-title">
										<!-- Property title -->
										<?php the_title(); ?>
									</h3>
								</a>
								<!--  Propert location info -->
								<?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>
								<ul class="property-basic-info">
									<!-- Property basic detail -->
									<?php echo cityestate_basic_info(); ?>
								</ul>
							</div>
							<div class="recent-proeprty-box1-price-info">
								<!-- Property price info -->
								<?php echo cityestate_get_property_price();
								// Check property submit by user
								$property_submit_by_user = cityestate_option('property_submit_by_user');
								if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
									// Set property favorite option
									echo include( get_template_directory() . '/template-parts/property_favorite.php' );
								} ?>
							</div>
							<div class="vertical-space-20"></div>
						</div><?php					
					endwhile;
				} else {
					// Show no property found message
					get_template_part('template-parts/property_none');
				} ?>		
    		</div>
    	</div>
    </div>
    
    <!-- Property list pagination -->
    <?php cityestate_pagination( $wp_query->max_num_pages, $range = 2 );

	// Check have sidebar
	if( $have_sidebar ){
		echo "</article></section>";
	}

	// Right sidebar
	if( ('right' == $sidebar_pos) ){ ?>
		<aside class="col-md-4 sidebar" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Set dynamic right sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php } ?>

</section>

<?php get_footer(); ?>