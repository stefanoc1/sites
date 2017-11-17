<?php
// Submit property
add_filter('cityestate_submit_property', 'cityestate_submit_property_front');

if( !function_exists('cityestate_submit_property_front') ){
    function cityestate_submit_property_front($new_property){
        // Get current user info
        global $current_user;
        wp_get_current_user();
        $user_id = $current_user->ID;

        // Property approve by admin
        $admin_approved         = cityestate_option( 'admin_approve_submit_property' );
        $submit_property_type   = cityestate_option( 'submit_property_type' );

        // Property title
        if( isset( $_POST['property_title']) ){
            $new_property['post_title'] = sanitize_text_field( $_POST['property_title'] );
        }

        // Check user membership
        if( $submit_property_type == 'membership' ){
            $user_no_membership = isset($_POST['user_no_membership']) ? $_POST['user_no_membership'] : '';
        } else {
            $user_no_membership = 'no';
        }

        // Property description
        if( isset( $_POST['property_desc'] ) ){
            $new_property['post_content'] = wp_kses_post( $_POST['property_desc'] );
        }

        // Property author
        $new_property['post_author'] = $user_id;

        // Property action
        $property_action = $_POST['action'];
        $property_id = 0;

        // Check property is add or edit
        if( $property_action == 'add_property' ){
            // Property approve by admin
            if( $admin_approved != 'yes' && ( $submit_property_type == 'no' || $submit_property_type = 'membership' ) ){
                if( $user_no_membership == 'yes' ){
                    $new_property['post_status'] = 'draft';
                } else {
                    $new_property['post_status'] = 'publish';
                }
            } else {
                if( $user_no_membership == 'yes' && $submit_property_type = 'membership' ){
                    $new_property['post_status'] = 'draft';
                } else {
                    $new_property['post_status'] = 'pending';
                }
            }

            // Property id
            $property_id = wp_insert_post( $new_property );

            if( $property_id > 0 ){
                $submitted_successfully = true;
                if( $submit_property_type == 'membership'){
                    // Update user package
                    cityestate_update_user_package_listing( $user_id );
                }
                do_action( 'wp_insert_post', 'wp_insert_post' );
            }
        } else if( $property_action == 'update_property' ){
            // Update property
            $new_property['ID'] = intval( $_POST['property_id'] );            
            $property_id = wp_update_post( $new_property );

            if( $property_id > 0 ){
                $updated_successfully = true;
            }
        }

        // Check property id is set
        if( $property_id > 0 ){
            // Check user membership
            if( $user_no_membership == 'yes' ){
                update_user_meta( $user_id, 'user_no_membership', $property_id );
            }
            
            // Property type
            if( isset( $_POST['property_type'] ) && $_POST['property_type'] != 1 ){
                wp_set_object_terms( $property_id, $_POST['property_type'], 'property_type' );
            }

            // Property status
            if( isset( $_POST['property_status'] ) && $_POST['property_type'] != 1 ){
                wp_set_object_terms( $property_id, $_POST['property_status'], 'property_status' );
            }

            // Property extra status
            if( isset( $_POST['property_label'] ) && $_POST['property_type'] != 1 ){
                wp_set_object_terms( $property_id, $_POST['property_label'], 'property_label' );
            }

            // Property orice
            if( isset( $_POST['property_price'] ) ){
                update_post_meta( $property_id, 'property_price', sanitize_text_field( $_POST['property_price'] ) );
                // Property price label
                if( isset( $_POST['property_price_label'] ) ){
                    update_post_meta( $property_id, 'property_price_postfix', sanitize_text_field( $_POST['property_price_label']) );
                }
            }

            // Property second price
            if( isset( $_POST['property_second_price'] ) ){
                update_post_meta( $property_id, 'property_second_price', sanitize_text_field( $_POST['property_second_price'] ) );
            }

            // Property images
            if( isset( $_POST['propperty_image_ids'] ) ){                
                if( !empty($_POST['propperty_image_ids']) && is_array($_POST['propperty_image_ids']) ){
                    $property_image_ids = array();
                    foreach( $_POST['propperty_image_ids'] as $property_img_id ){
                        $property_image_ids[] = intval( $property_img_id );
                        add_post_meta( $property_id, 'property_images', $property_img_id );
                    }
                    // Property featured image
                    if( isset( $_POST['featured_image_id'] ) ){
                        $featured_image_id = intval( $_POST['featured_image_id'] );
                        if( in_array( $featured_image_id, $property_image_ids ) ){
                            update_post_meta( $property_id, '_thumbnail_id', $featured_image_id );
                        }
                    } elseif( ! empty ( $property_image_ids ) ){
                        update_post_meta( $property_id, '_thumbnail_id', $property_image_ids[0] );
                    }
                }                
            }

            // Property id
            $generate_property_id = cityestate_option('generate_property_id');
            if( $generate_property_id != 1 ){
                if( isset($_POST['property_id']) ){
                    update_post_meta( $property_id, 'property_id', sanitize_text_field($_POST['property_id']) );
                }
            } else {
                update_post_meta( $property_id, 'property_id', $property_id );
            }

            // Property area size
            if( isset( $_POST['property_size'] ) ){
                update_post_meta( $property_id, 'property_size', sanitize_text_field( $_POST['property_size'] ) );
            }

            // Property area size prefix
            if( isset( $_POST['property_size_prefix'] ) ){
                update_post_meta( $property_id, 'property_size_prefix', sanitize_text_field( $_POST['property_size_prefix'] ) );
            }

            // Property bedrooms
            if( isset( $_POST['property_beds'] ) ){
                update_post_meta( $property_id, 'property_bedrooms', sanitize_text_field( $_POST['property_beds'] ) );
            }

            // Property bathrooms
            if( isset( $_POST['property_baths'] ) ){
                update_post_meta( $property_id, 'property_bathrooms', sanitize_text_field( $_POST['property_baths'] ) );
            }

            // Property garage
            if( isset( $_POST['property_garage'] ) ){
                update_post_meta( $property_id, 'property_garages', sanitize_text_field( $_POST['property_garage'] ) );
            }

            // Property year built
            if( isset( $_POST['property_year_built'] ) ){
                update_post_meta( $property_id, 'property_year', sanitize_text_field( $_POST['property_year_built'] ) );
            }

            // Property short address
            if( isset( $_POST['property_short_address'] ) ){
                update_post_meta( $property_id, 'property_address', sanitize_text_field( $_POST['property_short_address'] ) );
            }            

            // Property map address
            if( isset( $_POST['property_map_address'] ) ){
                update_post_meta( $property_id, 'property_map_address', sanitize_text_field( $_POST['property_map_address'] ) );
            }

            // Property area
            if( isset( $_POST['property_area'] ) && $_POST['property_type'] != 1 ){
                $property_area = sanitize_text_field( $_POST['property_area'] );
                wp_set_object_terms( $property_id, $property_area, 'property_area' );
            }

            // Property city
            if( isset( $_POST['property_city'] ) && $_POST['property_type'] != 1 ){
                $property_city = sanitize_text_field( $_POST['property_city'] );
                wp_set_object_terms( $property_id, $property_city, 'property_city' );
            }

            // Property location
            if( isset( $_POST['property_location'] ) && $_POST['property_type'] != 1 ){
                $property_location = sanitize_text_field( $_POST['property_location'] );
                wp_set_object_terms( $property_id, $property_location, 'property_location' );
            }

            // Property postal code
            if( isset( $_POST['postal_code'] ) ){
                update_post_meta( $property_id, 'property_zip', sanitize_text_field( $_POST['postal_code'] ) );
            }

            // Property latitude and longitude
            if( ( isset($_POST['latitude']) && !empty($_POST['latitude']) ) && (  isset($_POST['longitude']) && !empty($_POST['longitude'])  ) ){
                
                $latitude           = sanitize_text_field( $_POST['latitude'] );
                $longitude          = sanitize_text_field( $_POST['longitude'] );
                $street_view        = sanitize_text_field( $_POST['property_google_street_view'] );
                $latitude_longitude = $latitude.','.$longitude;
                
                update_post_meta( $property_id, 'property_location', $latitude_longitude );
                update_post_meta( $property_id, 'property_street_view', $street_view );
            }

            // Property features
            if( isset( $_POST['property_features'] ) ){
                $features_array = array();
                foreach( $_POST['property_features'] as $feature_id ){
                    $features_array[] = intval( $feature_id );
                }
                wp_set_object_terms( $property_id, $features_array, 'property_feature' );
            }

            // Property amenities
            if( isset( $_POST['property_amenities'] ) ){
                $property_amenities = $_POST['property_amenities'];
                if( !empty($property_amenities) ){
                    update_post_meta( $property_id, 'propertyamenities', $property_amenities );
                }
            }

            // Property essntial information detail
            if( isset( $_POST['property_info'] ) ){
                $property_info = $_POST['property_info'];
                if( !empty($property_info) ){
                    update_post_meta( $property_id, 'property_info', $property_info );                    
                }
            }

            // Property flooring detail
            if( isset( $_POST['property_flooring'] ) ){
                update_post_meta( $property_id, 'flooring_detail', sanitize_text_field( $_POST['property_flooring'] ) );
            }

            // Property goods detail
            if( isset( $_POST['property_goods'] ) ){
                update_post_meta( $property_id, 'goods_detail', sanitize_text_field( $_POST['property_goods'] ) );
            }

            // Property interior and exterior detail
            if( isset( $_POST['interior_exterior'] ) ){
                $interior_exterior = $_POST['interior_exterior'];
                if( ! empty( $interior_exterior ) ){
                    update_post_meta( $property_id, 'interior_exterior', $interior_exterior );
                }
            }

            // Property room dimensions detail
            if( isset( $_POST['room_dimensions'] ) ){
                $room_dimensions = $_POST['room_dimensions'];
                if( ! empty( $room_dimensions ) ){
                    update_post_meta( $property_id, 'room_dimensions', $room_dimensions );                    
                }
            }

            // Property floor plans
            if( isset( $_POST['floor_plans'] ) ){
                $floor_plans_post = $_POST['floor_plans'];
                if( ! empty( $floor_plans_post ) ){
                    update_post_meta( $property_id, 'floor_plans', $floor_plans_post );
                }
            }

            // Property video url
            if( isset( $_POST['property_video_url'] ) ){
                update_post_meta( $property_id, 'property_video_url', sanitize_text_field( $_POST['property_video_url'] ) );
            }

            // Property video image
            if( isset( $_POST['property_video_image'] ) ){
                update_post_meta( $property_id, 'property_video_image', sanitize_text_field( $_POST['property_video_image'] ) );
            }

            // Property near by place
            if( isset( $_POST['near_by_place'] ) ){
                update_post_meta( $property_id, 'near_by_place', $_POST['near_by_place'] );
            }

            // Property agent
            if( isset( $_POST['property_agent_display'] ) ){

                $prop_property_agent_display = sanitize_text_field( $_POST['property_agent_display'] );
                // Set property agent
                if( $prop_property_agent_display == 'agent_info' ){
                    $prop_agent = sanitize_text_field( $_POST['agents'] );
                    update_post_meta( $property_id, 'property_agent_display', $prop_property_agent_display );
                    update_post_meta( $property_id, 'agents', $prop_agent );
                } else {
                    update_post_meta( $property_id, 'property_agent_display', $prop_property_agent_display );
                }
            } else {
                update_post_meta( $property_id, 'property_agent_display', 'author_info' );
            }

            // Property make featured
            if( isset( $_POST['property_featured'] ) ){
                $featured = intval( $_POST['property_featured'] );
                update_post_meta( $property_id, 'featured', $featured );
            }

            // Property payment
            if( isset( $_POST['property_payment'] ) ){
                $property_payment = sanitize_text_field( $_POST['property_payment'] );
                update_post_meta( $property_id, 'fc_payment_status', $property_payment );
            }            
        }
        return $property_id;
    }
}

// Required field
if( !function_exists('cityestate_required_field') ){
    
    function cityestate_required_field( $sign, $attribute = false ){
        // Required field sign
        if( $sign != 0 ){
            return '*';
        }
        if( $attribute ){
            return 'required';
        }
        return '';
    }
}

// Get property category for submit or update property
if( !function_exists('cityestate_submit_hirarchical_options') ){
    
    function cityestate_submit_hirarchical_options( $cat_name, $cat_terms, $term_id, $prefix = " " ){
        // Check category is set
        if( !empty($cat_terms) ){
            // Run loop
            foreach( $cat_terms as $term ){                
                // Check category id is set
                if( $term_id == $term->term_id ){                    
                    echo '<option value="' . $term->name . '" selected="selected">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->name . '">' . $prefix . $term->name . '</option>';
                }
                // Check child category
                $child_terms = get_terms( $cat_name, array( 'hide_empty' => false, 'parent' => $term->term_id ) );
                // Check child terms is set
                if( !empty($child_terms) ){
                    cityestate_submit_hirarchical_options( $cat_name, $child_terms, $term_id, "- ".$prefix );
                }
            }
        }
    }
}

// Cityestate upload image for property
if( !function_exists( 'cityestate_upload_property_image' ) ){

    function cityestate_upload_property_image(){
        // Property add image verify nonce
        $property_image_nonce = $_REQUEST['upload_nonce'];
        if( ! wp_verify_nonce( $property_image_nonce, 'property_allow_upload' ) ){
            // Return failed with reason
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'Security check failed!', 'cityestate' ) );
            echo json_encode( $ajax_response );
            die;
        }

        // Get selected files
        $upload_file    = $_FILES['property_upload_file'];
        $upload_image   = wp_handle_upload( $upload_file, array( 'test_form' => false ) );
        // Is selected images for property image
        if( isset( $upload_image['file'] ) ){            
            // Check media file type
            $image_name  = basename( $upload_file['name'] );
            $image_type  = wp_check_filetype( $upload_image['file'] );

            // Collect the values for upload image
            $attachment_details = array(
                'guid'           => $upload_image['url'],
                'post_mime_type' => $image_type['type'],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $image_name ) ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            // Get image id and detail
            $image_attach_id      = wp_insert_attachment( $attachment_details, $upload_image['file'] );
            $image_attach_data    = wp_generate_attachment_metadata( $image_attach_id, $upload_image['file'] );
            
            // Update media metadata
            wp_update_attachment_metadata( $image_attach_id, $image_attach_data );

            // Image thumbnail and full image url
            $image_url  = wp_get_attachment_image_src( $image_attach_id, 'full' );

            // Return success with image detail
            $ajax_response = array( 'success' => true, 'image_url' => $image_url[0], 'attachment_id' => $image_attach_id );
            echo json_encode( $ajax_response );
            die;
        } else {
            // Return failed with reason
            $ajax_response = array( 'success' => false, 'reason' => esc_html__( 'Image upload failed!', 'cityestate' ) );
            echo json_encode( $ajax_response );
            die;
        }
    }
}
add_action( 'wp_ajax_cityestate_upload_property_image', 'cityestate_upload_property_image' );

// Cityestate remove property image
if( !function_exists('remove_gallery_image') ){
    
    function remove_gallery_image(){
        // Property remove image verify nonce
        $remove_nonce = $_POST['remove_nonce'];
        if( !wp_verify_nonce( $remove_nonce, 'property_allow_upload' ) ){
            // Return failed with reason
            $ajax_response = array( 'attachment_remove' => false, 'reason' => esc_html__( 'Security Check Failed!', 'cityestate' ) );
            echo json_encode($ajax_response);
            wp_die();
        }
        // Define variable
        $post_meta_removed  = false;
        $attachment_removed = false;

        if( isset($_POST['thumbnail_id']) && isset($_POST['property_id']) ){
            // Filter the thumbnail and property id
            $attachment_id  = intval($_POST['thumbnail_id']);
            $property_id    = intval($_POST['property_id']);            
            if( $attachment_id > 0 && $property_id > 0 ){
                echo "<br> 1";
                $attachment_removed = wp_delete_attachment( $attachment_id );
                // Delete property image meta
                $post_meta_removed  = delete_post_meta( $property_id, 'cityestate_property_images', $attachment_id );                
            } elseif( $attachment_id > 0 ){
                // Image attachment delete
                if( false == wp_delete_attachment( $attachment_id ) ){
                    $attachment_removed = false;
                } else {
                    $attachment_removed = true;
                }
            }
        }
        // Return failed with reason
        $ajax_response = array( 'attachment_remove' => $attachment_removed );
        echo json_encode($ajax_response);
        wp_die();
    }
}
add_action( 'wp_ajax_remove_gallery_image', 'remove_gallery_image' );

// Get property category for submit or update property
if( !function_exists('cityestate_edit_hierarchichal_options') ){
    
    function cityestate_edit_hierarchichal_options( $property_id, $cat_name ){
        // Declare variable
        $exist_term_id = 0;
        $tax_terms = get_the_terms( $property_id, $cat_name );
        // Check terms
        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $exist_term_id = $tax_term->term_id;
                break;
            }
        }

        // Check exit category
        $exist_term_id = intval($exist_term_id);
        if( $exist_term_id == 0 || empty($exist_term_id) ){
            echo '<option value="" selected="selected">'.esc_html__( 'None', 'cityestate').'</option>';            
        } else {
            echo '<option value="">'.esc_html__( 'None', 'cityestate').'</option>';            
        }

        // Get parent terms
        $top_level_terms = get_terms( array( $cat_name ), array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'parent' => 0 ) );
        // Get child terms
        cityestate_submit_hirarchical_options( $cat_name, $top_level_terms, $exist_term_id );
    }
}

// Get taxonomy by post id and taxonomy name
if( !function_exists('cityestate_category_by_property_id') ){
    
    function cityestate_category_by_property_id( $property_id, $cat_name ){
        // Get category
        $tax_terms = get_the_terms( $property_id, $cat_name );
        $tax_name = '';
        // Check category is set
        if( !empty($tax_terms) ){
            foreach( $tax_terms as $tax_term ){
                $tax_name = $tax_term->name;
                break;
            }
        }
        return $tax_name;
    }
}

// Propert edit near by place options
if( !function_exists('cityestate_edit_near_place_options') ){
    
    function cityestate_edit_near_place_options( $place_type ){
        // Check place type
        if( empty($place_type) ){
            echo '<option value="" selected="selected">'.esc_html__( 'None', 'cityestate').'</option>';            
        } else {
            echo '<option value="">'.esc_html__( 'None', 'cityestate').'</option>';            
        }

        // Get near by place info
        $cityestate_near_by_places = cityestate_near_by_places();
        if( !empty($cityestate_near_by_places) ){
            foreach( $cityestate_near_by_places as $key => $value ){
                if( $place_type == $key ){
                    echo '<option value="' . $key . '" selected="selected">' . sprintf( esc_html__( '%s', 'cityestate' ), $value ) . '</option>';
                } else {
                    echo '<option value="' . $key . '">' . sprintf( esc_html__( '%s', 'cityestate' ), $value ) . '</option>';
                }                
            }
        }
    }
}

?>