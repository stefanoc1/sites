<?php

// Login with google social media
if( !function_exists('cityestate_user_login_with_google') ){

    function cityestate_user_login_with_google(){

        // Add or call the google library
        $file_path = CITYESTATE_PATH . 'social-login/';
        require_once $file_path.'google/Google_Client.php';
        require_once $file_path.'google/contrib/Google_Oauth2Service.php';

        // Call the google class and pass the arguments
        $google_user = new Google_Client();
            
        // Get the google access key from backend
        $client_id      = cityestate_option( 'google_client_id' );
        $client_secret  = cityestate_option( 'google_secret_key' );
        $developer_key  = cityestate_option( 'google_api_key' );

        // Get the dashboard profile url
        $user_profile = cityestate_dashboard_profile_link();

        $google_user->setApplicationName( 'Login to Cityestate' );
        $google_user->setClientId($client_id);
        $google_user->setClientSecret($client_secret);
        $google_user->setRedirectUri($user_profile);
        $google_user->setDeveloperKey($developer_key);
        $google_user->setScopes('email');

        // Redirect to site
        $google_oauthv2 = new Google_Oauth2Service($google_user);
        print $auth_url = $google_user->createAuthUrl();
        wp_die();
    }
}
add_action( 'wp_ajax_nopriv_cityestate_user_login_with_google', 'cityestate_user_login_with_google' );
add_action( 'wp_ajax_cityestate_user_login_with_google', 'cityestate_user_login_with_google' );

?>