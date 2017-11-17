<?php

// Login with yahoo social media
if( !function_exists('cityestate_user_login_with_yahoo') ){

    function cityestate_user_login_with_yahoo(){

        // Add or call the yahoo library
        $file_path = CITYESTATE_PATH . 'social-login/yahoo';
        require $file_path.'openid.php';        

        try {            
            // Get home link for yahoo
            $home_link = get_home_url();
	        $home_link = str_replace('http://', '', $home_link);
	        $home_link = str_replace('https://', '', $home_link);
            
            $yahoo = new LightOpenID( $home_link );

            // Check the login with yahoo mode
            if( !$yahoo->mode ){
                
                // Get the dashboard profile url
                $user_profile = cityestate_dashboard_profile_link();

                $yahoo->identity = 'https://me.yahoo.com';

                // Fetch the values from yahoo
                $yahoo->required   = array( 'namePerson', 'namePerson/first', 'namePerson/last', 'contact/email', );
                $yahoo->optional   = array( 'namePerson', 'namePerson/friendly' );
                $yahoo->returnUrl  = $user_profile;

                // Redirect to site
                print $yahoo->authUrl();
                wp_die();
            }
        } catch ( ErrorException $Error ){
            // Show if have any error
            echo $Error->getMessage();
        }
    }
}
add_action( 'wp_ajax_nopriv_cityestate_user_login_with_yahoo', 'cityestate_user_login_with_yahoo' );
add_action( 'wp_ajax_cityestate_user_login_with_yahoo', 'cityestate_user_login_with_yahoo' );

?>