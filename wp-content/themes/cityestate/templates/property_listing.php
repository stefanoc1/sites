<?php
/*
	Template Name: Property Listing Template
*/

get_header();

// Declare global variable
global $post, $current_page, $featured_list, $list_tab;

// Define sidebar variable
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

// Get sidebar detail
$sidebar_pos 	= get_post_meta( $post->ID, 'sidebar_position' , true);
$sidebar_type	= get_post_meta( $post->ID, 'page_sidebar' , true);
$have_sidebar	= ( !empty($sidebar_pos) && $sidebar_pos != "none" ) ? true : false;

// Get page list tab status
$list_tab = get_post_meta( $post->ID, 'list_tab', true );
// Get page list tab one
$list_tab1 = get_post_meta( $post->ID, 'list_tab1', true );

// Get page list tab two
$list_tab2 = get_post_meta( $post->ID, 'list_tab2', true );

// Get page list featured listing status
$featured_list = get_post_meta( $post->ID, 'featured_list', true );
// Get number of featured property to ;ist
$featured_list_show = get_post_meta( $post->ID, 'featured_list_show', true );
// Get number of total property to list
$number_property_show = get_post_meta( $post->ID, 'number_property_show', true );

// Get current page link
$args = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/property_listing.php' );        
$pages = get_pages($args);

// Check page is found
if( $pages ){
    $current_page = get_permalink( $post->ID );
} else {
    $current_page = home_url('/');
}

// Check tab is enable or disable
if( isset($_GET['tabs']) && $_GET['tabs'] == 'no' ){
    $list_tab = 'disable';
}

// Get row class
if( $have_sidebar ){
	$row_class = 6;
} else {
	$row_class = 4;
} ?>

<section id="main-content" class="container">
	<div class="vertical-space-60"></div><?php	
	// Left sidebar
	if( ( 'left' == $sidebar_pos ) ){ ?>
		<aside class="col-md-4 sidebar leftside" id="sidebar">
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
		<section class="<?php  echo( 'both' == $sidebar_pos ) ?'col-md-6 cntt-w':'col-md-8 cntt-w list-list-with-sidebar'; ?>">
			<article><?php 
	} ?>

	<div class="row-wrapper-x">		
        <div class="item">
			<div class="row"><?php
				// Get tab link
				$link1 = add_query_arg( 'tab', $list_tab1, $current_page );
				$link2 = add_query_arg( 'tab', $list_tab2, $current_page );

				// Declare tab variable
				$tab_all = $tab1_active = $tab2_active = $sortby = "";

				// Get and set active tab link
				$tabss = '';
				if( isset( $_GET['tab'] ) && $_GET['tab'] == $list_tab1 ){
				    // Active tab one
				    $tabss = $list_tab1;
				    $tab1_active = "class = active";
				} else if( isset( $_GET['tab'] ) && $_GET['tab']  == $list_tab2 ){
				    // Active tab two
				    $tabss = $list_tab2;
				    $tab2_active = "class = active";
				} else {
					// Active all tab
				    $tab_all = "class = active";
				    $tabss = '';
				}

				// Get property order
				$property_order_type = get_post_meta( $post->ID, 'property_order_type', true );

				// Get and set property order
				if( isset( $_GET['sortby'] ) ){
				    $sortby = $_GET['sortby'];
				} else {
					$sortby = $property_order_type;
				}

				// Get property status tab
				$tab_1 = '';
				$term = get_term_by( 'slug', $list_tab1, 'property_status' );
		        if( $term ){
		            $tab_1 = $term;
		        }

		        $tab_2 = '';
				$term = get_term_by( 'slug', $list_tab2, 'property_status' );
		        if( $term ){
		            $tab_2 = $term;
		        } ?>

				<div class="list-item-menu-inner col-xs-12 col-sm-12 col-md-12">
					<!-- Check tab is not disable and page is not search page -->
					<?php if( $list_tab != 'disable' && !is_page_template('templates/template_search.php') ){ ?>
					<ul class="nav nav-tabs pull-left" role="tablist">
					    <!-- All tab -->
					    <li role="presentation" <?php echo esc_attr( $tab_all ); ?> ><a href="<?php echo esc_url( $current_page ); ?>" ><?php esc_html_e( 'ALL', 'cityestate' ); ?></a></li>
					    <?php if( $list_tab1 != '0' ){ ?>
				            <!-- First tab -->
				            <li role="presentation" <?php echo esc_attr( $tab1_active ); ?> ><a href="<?php echo esc_url( $link1 ); ?>" ><?php echo esc_attr( $tab_1->name ); ?></a></li>
				        <?php } ?>
				        <!-- Second tab -->
				        <?php if( $list_tab2 != '0' ){ ?>
				            <li role="presentation" <?php echo esc_attr( $tab2_active ); ?> ><a href="<?php echo esc_url( $link2 ); ?>" ><?php echo esc_attr( $tab_2->name ); ?></a></li>
				        <?php } ?>	    		    
				  	</ul>
				  	<?php } ?>
				  	<div class="search-filter-form pull-right" id="search_label_options">
						<!-- Set property order -->
						<select id="property_sort" class="selectpicker" title="<?php esc_html_e( 'Default Order', 'cityestate' ); ?>" name="relevance">
							<!-- Property sort low to hign price -->
							<option <?php if( $sortby == 'sort_lh' ){ echo "selected"; } ?> value="sort_lh"><?php esc_html_e( 'Price (Low to High)', 'cityestate' ); ?></option>
				            <!-- Property sort hign to low price -->
				            <option <?php if( $sortby == 'sort_hl' ){ echo "selected"; } ?> value="sort_hl"><?php esc_html_e( 'Price (High to Low)', 'cityestate' ); ?></option>
				            <?php if( $featured_list != 'enable' ) { ?>
				                <option <?php if( $sortby == 'featured' ) { echo "selected"; } ?> value="featured"><?php esc_html_e( 'Featured', 'cityestate' ); ?></option>
				            <?php } ?>
				            <!-- Property sort new to old price -->
				            <option <?php if( $sortby == 'sort_no' ){ echo "selected"; } ?> value="sort_no"><?php esc_html_e( 'Date New to Old', 'cityestate' ); ?></option>
				            <!-- Property sort old to new price -->
				            <option <?php if( $sortby == 'sort_on' ){ echo "selected"; } ?> value="sort_on"><?php esc_html_e( 'Date Old to New', 'cityestate' ); ?></option>
						</select>			
				  	</div>
				  	<!-- Change property view -->
					<div class="pull-right list-style-change">
				        <!-- List property list view -->
				        <a href="javascript:void(0);" class="property_view_link property_list_view"><img src="<?php echo get_template_directory_uri() ?>/images/list-view.png" alt="List View"></a>
				        <!-- List property grid view -->
				        <a href="javascript:void(0);" class="property_view_link property_grid_view"><img src="<?php echo get_template_directory_uri() ?>/images/grid-view.png" alt="Grid View"></a>
				    </div>
				</div><?php
				// Declare global variable
				global $wp_query, $paged;

				// Check is front page
				if( is_front_page() ){
				    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
				}
				$tab_term = "";
				$tab_2 = '';
				if($tabss != ''){
					$term = get_term_by( 'slug', $tabss, 'property_status' );
			        if( $term ){
			            $tab_term = $term;
			        }
				}

				// Set property per page
				if( !$number_property_show ){
		            $posts_per_page  = 9;
		        } else {
		            $posts_per_page = $number_property_show;
		        }

		        // Collect and run property list query
		        if($tab_term == ''){
		        	$latest_listing_args = array( 
			        				'post_type' => 'property', 
			        				'posts_per_page' => $posts_per_page, 
			        				'paged' => $paged, 
			        				'post_status' => 'publish'
			        			);
		        }else{
			        $latest_listing_args = array( 
			        				'post_type' => 'property', 
			        				'posts_per_page' => $posts_per_page, 
			        				'paged' => $paged, 
			        				'post_status' => 'publish',
			        				'tax_query' => array(
										array(
											'taxonomy' => 'property_status',
											'field'    => 'slug',
											'terms'    => $tab_term->slug,
										),
									),
		        				);
		       	}
		        $latest_listing_args = apply_filters( 'cityestate_property_search', $latest_listing_args );

		        // Sort collected property
		        $latest_listing_args = cityestate_property_sort( $latest_listing_args );
		        $wp_query = new WP_Query( $latest_listing_args );        

				if( $wp_query->have_posts() ){
		            while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
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
											<?php } else {?>
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
							</div>
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
						endwhile;
				} else {
					// Show property not found
		            get_template_part( 'template-parts/property_none' );        
		        }
		        // Reset wp query
				wp_reset_postdata(); ?>
			</div>
		</div>
    </div><?php

    // Property pagination
    cityestate_pagination( $wp_query->max_num_pages, $range = 2 ); wp_reset_postdata();

    // Check have sidebar
	if( $have_sidebar ){
		echo "</article></section>";
	}

	// Right sidebar
	if( ('right' == $sidebar_pos) ){ ?>
		<aside class="col-md-4 sidebar" id="sidebar">
			<?php if( is_active_sidebar( $sidebar_type ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<!-- Get dynamic right sidebar -->
					<?php dynamic_sidebar( $sidebar_type ); ?>
				</div>
			<?php endif; ?>
		</aside>
	<?php } ?>
</section>

<?php get_footer(); ?>