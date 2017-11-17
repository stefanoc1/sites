<?php

// Register user using core wordpress functionality
add_action( 'wp_ajax_nopriv_cityestate_register', 'cityestate_register' );
add_action( 'wp_ajax_cityestate_register', 'cityestate_register' );

if( !function_exists('cityestate_register') ){

    function cityestate_register(){

        $html = array();

        // Check the security of register user
        check_ajax_referer( 'cityestate_register_nonce', 'cityestate_register_security' );

        // New user detail
        $new_user_name    = trim( sanitize_text_field( wp_kses( $_POST['username'], $html ) ) );
        $new_user_email   = trim( sanitize_text_field( wp_kses( $_POST['useremail'], $html ) ) );
        $new_term_cond    = wp_kses( $_POST['term_condition'], $html );
        $create_password  = cityestate_option('auto_create_password');

        // Check the username field
        if( empty( $new_user_name ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'The username field is empty.', 'cityestate' ) ) );
            wp_die();
        }

        // Check the validation of username
        if( preg_match("/^[0-9A-Za-z_]+$/", $new_user_name) == 0 ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Invalid username (do not use special characters or spaces)!', 'cityestate' ) ) );
            wp_die();
        }

        // Check the username is alredy available
        if( username_exists( $new_user_name ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'This username is already registered.', 'cityestate' ) ) );
            wp_die();
        }

        // Check the email field
        if( empty( $new_user_email ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'The email field is empty.', 'cityestate' ) ) );
            wp_die();
        }
        
        // Check the validation of email id
        if( email_exists( $new_user_email ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'This email address is already registered.', 'cityestate' ) ) );
            wp_die();
        }

        // Check the email id is valid or not
        if( !is_email( $new_user_email ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Invalid email address.', 'cityestate' ) ) );
            wp_die();
        }

        // Check the password field
        if( $create_password == 'yes' ){
            $new_password      = trim( sanitize_text_field(wp_kses( $_POST['userpassword'] ,$html) ) );
            $new_password_re   = trim( sanitize_text_field(wp_kses( $_POST['userpassword_re'] ,$html) ) );
            // Check the password is empty or not
            if( $new_password == '' || $new_password_re == '' ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'One of the password field is empty!', 'cityestate' ) ) );
                wp_die();
            }
            // Check the both password is match or not
            if( $new_password !== $new_password_re ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Passwords do not match', 'cityestate' ) ) );
                wp_die();
            }
        }

        // Check the term and condition field
        if( $new_term_cond != 'on' ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'You need to agree with terms & conditions.', 'cityestate' ) ) );
            wp_die();
        }

        // Create auto password and send via email
        if( $create_password == 'yes' ){
            $new_password = $new_password;
        } else {
            $new_password = wp_auto_create_password( $length = 21, $special_chars = false );
        }

        // All is okay then create new user
        $new_user_id = wp_create_user( $new_user_name, $new_password, $new_user_email );

        // Check the status of create user
        if( is_wp_error($new_user_id) ){
            echo json_encode( array( 'success' => false, 'message' => $new_user_id ) );
            wp_die();
        } else {
            // Show the user register message in dialog box
            if( $create_password =='yes' ){
                echo json_encode( array( 'success' => true, 'message' => esc_html__( 'Your account was created and you can login now!', 'cityestate' ) ) );
            } else {
                echo json_encode( array( 'success' => true, 'message' => esc_html__( 'An email with the generated password was sent!', 'cityestate' ) ) );
            }

            // Create new user as agent
            $register_user_as_agent = cityestate_option( 'register_user_as_agent' );
            if( $register_user_as_agent == 'yes' ){
                // Create agent post
                $args       = array( 'post_title' => $new_user_name, 'post_type' => 'cityestate_agent', 'post_status' => 'publish' );
                $agent_id   = wp_insert_post( $args );

                // Update agent detail
                update_post_meta( $agent_id, 'user_meta_id', $new_user_id );
                update_user_meta( $new_user_id, 'author_agent_id', $agent_id );
                update_post_meta( $agent_id, 'agent_email', $new_user_email );                
            }

            // Send new user registered email
            cityestate_new_user_send_mail( $new_user_id, $new_password );
        }
        wp_die();
    }
}

// New user register send mail
if( !function_exists('cityestate_new_user_send_mail') ){

    function cityestate_new_user_send_mail( $new_user_id, $password = '' ){
        // Get user object using new user id
        $user_info = new WP_User( $new_user_id );
        
        // Get the user detail for send mail
        $user_login = stripslashes( $user_info->user_login );
        $user_email = stripslashes( $user_info->user_email );

        // Check is password is empty or not
        if( empty( $password ) ){ return; }

        // Send mail to admin as well
        $args = array( 'user_login_register' => $user_login, 'user_email_register' => $user_email );
        
        // Send notification to registered user
        $args = array(
            'user_login_register'  => $user_login,
            'user_email_register'  => $user_email,
            'user_pass_register'   => $password
        );
        // Send mail to new user
        cityestate_send_register_email( $user_email, 'register_user_subject', 'register_user_message', $args );
    }
}

// Send email to admin and new user for reistration success
if( !function_exists('cityestate_send_register_email') ){
    
    function cityestate_send_register_email( $new_user_email, $email_subject, $email_message, $args ){

        // Get email content from backend
        $email_subject  = cityestate_option( $email_subject );
        $email_message  = cityestate_option( $email_message );

        // Collect the site detail
        $new_user               = get_user_by( 'email', $new_user_email );        
        $args['website_url']    = get_option('siteurl');
        $args['website_name']   = get_option('blogname');
        $args['user_email']     = $new_user_email;
        $args['username']       = $new_user->user_login;

        // Filter the details
        foreach( $args as $key => $val ){
            $subject = str_replace( '%'.$key, $val, $email_subject );
            $message = str_replace( '%'.$key, $val, $email_message );
        }

        // Finally send the email to admin or new user
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        @wp_mail( $new_user_email, $subject, $message, $headers );
    }
}