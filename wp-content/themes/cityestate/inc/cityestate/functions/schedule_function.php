<?php

// Schedule core
function cityestate_call_schedule(){    
    // Set package cron
    cityestate_set_package_cron();

    // Set per listing cron
    cityestate_set_per_listing_cron();      
}
add_action( 'init', 'cityestate_call_schedule' );

if( !function_exists('cityestate_set_package_cron') ){
    
    function cityestate_set_package_cron(){
        // Get submit property type
        $submit_property_type     = cityestate_option( 'submit_property_type' );
        
        // Cron for membership check
        if( $submit_property_type == 'membership' ){
            // Clear the package expired cron
            wp_clear_scheduled_hook( 'cityestate_user_package_expire' );        
            // Call the package expired cron
            if( !wp_next_scheduled('cityestate_user_package_expire') ){
                wp_schedule_event( time(), 'twicedaily', 'cityestate_user_package_expire' );
            }
        }
    }
}

if( !function_exists('cityestate_set_per_listing_cron') ){
    
    function cityestate_set_per_listing_cron(){
        // Get submit property type
        $submit_property_type     = cityestate_option( 'submit_property_type' );

        // Get per listing expired
        $per_listing_is_expired   = cityestate_option( 'per_listing_is_expired' );

        // Cron for per listing check
        if( $submit_property_type == 'per_listing' && $per_listing_is_expired != 0 ){
            // Clear the per listing expired cron
            wp_clear_scheduled_hook( 'cityestate_per_listing_expired' );
            // Call the per listing expired cron
            if( !wp_next_scheduled( 'cityestate_per_listing_expired' ) ){
                wp_schedule_event( time(), 'twicedaily', 'cityestate_per_listing_expired' );
            }
        }  
    }
}

// Check cron for package expire
if( !function_exists('cityestate_user_package_expire_cron') ){
    
    function cityestate_user_package_expire_cron(){
        // Get users
        $users = get_users();

        foreach( $users as $user ){
            // Get user id and package id
            $user_id = $user->ID;
            $package_id = get_user_meta( $user_id, 'package_id', true );

            // Check user has package
            if( $package_id != '' ){
                // Get package detail
                $bill_time      =  get_post_meta( $package_id, 'package_time', true );
                $package_date   =  strtotime( get_user_meta( $user_id, 'package_activation',true ) );
                $bill_unit      =  intval( get_post_meta( $package_id, 'package_unit', true ) );
                $time_second    = 0;

                switch( $bill_time ){
                    // Check day
                    case 'Day':
                        $time_second = 60*60*24;
                    break;
                    // Check week
                    case 'Week':
                        $time_second = 60*60*24*7;
                    break;
                    // Check month
                    case 'Month':
                        $time_second = 60*60*24*30;
                    break;
                    // Check year
                    case 'Year':
                        $time_second = 60*60*24*365;
                    break;
                }
                
                $time_frame = $time_second*$bill_unit;
                
                // Get current date and time
                $current_time = time();

                if( $current_time > $package_date + $time_frame ){
                    
                    global $post;

                    // Update user package status
                    update_user_meta( $user_id, 'package_id', '' );
                    update_user_meta( $user_id, 'package_list', '' );
                    update_user_meta( $user_id, 'package_featured', '' );

                    // Collect property args
                    $args = array( 'post_type' => 'property', 'author' => $user_id, 'post_status' => 'any' );
                    $query = new WP_Query($args);

                    while( $query->have_posts() ){
                        // Set property as expired
                        $query->the_post();
                        $property = array( 'ID' => $post->ID, 'post_type' => 'property', 'post_status' => 'expired' );
                        wp_update_post($property);
                    }
                    // Reset wp query
                    wp_reset_query();

                    // Get user email id
                    $user       = get_user_by( 'id', $user_id );
                    $user_email = $user->user_email;

                    // Send mail to user package expired
                    cityestate_send_mail( $user_email, 'membership_expired_subject', 'membership_expired_message', array() ); 
                }
            }
        }
    }
}

add_action( 'cityestate_user_package_expire', 'cityestate_user_package_expire_cron' );


if( !function_exists('cityestate_per_listing_expired') ){
    
    function cityestate_per_listing_expired(){

        // Get submit property type and expired time
        $submit_property_type       = cityestate_option( 'submit_property_type' );
        $per_listing_is_expired     = cityestate_option( 'per_listing_is_expired' );
        $per_listing_expired_time   = intval( cityestate_option( 'per_listing_expired_time' ) );

        // Check the property submit type is per listing
        if( $submit_property_type == 'per_listing' ){
            // Check the expired time
            if( $per_listing_expired_time != 0 && $per_listing_expired_time != '' && $per_listing_is_expired != 0 ){
                // Collect property args and run query
                $args = array( 'post_type' => 'property', 'post_status' => 'publish' );
                $property = new WP_Query($args);

                while( $property->have_posts() ): $property->the_post();
                    // Get property id and list date
                    $property_id = get_the_ID();
                    $list_date   = strtotime( get_the_date( 'Y-m-d', $property_id ) );

                    // Calculate expired time and current time
                    $expired_date   = $list_date + $per_listing_expired_time * 24 * 60 * 60;
                    $current_time   = time();

                    // Get property author
                    $author_post    = get_post( $property_id );
                    $user_id        = $author_post->post_author;
                    $user           = new WP_User( $user_id );
                    
                    // Get user role
                    $user_role = $user->roles[0];
                    
                    // Check user role
                    if( $user_role != 'administrator' ){                        
                        // Compare listing date and expired date
                        if( $expired_date < $current_time ){
                            // Collect the property args and expired property
                            $property_args = array( 'ID' => $post_id, 'post_type' => 'property', 'post_status' => 'expired' );
                            wp_update_post($property_args);

                            // Get the author email id
                            $user       = get_user_by( 'id', $user_id );
                            $user_email = $user->user_email;

                            // Send mail to user for per listing expired
                            $args = array( 'expired_listing_url'  => get_permalink($post_id), 'expired_listing_name' => get_the_title($post_id) );                            
                            cityestate_send_mail( $user_email, 'free_listing_expired_subjeact', 'free_listing_expired_message', $args );
                        }
                    }
                endwhile;
            }
        }
    }    
}
add_action( 'cityestate_per_listing_expired', 'cityestate_per_listing_expired' );