<?php
// Get current user info
global $current_user;
wp_get_current_user();
$user_id = $current_user->ID;

// Get property and package detail
$property_type  = cityestate_option( 'submit_property_type' );
$package_list   = get_the_author_meta( 'package_list' , $user_id );
$choose_package = cityestate_find_template_url('templates/template_package.php');

// Check is property submit page
if( is_page_template( 'templates/dashboard_submit_property.php' ) ){
        // Check has membership and check package status
        if( $property_type == 'membership' && $package_list != -1 && $package_list < 1 && is_user_logged_in() ){

            // Check user has membership
            if( !cityestate_user_active_membership($user_id) ){
                // User package status
                print
                '<div class="user_package_status">
                    <h4>' . esc_html__( 'You don\'t have any package! You need to buy your package.', 'cityestate' ) . '</h4>
                    <a href="' . $choose_package . '">' . esc_html__( 'Get Package', 'cityestate' ) . '</a>
                </div>';
            } else {
                // Upgrade package link
                print
                '<div class="user_package_status"><h4>' . esc_html__( 'Your current package doesn\'t let you publish more properties! You need to upgrade your membership.', 'cityestate' ) . '</h4>
                    <a href="' . $choose_package . '">' . esc_html__( 'Upgrade Package', 'cityestate' ) . '</a>
                </div>';
            }
        } else { ?>
        <!-- Submit property form -->
        <form id="form_submit_property" name="new_post" method="post" enctype="multipart/form-data" class="add-frontend-property">
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
                                            get_template_part('template-parts/submit-property/description');
                                        break;
                                         // Property location section
                                        case 'location':
                                            get_template_part('template-parts/submit-property/location');
                                        break;
                                        // Property detail section
                                        case 'details':
                                            get_template_part('template-parts/submit-property/details');
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
                                            get_template_part('template-parts/submit-property/media');
                                        break;                                        
                                        // Property feature section
                                        case 'features':
                                            get_template_part('template-parts/submit-property/features');
                                        break;
                                        // Property amenities section
                                        case 'amenities':
                                            get_template_part('template-parts/submit-property/amenities');
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
                                            get_template_part('template-parts/submit-property/essential_infomation');
                                        break;
                                        // Property flooring good section
                                        case 'flooring_goods_included':
                                            get_template_part('template-parts/submit-property/flooring_goods_included');
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
                                            get_template_part('template-parts/submit-property/interior_exterior');
                                        break;
                                        // Property room dimension section
                                        case 'room_dimensions':
                                            get_template_part('template-parts/submit-property/room_dimensions');
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
                                            get_template_part('template-parts/submit-property/floor_plans');
                                        break;                        
                                        // Property video section
                                        case 'property_video':
                                            get_template_part('template-parts/submit-property/property_video');
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
                                            get_template_part('template-parts/submit-property/near_by_place');
                                        break;
                                        // Property agent information section
                                        case 'agent_information':
                                            get_template_part('template-parts/submit-property/agent_information');
                                        break;

                                    }
                                }
                            } ?>
                    </div>

                     <div class="account-block text-right">
                        <!-- Submit property security -->
                        <?php wp_nonce_field( 'submit_property_security', 'submit_property_nonce' ); ?>
                        <input type="hidden" name="action" value="add_property"/>
                        <!-- Property featured type -->
                        <input type="hidden" name="property_featured" value="0"/>                
                        <!-- Property payment status -->
                        <input type="hidden" name="property_payment" value="not_paid"/>
                        <button <?php if( !is_user_logged_in() ){ ?> disabled="disabled" <?php } ?> type="submit" id="add_new_property" class="btn btn-primary"><?php esc_html_e( 'Submit Property', 'cityestate' ); ?></button>
                    </div>
                </div>
        </form><?php
    }
}