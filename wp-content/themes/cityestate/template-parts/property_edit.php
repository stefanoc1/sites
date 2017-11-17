<?php
// Check submit property page
if( is_page_template( 'templates/dashboard_submit_property.php' ) ){
    // Declare global variable
    global $current_user, $property_data, $property_meta;
    wp_get_current_user();

    // Get property id
    $edit_property_id = intval( trim( $_GET['edit_property'] ) );
    $property_data    = get_post( $edit_property_id );

    // Check property data is available
    if( ! empty( $property_data ) && ( $property_data->post_type == 'property' ) ){
        // Get property custom fields
        $property_meta = get_post_custom( $property_data->ID ); 
        ?>
        <form id="form_submit_property" name="new_post" method="post" enctype="multipart/form-data" class="update-frontend-property"><?php            
            // Get property submit layout
            $layout = cityestate_option( 'property_submit_layout' );
            $layout = $layout['enabled']; ?>

            <ul class="nav nav-tabs background-color-white submit-property-tabs">
                <li class="active"><a data-toggle="tab" href="#menu1">Basic Detail</a></li>
                <li><a data-toggle="tab" href="#menu2">Media &amp; Amenities</a></li>
                <li><a data-toggle="tab" href="#menu3">Essential Information</a></li>
                <li><a data-toggle="tab" href="#menu4">Room Dimensions</a></li>
                <li><a data-toggle="tab" href="#menu5">Floor Plan &amp; Videos</a></li>
                <li><a data-toggle="tab" href="#menu6">Near By Place</a></li>
            </ul>
            <?php
                // Get property submit layout
                $layout = cityestate_option('property_submit_layout');
                $layout = $layout['enabled']; ?>


                <div class="tab-content invoice-container submit-property-text">
                    <div id="menu1" class="tab-pane fade in active">
                        <?php
                            if( $layout ){

                                foreach( $layout as $key => $value ){

                                    switch( $key ){

                                        // Property description section
                                        case 'description':
                                            get_template_part('template-parts/edit-property/description');
                                        break;
                                         // Property location section
                                        case 'location':
                                            get_template_part('template-parts/edit-property/location');
                                        break;
                                        // Property detail section
                                        case 'details':
                                            get_template_part('template-parts/edit-property/details');
                                        break;

                                    }
                                }
                            } ?>
                    </div>

                    <div id="menu2" class="tab-pane fade">
                        <?php
                            if( $layout ){

                                foreach( $layout as $key => $value ){

                                    switch( $key ){
                                        
                                        // Property media section
                                        case 'media':
                                            get_template_part('template-parts/edit-property/media');
                                        break;
                                        // Property feature section
                                        case 'features':
                                            get_template_part('template-parts/edit-property/features');
                                        break;
                                        // Property amenities section
                                        case 'amenities':
                                            get_template_part('template-parts/edit-property/amenities');
                                        break;
                                    }
                                }
                            } ?>
                    </div>

                     <div id="menu3" class="tab-pane fade">
                        <?php

                            if( $layout ){

                                foreach( $layout as $key => $value ){

                                    switch( $key ){

                                         // Property essential information section
                                        case 'essential_infomation':
                                            get_template_part('template-parts/edit-property/essential_infomation');
                                        break;
                                        // Property flooring good section
                                        case 'flooring_goods_included':
                                            get_template_part('template-parts/edit-property/flooring_goods_included');
                                        break;

                                    }
                                }
                            } ?>
                    </div>

                    <div id="menu4" class="tab-pane fade">
                        <?php 

                            if( $layout ){

                                foreach( $layout as $key => $value ){

                                    switch( $key ){

                                        // Property interior and exterior section
                                        case 'interior_exterior':
                                            get_template_part('template-parts/edit-property/interior_exterior');
                                        break;
                                        // Property room dimension section
                                        case 'room_dimensions':
                                            get_template_part('template-parts/edit-property/room_dimensions');
                                        break;

                                    }
                                }
                            } ?>
                    </div>

                    <div id="menu5" class="tab-pane fade">
                        <?php

                            if( $layout ){

                                foreach( $layout as $key => $value ){

                                    switch( $key ){

                                        // Property floo plan section
                                        case 'floor_plans':
                                            get_template_part('template-parts/edit-property/floor_plans');
                                        break;                        
                                        // Property video section
                                        case 'property_video':
                                            get_template_part('template-parts/edit-property/property_video');
                                        break;
                                    }
                                }
                            } ?>
                    </div>
                    
                    <div id="menu6" class="tab-pane fade">
                        <?php  

                            if( $layout ){

                                foreach( $layout as $key => $value ){

                                    switch( $key ){

                                        // Property near by place section
                                        case 'near_by_place':
                                            get_template_part('template-parts/edit-property/near_by_place');
                                        break;
                                        // Property agent information section
                                        case 'agent_information':
                                            get_template_part('template-parts/edit-property/agent_information');
                                        break;

                                    }
                                }
                            } ?>
                    </div>
                    <div class="account-block text-right">
                        <!-- Edit property security -->
                        <?php wp_nonce_field( 'submit_property_security', 'submit_property_nonce' ); ?>
                        <input type="hidden" name="action" value="update_property"/>
                        <!-- Property id -->
                        <input type="hidden" name="property_id" value="<?php echo intval( $property_data->ID ); ?>"/>
                        <!-- Property featured type -->
                        <input type="hidden" name="property_featured" value="<?php if( isset( $property_meta['featured'] ) ) { echo sanitize_text_field( $property_meta['featured'][0] ); } ?>">
                        <!-- Property payment status -->
                        <input type="hidden" name="property_payment" value="<?php if( isset( $property_meta['payment_status'] ) ) { echo sanitize_text_field( $property_meta['payment_status'][0] ); } ?>"/>
                        <button type="submit" id="update_property" class="btn btn-primary"><?php esc_html_e( 'Update Property', 'cityestate' ); ?></button>
                    </div>
                </div>
            
        </form><?php
    }
}