<?php

// Return user profile page url
if( !function_exists('cityestate_user_profile_page') ){

    function cityestate_user_profile_page(){
        // Find template using file name
        $template = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_profile.php' ) );
        if( $template ){
            $dashboard_link = get_permalink( $template[0]->ID);
        } else {
            $dashboard_link = home_url();
        }
        // Return profile page link
        return $dashboard_link;
    }    
}

// Update user profile
if( !function_exists('cityestate_ajax_update_profile') ){

    function cityestate_ajax_update_profile(){
        // Get current user info
        global $current_user;
        wp_get_current_user();

        $user_id  = $current_user->ID;

        // Declare error message array
        $errors_report = array();

        // Define variable
        $first_name = $last_name = $user_position = $description = $user_mobile = $user_office = $user_website_url = $user_skype_id = $user_email = $user_facebook_link = $user_twitter_link = $user_linkedin_link = $user_instagram_link = $user_pinterest_link = $user_googleplus_link = $user_youtube_link = $user_vimeo_link = $profile_id = $user_profile_image = '';

        // Verify nonce field
        if( wp_verify_nonce( $_POST['cityestate_profile_security'], 'cityestate_profile_nonce' ) ){

            // Update user first name
            if( !empty( $_POST['first_name'] ) ){
                $first_name = sanitize_text_field( $_POST['first_name'] );
                update_user_meta( $user_id, 'first_name', $first_name );
            } else {
                delete_user_meta( $user_id, 'first_name' );
            }

            // Update user last name
            if( !empty( $_POST['last_name'] ) ){
                $last_name = sanitize_text_field( $_POST['last_name'] );
                update_user_meta( $user_id, 'last_name', $last_name );
            } else {
                delete_user_meta( $user_id, 'last_name' );
            }

            // Update user position
            if( !empty( $_POST['user_position'] ) ){
                $user_position = sanitize_text_field( $_POST['user_position'] );
                update_user_meta( $user_id, 'user_position', $user_position );
            } else {
                delete_user_meta( $user_id, 'user_position' );
            }

            // Update user description
            if( !empty( $_POST['description'] ) ){
                $description = sanitize_text_field( $_POST['description'] );
                update_user_meta( $user_id, 'description', $description );
            } else {
                delete_user_meta( $user_id, 'description' );
            }

            // Update user mobile
            if( !empty( $_POST['user_mobile'] ) ){
                $user_mobile = sanitize_text_field( $_POST['user_mobile'] );
                update_user_meta( $user_id, 'user_mobile', $user_mobile );
            } else {
                delete_user_meta( $user_id, 'user_mobile' );
            }

            // Update user office
            if( !empty( $_POST['user_office'] ) ){
                $user_office = sanitize_text_field( $_POST['user_office'] );
                update_user_meta( $user_id, 'user_office', $user_office );
            } else {
                delete_user_meta( $user_id, 'user_office' );
            }        

             // Update user website
            if ( !empty( $_POST['user_website_url'] ) ) {
                $user_website_url = sanitize_text_field( $_POST['user_website_url'] );
                update_user_meta( $user_id, 'user_website_url', $user_website_url );
            } else {
                $user_website_url = '';
                delete_user_meta( $user_id, 'user_website_url' );            
            }

            // Update user skype
            if( !empty( $_POST['user_skype_id'] ) ){
                $user_skype_id = sanitize_text_field( $_POST['user_skype_id'] );
                update_user_meta( $user_id, 'user_skype_id', $user_skype_id );
            } else {
                delete_user_meta( $user_id, 'user_skype_id' );
            }

            // Update user facebook
            if( !empty( $_POST['user_facebook_link'] ) ){
                $user_facebook_link = sanitize_text_field( $_POST['user_facebook_link'] );
                update_user_meta( $user_id, 'user_facebook_link', $user_facebook_link );
            } else {
                delete_user_meta( $user_id, 'user_facebook_link' );
            }

            // Update user twitter
            if( !empty( $_POST['user_twitter_link'] ) ){
                $user_twitter_link = sanitize_text_field( $_POST['user_twitter_link'] );
                update_user_meta( $user_id, 'user_twitter_link', $user_twitter_link );
            } else {
                delete_user_meta( $user_id, 'user_twitter_link' );
            }

            // Update user linkedin
            if( !empty( $_POST['user_linkedin_link'] ) ){
                $user_linkedin_link = sanitize_text_field( $_POST['user_linkedin_link'] );
                update_user_meta( $user_id, 'user_linkedin_link', $user_linkedin_link );
            } else {
                delete_user_meta( $user_id, 'user_linkedin_link' );
            }

            // Update user instagram
            if( !empty( $_POST['user_instagram_link'] ) ){
                $user_instagram_link = sanitize_text_field( $_POST['user_instagram_link'] );
                update_user_meta( $user_id, 'user_instagram_link', $user_instagram_link );
            } else {
                delete_user_meta( $user_id, 'user_instagram_link' );
            }

            // Update user pinterest
            if( !empty( $_POST['user_pinterest_link'] ) ){
                $user_pinterest_link = sanitize_text_field( $_POST['user_pinterest_link'] );
                update_user_meta( $user_id, 'user_pinterest_link', $user_pinterest_link );
            } else {
                delete_user_meta( $user_id, 'user_pinterest_link' );
            }

            // Update user googleplus
            if( !empty( $_POST['user_googleplus_link'] ) ){
                $user_googleplus_link = sanitize_text_field( $_POST['user_googleplus_link'] );
                update_user_meta( $user_id, 'user_googleplus_link', $user_googleplus_link );
            } else {
                delete_user_meta( $user_id, 'user_googleplus_link' );
            }

            // Update user youtube
            if( !empty( $_POST['user_youtube_link'] ) ){
                $user_youtube_link = sanitize_text_field( $_POST['user_youtube_link'] );
                update_user_meta( $user_id, 'user_youtube_link', $user_youtube_link );
            } else {
                delete_user_meta( $user_id, 'user_youtube_link' );
            }

            // Update user vimeo
            if( !empty( $_POST['user_vimeo_link'] ) ){
                $user_vimeo_link = sanitize_text_field( $_POST['user_vimeo_link'] );
                update_user_meta( $user_id, 'user_vimeo_link', $user_vimeo_link );
            } else {
                delete_user_meta( $user_id, 'user_vimeo_link' );
            }

            // Update user profile picture
            if( !empty( $_POST['user_profile_image'] ) ){
                $profile_id         = sanitize_text_field( $_POST['user_profile_image'] );
                $user_profile_image = wp_get_attachment_url( $profile_id );

                update_user_meta( $user_id, 'user_custom_image', $user_profile_image );
                update_user_meta( $user_id, 'author_picture_id', $profile_id );
            } else {
                delete_user_meta( $user_id, 'user_custom_image' );
                delete_user_meta( $user_id, 'author_picture_id' );
            }

            // Update user email
            if( !empty( $_POST['user_email'] ) ){

                $user_email = sanitize_email( $_POST['user_email'] );
                $user_email = is_email( $user_email );
                // Check email id is valid
                if( !$user_email ){
                    $errors_report[] = esc_html__( 'The Email you entered is not valid. Please try again.', 'cityestate' );
                } else {
                    // Check email id is exists
                    $email_exists = email_exists( $user_email );

                    if( $email_exists ){
                        if( $email_exists != $user_id ){
                            $errors_report[] = esc_html__( 'This Email is already used by another user. Please try a different one.', 'cityestate' );
                        }
                    } else {
                        // Update email id
                        $return = wp_update_user( array( 'ID' => $user_id, 'user_email' => $user_email ) );
                        // Return error report
                        if( is_wp_error( $return ) ){
                            $errors_report[] = $return->get_error_message();
                        }
                    }
                    // Check user is as agent
                    $agent_id = get_user_meta( $user_id, 'author_agent_id', true );                    
                    $user_is_agent  = "yes";
                    
                    if( $user_is_agent == 'yes' ){
                        // Update agent info
                        if( !empty( $first_name ) || !empty( $last_name ) ){
                            $agrs = array( 'ID' => $agent_id, 'post_title' => $first_name.' '.$last_name, 'post_content' => $description );
                            $agent_post_id = wp_update_post($agrs);
                        }
                        update_post_meta( $agent_id, '_thumbnail_id', $profile_id );
                        update_post_meta( $agent_id, 'agent_email', $user_email );
                        update_post_meta( $agent_id, 'agent_position', $user_position );
                        update_post_meta( $agent_id, 'about_agent', $description );
                        update_post_meta( $agent_id, 'agent_mobile', $user_mobile );
                        update_post_meta( $agent_id, 'agent_office', $user_office );
                        update_post_meta( $agent_id, 'agent_website', $user_website_url );
                        update_post_meta( $agent_id, 'agent_skype', $user_skype_id );
                        update_post_meta( $agent_id, 'agent_facebook', $user_facebook_link );
                        update_post_meta( $agent_id, 'agent_twitter', $user_twitter_link );
                        update_post_meta( $agent_id, 'agent_linkedin', $user_linkedin_link );
                        update_post_meta( $agent_id, 'agent_instagram', $user_instagram_link );
                        update_post_meta( $agent_id, 'agent_pinterest', $user_pinterest_link );
                        update_post_meta( $agent_id, 'agent_googleplus', $user_googleplus_link );
                        update_post_meta( $agent_id, 'agent_youtube', $user_youtube_link );
                        update_post_meta( $agent_id, 'agent_vimeo', $user_vimeo_link );
                    }
                }
            } else {
                $errors_report[] = esc_html__( 'Email id is required. Please enter your email id.', 'cityestate' );
            }
            
            // Return success or error message
            if( count($errors_report) == 0 ){
                $response = array( 'success' => true, 'message' => esc_html__( 'Profile information is updated successfully!', 'cityestate' ) );
                echo json_encode( $response );
                die;
            } else {
                $response = array( 'success' => false, 'errors' => $errors_report );
                echo json_encode( $response );
                die;
            }                      
        } else {
            // Return security failed message
            $errors_report[] = esc_html__( 'Security check failed!', 'cityestate' );
            $response = array( 'success' => false, 'errors' => $errors_report );
            echo json_encode( $response );
            die;
        }
    }
}
add_action( 'wp_ajax_cityestate_ajax_update_profile', 'cityestate_ajax_update_profile' );

// Upload user profile image
if( !function_exists( 'cityestate_profile_image_upload' ) ){

    function cityestate_profile_image_upload(){

        // Verify nonce
        if( wp_verify_nonce( $_REQUEST['nonce'], 'profile_upload' ) ){

            $submitted_file  = $_FILES['profile_image_file'];
            $uploaded_image  = wp_handle_upload( $submitted_file, array( 'test_form' => false ) );

            // Check user profile image is set
            if( isset( $uploaded_image['file'] ) ){
                // Collect image data
                $file_name = basename( $submitted_file['name'] );
                $file_type = wp_check_filetype( $uploaded_image['file'] );

                // Collect image info for upload in wordpress
                $attachment_details = array(
                    'post_mime_type' => $file_type['type'],
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
                    'guid'           => $uploaded_image['url'],
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );

                $image_id   = wp_insert_attachment( $attachment_details, $uploaded_image['file'] );
                $image_data = wp_generate_attachment_metadata( $image_id, $uploaded_image['file'] );
                
                wp_update_attachment_metadata( $image_id, $image_data );
                // Get thumbnail url of submitted image
                $thumbnail_url = wp_get_attachment_thumb_url( $image_data );

                // Return success message
                $ajax_response = array( 'success' => true, 'url' => $thumbnail_url, 'attachment_id' => $image_id );
                echo json_encode( $ajax_response );
                die;

            } else {
                // Return error message
                $ajax_response = array( 'success' => false, 'reason' => esc_html__( 'Image upload failed!', 'cityestate' ) );
                echo json_encode( $ajax_response );
                die;
            }
        } else {
            $ajax_response = array( 'success' => false , 'reason' => esc_html__( 'Security check failed!', 'cityestate' ) );
            echo json_encode( $ajax_response );
            die;
        }
    }
}
add_action( 'wp_ajax_cityestate_profile_image_upload', 'cityestate_profile_image_upload' );

// User change password
if( !function_exists('cityestate_ajax_password_change') ){

    function cityestate_ajax_password_change(){
        // Get current user info
        global $current_user;
        wp_get_current_user();

        // Get current user id
        $user_id      = $current_user->ID;
        $store_html   = array();

        if( wp_verify_nonce( $_POST['cityestate_security_password'], 'cityestate_password_nonce' ) ){

            // Define errors array
            $errors_report      = array();
            $old_password       = wp_kses( $_POST['old_password'], $store_html );
            $new_password       = wp_kses( $_POST['new_password'], $store_html );
            $confirm_password   = wp_kses( $_POST['confirm_password'], $store_html );

            // Check new password or confirm password is empty
            if( $new_password == '' || $confirm_password == '' ){
                $errors_report[] = esc_html__( 'New password or confirm password is blank.', 'cityestate' );
            }

            // Check new password and confirm password in match
            if( $new_password != $confirm_password ){
                $errors_report[] = esc_html__( 'The passwords you entered do not match. Your password is not updated.', 'cityestate' );
            }

            // Check is error report is empty
            if( empty($errors_report) ){
                // Get user object
                $user = get_user_by( 'id', $user_id );
                
                if( $user && wp_check_password( $old_password, $user->data->user_pass, $user_id ) ){
                    // Update password
                    wp_set_password( $new_password, $user_id );
                    
                    if( count($errors_report) == 0 ){
                        // Return password updated message
                        $response = array(
                            'success' => true,
                            'message' => esc_html__( 'Password is changed successfully!', 'cityestate' ),
                        );
                        echo json_encode( $response );
                        die;

                    } else {
                        // Return error report
                        $response = array( 'success' => false, 'errors' => $errors_report );
                        echo json_encode( $response );
                        die;
                    }
                } else {
                    // Return error report
                    $errors_report[] = esc_html__( 'The old password you entered do not correct. Your password is not updated.', 'cityestate' );
                    $response = array( 'success' => false, 'errors' => $errors_report );
                    echo json_encode( $response );
                    die;
                }
            } else {
                // Return error report
                $response = array( 'success' => false, 'errors' => $errors_report );
                echo json_encode( $response );
                die;
            }
        } else {
            // Return error report
            $errors_report[] = esc_html__( 'Security check failed!', 'cityestate' );
            $response = array( 'success' => false, 'errors' => $errors_report );
            echo json_encode( $response );
            die;
        }        
    }
}
add_action( 'wp_ajax_cityestate_ajax_password_change', 'cityestate_ajax_password_change' );

?>