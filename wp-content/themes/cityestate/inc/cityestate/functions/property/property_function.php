<?php

// Get property header map
if( !function_exists('cityestate_header_map_list') ){

    function cityestate_header_map_list(){

        // Declare variable
        $property_data = $meta_qry = $tax_qry = $date_qry = array();
        
        // Get selected city
        $city = isset($_POST['city']) ? $_POST['city'] : '';

        // Basic query
        $query_args = array( 'post_type' => 'property', 'posts_per_page' => -1, 'post_status' => 'publish' );

        // Meta query
        $meta_qry[] = array( 'key' => 'property_map_address', 'compare' => 'EXISTS' );

        // Taxonomy query
        if( !empty($city) ){
            $tax_qry[] = array( 'taxonomy' => 'property_city', 'field' => 'slug', 'terms' => $city );
        }
        
        // Count taxonomy query
        $tax_count = count( $tax_qry );
        if( $tax_count > 0 ){
            $query_args['tax_query'] = $tax_qry;
        }

        // Run query
        $query_args = new WP_Query( $query_args );

        while( $query_args->have_posts() ): $query_args->the_post();
            // get property details
            $property_id        = get_the_ID();
            $property_lat_lng   = explode( ',', $property_location );
            $property_location  = get_post_meta( get_the_ID(), 'property_location', true );
            $property_type      = wp_get_post_terms( get_the_ID(), 'property_type', array( 'fields' => 'ids' ) );

            // Declare class
            $property_object = new stdClass();

            // Set property lat and lng
            $property_object->lat = $property_lat_lng[0];
            $property_object->lng = $property_lat_lng[1];
            
            // Set property thumbnail image
            $property_object->thumbnail = get_the_post_thumbnail( $property_id, 'cityestate_property_thumb_view' );
            
            // Set property featured image
            $property_featured = get_post_meta( get_the_ID(), 'featured', true );
            if( $property_featured != 0 ){
                $property_object->property_featured = '<span class="featured-label">'.esc_html__( 'FEATURED', 'cityestate' ).'</span>';
            } else {
                $property_object->property_featured = '';
            }

            // Set property status
            $property_status = cityestate_category_detail('property_status','names');
            if( !empty($property_status) ){
                $property_object->property_status = '<span class="status-label">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_status ).'</span>';
            } else {
                $property_object->property_status = '';
            }

            // Set property label
            $property_label = cityestate_category_detail('property_label','names');
            if( !empty($property_label) ){
                $property_object->property_label = '<span class="label-label">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_label ).'</span>';
            } else {
                $property_object->property_label = '';
            }

            // Set property title
            $property_object->title    = get_the_title();
            
            // Set property link
            $property_object->url      = get_permalink();
            
            // Set property address
            $property_address = get_post_meta( get_the_ID(), 'property_address', true );
            if( !empty($property_address) ){
                $property_object->property_address = '<p class="property-box1-address">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_address).'</p>';
            } else {
                $property_object->property_address = '';
            }

            // Set property basic data
            $property_object->property_basic_deta  = cityestate_basic_info();            
            
            // Set property listing price
            $property_object->property_price       = cityestate_get_property_price();

            foreach( $property_type as $term_id ){
                // Set property icon
                $property_icon = get_term_meta( $term_id, 'property_type_icon', true );
                
                // Check property normal icon is available
                if( !empty($property_icon['url']) ){
                    $property_object->icon = $property_icon['url'];
                } else {
                    $property_object->icon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }

                // Set property retina icon
                $property_retina_icon = get_term_meta( $term_id, 'property_type_icon_retina', true );
                
                // Check property retina icon is available
                if( !empty($property_retina_icon['url']) ){
                    $property_object->retinaIcon = $property_retina_icon['url'];
                } else {
                    $property_object->retinaIcon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }
            }
            // Collect into array
            array_push( $property_data, $property_object );

        endwhile;
        // Reset wp query
        wp_reset_postdata();

        // Check property is found
        if( count($property_data) > 0 ){
            // Return property data
            echo json_encode( array( 'status' => true, 'property_data' => $property_data ) );
            exit();
        } else {
            // Return failed message
            echo json_encode( array( 'status' => false ) );
            exit();
        }
    }
}
add_action( 'wp_ajax_nopriv_cityestate_header_map_list', 'cityestate_header_map_list' );
add_action( 'wp_ajax_cityestate_header_map_list', 'cityestate_header_map_list' );


// Property info box
if( !function_exists('property_marker_info_box') ){
    
    function property_marker_info_box(){

        // Check security
        check_ajax_referer( 'cityestate_map_ajax_nonce', 'security' );

        // Get property id
        $property_id = isset( $_POST['property_id'] ) ? sanitize_text_field($_POST['property_id']) : '';

        // Call the property query
        $args = array( 'p' => $property_id, 'posts_per_page' => 1, 'post_type' => 'property', 'post_status' => 'publish' );
        $property_query = new WP_Query($args);
        
        // Declare array
        $property_data = array();

        while( $property_query->have_posts() ){

            $property_query->the_post();

            // Get property detail
            $property_id        = get_the_ID();
            $property_type      = wp_get_post_terms( get_the_ID(), 'property_type', array( "fields" => "ids" ) );
            $property_location  = get_post_meta( get_the_ID(), 'property_location', true );
            $property_lat_lng   = explode( ',', $property_location );
            
            // Set property object
            $property_object = new stdClass();

            // Set property featured image
            $property_object->thumbnail = get_the_post_thumbnail( $property_id, 'cityestate_property_thumb_view' );
            
            // Set property link
            $property_object->url = get_permalink();

            // Set property price
            $property_object->property_basic_deta  = cityestate_basic_info();            
            $property_object->property_price       = cityestate_get_property_price();

            // Set property title
            $property_object->title = get_the_title();

            // Set property lat and lng
            $property_object->lat = $property_lat_lng[0];
            $property_object->lng = $property_lat_lng[1];

            // Set property address
            $property_address = get_post_meta( get_the_ID(), 'property_address', true );
            if( !empty($property_address) ){
                $property_object->property_address = '<p class="property-box1-address">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_address).'</p>';
            } else {
                $property_object->property_address = '';
            }

            // Set property featured status
            $property_featured = get_post_meta( get_the_ID(), 'featured', true );
            if( $property_featured != 0 ){
                $property_object->property_featured = '<span class="featured-label">'.esc_html__( 'FEATURED', 'cityestate' ).'</span>';
            } else {
                $property_object->property_featured = '';
            }

            // Set property status
            $property_status = cityestate_category_detail( 'property_status', 'names' );
            if( !empty($property_status) ){
                $property_object->property_status = '<span class="status-label">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_status ).'</span>';
            } else {
                $property_object->property_status = '';
            }

            // Set property label
            $property_label = cityestate_category_detail( 'property_label','names' );
            if( !empty($property_label) ){
                $property_object->property_label = '<span class="label-label">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_label ).'</span>';
            } else {
                $property_object->property_label = '';
            }
            
            // Set property icon
            foreach( $property_type as $term_id ){

                // Get property icon and retina icon
                $property_icon          = get_term_meta( $term_id, 'property_type_icon', true );
                $property_retina_icon   = get_term_meta( $term_id, 'property_type_icon_retina', true );

                // Check icon is available
                if( !empty($property_icon['url']) ){
                    $property_object->icon = $property_icon['url'];
                } else {
                    $property_object->icon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }

                // Set retina icon is available
                if( !empty($property_retina_icon['url']) ){
                    $property_object->retinaIcon = $property_retina_icon['url'];
                } else {
                    $property_object->retinaIcon = get_template_directory_uri() . '/images/map/pin-single-family.png';
                }
            }
            // Collect info in array
            array_push($property_data, $property_object);
        }

        wp_reset_postdata();

        // Return the status and data
        if( count($property_data) > 0 ){
            echo json_encode( array( 'status' => true, 'property_data' => $property_data ) );
            exit();
        } else {
            echo json_encode( array( 'status' => false ) );
            exit();
        }
        die();
    }
}
add_action( 'wp_ajax_nopriv_property_marker_info_box', 'property_marker_info_box' );
add_action( 'wp_ajax_property_marker_info_box', 'property_marker_info_box' );

// Add or remove favorite property
if( !function_exists( 'cityestate_favorite_property' ) ){
    
    function cityestate_favorite_property(){
        
        // Get current user info
        global $current_user;
        wp_get_current_user();

        // Get user id and property id
        $user_id     = $current_user->ID;
        $property_id = intval( $_POST['property_id'] );

        // Get new and current favorite property
        $save_favorite = 'cityestate_favorites_'.$user_id;
        $add_favorite  = get_option( 'cityestate_favorites_'.$user_id );        

        // Check favorite property field is empty or not
        if( empty( $add_favorite ) ){            
            // Add favorite property
            $property_favorite = array();
            $property_favorite['1'] = $property_id;
            
            // Update favorite property option
            update_option( $save_favorite, $property_favorite );
            
            // Return success message
            $attr = array( 'add' => true, 'response' => esc_html__( 'Added', 'cityestate' ) );            
            echo json_encode($attr);            
            wp_die();
        } else {
            
            if( !in_array( $property_id, $add_favorite ) ){                
                // Add favorite property
                $add_favorite[] = $property_id;
                
                // Update favorite property option
                update_option( $save_favorite,  $add_favorite );
                
                // Return success message
                $attr = array( 'add' => true, 'response' => esc_html__( 'Added', 'cityestate' ) );                
                echo json_encode($attr);
                wp_die();
            } else {                
                // Remove favorite property
                $key = array_search( $property_id, $add_favorite );

                // Remove favorite property from array
                if( $key != false ){
                    unset( $add_favorite[$key] );
                }
                // Update favorite property option
                update_option( $save_favorite, $add_favorite );

                // Return success message
                $attr = array( 'add' => false, 'response' => esc_html__( 'Removed', 'cityestate' ) );                
                echo json_encode($attr);
                wp_die();
            }
        }
    }
}
add_action( 'wp_ajax_cityestate_favorite_property', 'cityestate_favorite_property' );

// Save property search result
if( !function_exists('cityestate_save_search') ){
    
    function cityestate_save_search(){

        // Verify nonce
        if( wp_verify_nonce( $_POST['cityestate_save_search_ajax'], 'cityestate_save_search_nonce' ) ){
            
            global $wpdb, $current_user;
            
            // Get current user detail
            wp_get_current_user();
            $user_id    = $current_user->ID;
            $user_email = $current_user->user_email;
            
            // Get value from save search form
            $search_para = $_POST['search_para'];
            $request_url = $_POST['search_link'];
            
            // Insert recored in database
            $search_table = $wpdb->prefix . 'cityestate_search';
            $wpdb->insert( $search_table, array( 'auther_id' => $user_id, 'query' => $search_para, 'email' => $user_email, 'url' => $request_url, 'time' => current_time( 'mysql' ) ), array( '%d', '%s', '%s', '%s', '%s' ) );

            // Return success result
            echo json_encode( array( 'success' => true ) );
            wp_die();
        } else {
            // Return failed result
            echo json_encode( array( 'success' => false ) );
            wp_die();
        }
    }
}
add_action( 'wp_ajax_cityestate_save_search', 'cityestate_save_search' );

// Remove save search
if(!function_exists('cityestate_delete_save_search') ){
    
    function cityestate_delete_save_search(){
        
        // Get current user info
        global $current_user;        
        wp_get_current_user();        
        $user_id = $current_user->ID;

        // Get propery id
        $property_id = intval( $_POST['property_id'] );

        // Check property id is correct
        if( !is_numeric($property_id) ){
            echo json_encode( array( 'success' => false ) );
            wp_die();
        } else {
            global $wpdb;
            $search_table = $wpdb->prefix . 'cityestate_search';
            $results    = $wpdb->get_row( 'SELECT * FROM ' . $search_table . ' WHERE id = ' . $property_id );
            // Remove save search in database
            if( $user_id != $results->auther_id ){
                // Return failed message
                echo json_encode( array( 'success' => false ) );
                wp_die();
            } else {
                // Return success message
                $wpdb->delete( $search_table, array( 'id' => $property_id ), array( '%d' ) );
                echo json_encode( array( 'success' => true ) );
                wp_die();
            }
        }
    }
}
add_action( 'wp_ajax_cityestate_delete_save_search', 'cityestate_delete_save_search' );

// Filter user invoice
if( !function_exists('cityestate_filter_invoice') ){
    
    function cityestate_filter_invoice(){

        // Get current user info
        global $current_user;
        wp_get_current_user();
        $user_id = $current_user->ID;

        // Define meta and date query
        $meta_qry = array();
        $date_qry = array();

        // Check invoice status field
        if( isset($_POST['invoice_status']) &&  $_POST['invoice_status'] !='' ){
            $status_array             = array();
            $status_array['key']      = 'inv_payment_status';
            $status_array['value']    = esc_html( $_POST['invoice_status'] );
            $status_array['compare']  = '=';
            $status_array['type']     = 'NUMERIC';
            $meta_qry[]             = $status_array;
        }

        // Check invoice type field
        if( isset($_POST['invoice_type']) &&  $_POST['invoice_type'] !='' ){
            $type_array             = array();
            $type_array['key']      = 'cityestate_inv_for';
            $type_array['value']    = esc_html( $_POST['invoice_type'] );
            $type_array['compare']  = 'LIKE';
            $type_array['type']     = 'CHAR';
            $meta_qry[]           = $type_array;
        }

        // Check invoice start date field
        if( isset($_POST['startdate']) &&  $_POST['startdate'] !='' ){
            $start_array            = array();
            $start_array['after']   = esc_html( $_POST['startdate'] );
            $date_qry[]           = $start_array;
        }

        // Check invoice end date field
        if( isset($_POST['enddate']) &&  $_POST['enddate'] !='' ){
            $end_array              = array();
            $end_array['before']    = esc_html( $_POST['enddate'] );
            $date_qry[]           = $end_array;
        }

        // Filter invoice
        $invoice_args = array( 'post_type' => 'cityestate_invoice', 'posts_per_page' => '-1', 'author' => $user_id, 'meta_query' => $meta_qry, 'date_query' => $date_qry );
        $invoice = new WP_Query( $invoice_args );
        $total_price = 0;

        ob_start();
        
        while( $invoice->have_posts()): $invoice->the_post();
            // Get invoice fields
            $invoice_data = cityestate_filter_invoice_data( get_the_ID() );
            
            // Get template parts
            get_template_part( 'template-parts/invoices' );
            
            // Total cost of invoice
            $total_price += $invoice_data['inv_price'];
        endwhile;

        $result = ob_get_contents();
        ob_end_clean();

        // Return filter invoice
        echo json_encode( array( 'success' => true, 'result' => $result, 'total_price' => cityestate_get_invoice_price( $total_price ) ) );
        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_filter_invoice', 'cityestate_filter_invoice' );