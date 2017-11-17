<?php 
global $post; 

// Get property detail tab
$layout_tabs = cityestate_option( 'property_detail_layout_tabs' );
$layout_tabs = $layout_tabs['enabled'];

// Property detail layout
$detail_layout = cityestate_option( 'property_detail_layout' );
$detail_layout = $detail_layout['enabled'];
?>
<section class="property-detail-description">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="property-title">
					<!-- Show property title -->
					<h3 class="property-title"><?php the_title(); ?></h3>
					<!-- Property featured label -->
					<?php echo include( get_template_directory() . '/template-parts/property_featured_label.php'); ?>
				</div>
				<ul class="property-basic-info">
					<!-- Property detail -->
					<?php echo cityestate_basic_info(); ?>
				</ul>
				<div class="property-desc">
					<!-- Property neighborhood -->
					<?php echo include( get_template_directory() . '/template-parts/property_neighborhood_label.php'); ?>
					<!-- Property agent name -->
					<?php echo include( get_template_directory() . '/template-parts/property_agent_name.php'); ?>
				</div>
			</div>
			<div class="col-md-2 property-border-1">
				<!-- Property map icon -->
				<img class="property-mapicon" src="<?php echo get_template_directory_uri(); ?>/images/details-map-icon.png" alt="mapicon" />
				<?php
				// Get property address
				$property_address = get_post_meta( get_the_ID(), 'property_address', true );
				if( !empty($property_address) ){ ?>
					<!-- Property address -->
					<p class="property-address"><?php printf( esc_html__( '%s', 'cityestate' ), $property_address); ?></p><?php
				} 
				if( in_array('Get Directions', $layout_tabs) || in_array('Get Directions', $detail_layout) ){ ?>
					<!-- Property direction -->
					<a class="property-directions" href="#get_directions"><?php esc_html_e( 'Get Directions','cityestate' ); ?></a><?php
				} ?>
			</div>
			<div class="col-md-2 poperty-border-2">
				<!-- Property status label -->
				<?php echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
				<!-- Property price -->
				<?php echo cityestate_get_property_price( 'property_detail' ); ?>
			</div>
			<div class="col-md-12">
				<div class="property-detail-bars"><?php
					// Check property view
					$property_view 			= cityestate_option( 'property_page_type' );
					
					// Get property description
					$property_description 	= apply_filters( 'the_content', $post->post_content );

					// Show property detail in tabs
					if( $property_view == "tabs" ){ ?>
						<ul class="property-detail nav nav-tabs"><?php
							if( $layout_tabs ):
								// Set counter
								$i = 0;
								$li_end = '</li>';
								// Run the tab loop
								foreach( $layout_tabs as $key => $value ){
									// Set active tab
									if( $i == 1 ){ 
										$li_start = '<li class="active">'; 
									} else { 
										$li_start = '<li>'; 
									}
									switch( $key ){
										// Property description
										case 'description':
											if( !empty($property_description) ){
			                        			echo $li_start; ?><a data-toggle="tab" href="#description"><?php esc_html_e( 'Description','cityestate' ); ?></a><?php echo $li_end;
			                        		}
			            				break;
			            				// Property detail
			            				case 'details':
			            					echo $li_start; ?><a data-toggle="tab" href="#details"><?php esc_html_e( 'Details','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property floor plan
			            				case 'floor_plans':
			            					echo $li_start; ?><a data-toggle="tab" href="#floor_plans"><?php esc_html_e( 'Floor Plans','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property document
			            				case 'property_documents':
			            					echo $li_start; ?><a data-toggle="tab" href="#property_documents"><?php esc_html_e( 'Property Documents','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property video
			            				case 'property_video':
			            					echo $li_start; ?><a data-toggle="tab" href="#property_video"><?php esc_html_e( 'Property Video','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property near by place
			            				case 'near_by_place':
			            					echo $li_start; ?><a data-toggle="tab" href="#near_by_place"><?php esc_html_e( 'Near By Place','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property direction
			            				case 'get_directions':
			            					echo $li_start; ?><a data-toggle="tab" href="#get_directions"><?php esc_html_e( 'Get Directions','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property share social media
			            				case 'share_property':
			            					echo $li_start; ?><a data-toggle="tab" href="#share_property"><?php esc_html_e( 'Share This Property','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			            				// Property similar property
			            				case 'similar_properties':
			            					echo $li_start; ?><a data-toggle="tab" href="#similar_properties"><?php esc_html_e( 'Similar Properties','cityestate' ); ?></a><?php echo $li_end;
			            				break;
			                        }
								}
		                	endif; ?>
		                </ul><?php
					} else { ?>
						<ul class="property-detail-tabs"><?php
							// Check property detail
							if( $detail_layout ):
								// Run the detail loop
								foreach( $detail_layout as $key => $value ){
									switch( $key ){
										// Property description
										case 'description':
											if( !empty($property_description) ){
			                        			?> <li><a href="#description"><?php esc_html_e( 'Description','cityestate' ); ?></a></li> <?php
			                        		}
			            				break;
			            				// Property detail
			            				case 'details':
			            					?> <li><a href="#details"><?php esc_html_e( 'Details','cityestate' ); ?></a></li> <?php
			            				break;			            				
			            				// Property floor plan
			            				case 'floor_plans':
			            					?> <li><a href="#floor_plans"><?php esc_html_e( 'Floor Plans','cityestate' ); ?></a></li> <?php
			            				break;
			            				// Property documents
			            				case 'property_documents':
			            					?> <li><a href="#property_documents"><?php esc_html_e( 'Property Documents','cityestate' ); ?></a></li> <?php
			            				break;			            				
			            				// Property video
			            				case 'property_video':
			            					?> <li><a href="#property_video"><?php esc_html_e( 'Property Video','cityestate' ); ?></a></li> <?php
			            				break;
			            				// Property near by place
			            				case 'near_by_place':
			            					?> <li><a href="#near_by_place"><?php esc_html_e( 'Near By Place','cityestate' ); ?></a></li> <?php
			            				break;
			            				// Property direction
			            				case 'get_directions':
			            					?> <li><a href="#get_directions"><?php esc_html_e( 'Get Directions','cityestate' ); ?></a></li> <?php
			            				break;
			            				// Property share social media
			            				case 'share_property':
			            					?> <li><a href="#share_property"><?php esc_html_e( 'Share This Property','cityestate' ); ?></a></li> <?php
			            				break;
			            				// Property similar property
			            				case 'similar_properties':
			            					?> <li><a href="#similar_properties"><?php esc_html_e( 'Similar Properties','cityestate' ); ?></a></li> <?php
			            				break;
			                        }
								}
		                	endif; ?>
		                </ul><?php
	                } ?>					
				</div>
			</div>
		</div>
	</div>
</section>