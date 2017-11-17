<?php

// Login user using core wordpress functionality
add_action( 'wp_ajax_cityestate_login', 'cityestate_login' );
add_action( 'wp_ajax_nopriv_cityestate_login', 'cityestate_login' );

if( !function_exists('cityestate_login') ){

    function cityestate_login(){

        // Check the security of login user
        check_ajax_referer( 'cityestate_login_nonce', 'cityestate_login_security' );

        $html       = array();        
        $html_array = array('strong' => array());

        // Check the remember field is check or not
        if( isset( $_POST['remember'] ) ){
            $login_remember = wp_kses( $_POST['remember'], $html );
        } else {
            $login_remember = '';
        }

        // Get username and password of user
        $login_username   = wp_kses( $_POST['username'], $html );
        $login_password   = wp_kses( $_POST['userpassword'], $html );        

        // Check username field
        if( empty( $login_username ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'The username field is empty.', 'cityestate' ) ) );
            wp_die();
        }
        
        // Check password field
        if( empty( $login_password ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'The password field is empty.', 'cityestate' ) ) );
            wp_die();
        }

        // Check username is exits or not
        if( !username_exists( $login_username ) ){
            echo json_encode( array( 'success' => false, 'message' => esc_html__( 'Invalid username', 'cityestate' ) ) );
            wp_die();
        }

        // Clear the user another cookied
        wp_clear_auth_cookie();

        // Assign the value of remember field
        if( $login_remember == 'on' ){
            $login_remember = true;
        } else {
            $login_remember = false;
        }        

        // User detail array
        $user_info                  = array();
        $user_info['remember']      = $login_remember;
        $user_info['user_login']    = $login_username;
        $user_info['user_password'] = $login_password;        

        // Return the login status
        $user = wp_signon( $user_info, false );

        // Send the validation or error or info message
        if( is_wp_error( $user ) ){
            // User access is incorrect
            echo json_encode( array( 'success' => false, 'message' => sprintf( wp_kses(__( 'The password you entered for the username <strong>%s</strong> is incorrect.', 'cityestate' ), $html_array ), $login_username ) ) );
            wp_die();
        } else {
            // User is successfully login
            wp_set_current_user($user->ID);
            do_action('set_current_user');
            
            // Get current user info
            global $current_user;
            $current_user = wp_get_current_user();
            echo json_encode( array( 'success' => true, 'message' => esc_html__( 'Login successful, redirecting...', 'cityestate' ) ) );
        }
        wp_die();
    }
}