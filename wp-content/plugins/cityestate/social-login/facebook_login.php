<?php

// Login with facebook social media
if( !function_exists('cityestate_user_login_with_facebook') ){

    function cityestate_user_login_with_facebook(){
        
        // Add or call the facebook library
        $file_path = CITYESTATE_PATH . 'social-login/Facebook/';
        require $file_path.'autoload.php';        

        // Get the facebook access key from backend
        $api_key    = cityestate_option( 'facebook_api_key' );
        $secret_key = cityestate_option( 'facebook_secret_key' );

        // Call the facebook class and pass the arguments
        $facebooki_info = new Facebook\Facebook([ 'app_id' => $api_key, 'app_secret' => $secret_key, 'default_graph_version' => 'v2.5' ]);
        $facebook_helper = $facebooki_info->getRedirectLoginHelper();

        // Get the dashboard profile url
        $user_profile = cityestate_dashboard_profile_link();

        // Get the permissions from facebook
        $get_perms  = ['email'];
        $login_link  = $facebook_helper->getLoginUrl( $user_profile, $get_perms );

        // Redirect to site
        print $login_link;
        wp_die();
    }
}
add_action( 'wp_ajax_nopriv_cityestate_user_login_with_facebook', 'cityestate_user_login_with_facebook' );
add_action( 'wp_ajax_cityestate_user_login_with_facebook', 'cityestate_user_login_with_facebook' );


?>