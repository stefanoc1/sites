<?php
// Reset user password using core wordpress functionality
add_action( 'wp_ajax_nopriv_cityestate_reset_password', 'cityestate_reset_password' );
add_action( 'wp_ajax_cityestate_reset_password', 'cityestate_reset_password' );

if( !function_exists('cityestate_reset_password') ){

    function cityestate_reset_password(){
        check_ajax_referer( 'cityestate_reset_nonce', 'cityestate_reset_security' );

        $allowed   		  = array();
        $reset_password   = wp_kses( $_POST['login_forgot'], $allowed );

        // Check the given username or email id is available in databse
        if( empty( $reset_password ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Enter a username or email address.', 'cityestate' ) ) );
            wp_die();
        }

        // Check the email validation
        if( strpos( $reset_password, '@' ) ){
            $user_info = get_user_by( 'email', trim( $reset_password ) );
            if( empty( $user_info ) ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'There is no user registered with that email address.', 'cityestate' ) ) );
                wp_die();
            }
        } else {
        	// Get user info using username or login
            $user_login = trim( $reset_password );
            $user_info  = get_user_by( 'login', $user_login );
            // Send message if user is invalid
            if( !$user_info ){
                echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Invalid username', 'cityestate' ) ) );
                wp_die();
            }
        }

        // Get reset user info
        $reset_password = $user_info->login_forgot;
        $user_email     = $user_info->user_email;
        $reset_key      = get_password_reset_key( $user_info );

 		// Check is error on password reset module       
        if( is_wp_error( $reset_key ) ){
            echo json_encode( array( 'success' => false, 'message' => $reset_key ) );
            wp_die();
        }

        // Send email to user for reset password info        
        $reset_message  = esc_html__( 'Someone has requested a password reset for the following account:', 'cityestate' ) . "\r\n\r\n";
        $reset_message .= network_home_url( '/' ) . "\r\n\r\n";
        $reset_message .= sprintf( esc_html__( 'Username: %s', 'cityestate' ), $reset_password ) . "\r\n\r\n";
        $reset_message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.', 'cityestate' ) . "\r\n\r\n";
        $reset_message .= esc_html__( 'To reset your password, visit the following address:', 'cityestate' ) . "\r\n\r\n";
        $reset_message .= '<' . network_site_url( "wp-login.php?action=rp&key=$reset_key&login=" . rawurlencode($reset_password), 'login' ) . ">\r\n";

        // Check site is multi language
        if( is_multisite() )
            $site_name = $GLOBALS['current_site']->site_name;
        else
            $site_name = wp_specialchars_decode( get_option('blogname'), ENT_QUOTES );
        
        // Filter the title and message of reset password
        $reset_title      = sprintf( esc_html__('[%s] Password Reset', 'cityestate'), $site_name );
        $reset_title      = apply_filters( 'retrieve_password_title', $reset_title, $reset_password, $user_info );
        $reset_message    = apply_filters( 'retrieve_password_message', $reset_message, $reset_key, $reset_password, $user_info );

        // Send the reset password status is reset password dialog box
        if( $reset_message && !wp_mail( $user_email, wp_specialchars_decode( $reset_title ), $reset_message ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'The email could not be sent.', 'cityestate' ) . "<br />\n" . esc_html__( 'Possible reason: your host may have disabled the mail() function.', 'cityestate' ) ) );
            wp_die();
        } else {
            echo json_encode( array( 'success' => true, 'message' => esc_html__( 'Check your email', 'cityestate' ) ) );
            wp_die();
        }
    }
}

?>