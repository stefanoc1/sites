<?php

get_header();

// Set global variable
global $post, $tab_class;

// Add property image slider
get_template_part('template-parts/property-detail/top_slider'); ?>

<div class="property-breadcumb">
	<div class="container">
		<div class="pull-left">
			<ol class="breadcrumb"><?php
				echo cityestate_breadcrumb(); ?>
	        </ol>
		</div>
		<div class="pull-right">
			<ul class="list">
				<li><?php
					// Check property submit by user
					$property_submit_by_user = cityestate_option( 'property_submit_by_user' );
					if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
						// Set property favorite option
						echo include( get_template_directory() . '/template-parts/property_favorite.php' ); ?><?php esc_html_e( 'Add to Favorite', 'cityestate' );
					} ?>					
				</li><?php 
				// Check print property
				$show_print_property = cityestate_option( 'show_print_property' );
				// Set print property option
				if( $show_print_property != 0 ){ ?>
					<li>
						<a href="javascript(0);" id="print_property_detail" data-property-id="<?php echo esc_attr( $post->ID ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/property-detail/printer.png" alt="printer"/> <?php esc_html_e( 'Print this Page', 'cityestate' ); ?> </a>
					</li><?php
				} ?>
			</ul>
		</div>
	</div>
</div>

<!-- Set property basic detail -->
<?php get_template_part( 'template-parts/property-detail/top_basic_detail' ); ?>

<div class="property-items-blocks">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12 col-xs-12"><?php
				// Get property view type
				$property_view = cityestate_option('property_page_type');

				// Check property view is tab
				if( $property_view == "tabs" ){
					$tab_class = 'tab-pane fade';
					echo '<div class="tab-content">';
				}

				// Get property detail layout
				$property_layout = cityestate_option( 'property_detail_layout' );
				$property_layout = $property_layout['enabled'];

				// Get property description
				$property_description = apply_filters( 'the_content', $post->post_content );

				// Property layout is set
				if( $property_layout ): 
					// Run the loop
					foreach( $property_layout as $key => $value ){
						
						switch( $key ){
                        	// Property description section is active
                        	case 'description':
                        		if( !empty($property_description) ){
                        			get_template_part( 'template-parts/property-detail/description' );
                        		}
            				break;

            				// Property details section is active
            				case 'details':
            					get_template_part( 'template-parts/property-detail/details' );
            				break;

            				// Property floor plans section is active
            				case 'floor_plans':
            					get_template_part( 'template-parts/property-detail/floor_plans' );
            				break;

            				// Property documents section is active
            				case 'property_documents':
            					get_template_part( 'template-parts/property-detail/property_document' );
            				break;

            				// Property video section is active
            				case 'property_video':
            					get_template_part( 'template-parts/property-detail/property_video' );
            				break;

            				// Property near by place section is active
            				case 'near_by_place':
            					get_template_part( 'template-parts/property-detail/near-by_place' );
            				break;

            				// Property get directions section is active
            				case 'get_directions':
            					get_template_part( 'template-parts/property-detail/get_direction' );
            				break;

            				// Property share property section is active
            				case 'share_property':
            					get_template_part( 'template-parts/property-detail/share_property' );
            				break;

            				// Property similar property section is active
            				case 'similar_properties':
            					get_template_part( 'template-parts/property-detail/similar_property' );
            				break;
                        }
					}
                endif;

                // Close property layout tab
                if( $property_view == "tabs"){
					echo '</div>';
				} ?>
  			</div>
  			
  			<div class="col-md-4 col-sm-12 sidebar" id="sidebar"><?php
				// Check property single sidebar is active
				if( is_active_sidebar( 'single-property' ) ) : ?>
					<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
						<!-- Show single property sidebar -->
						<?php dynamic_sidebar( 'single-property' ); ?>
					</div><?php
				endif; ?>
			</div>			
  		</div>	
	</div>
</div>

<?php get_footer(); ?>