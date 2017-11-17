<?php

// Login And Register
Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'Login & Register', 'cityestate' ),
    'id'               => 'login-register',
    'subsection'       => false,
    'fields'           => array(

        array(
            'id'       => 'user_login_part',
            'type'     => 'section',            
            'title'    => esc_html__( 'Login Setting', 'cityestate' ),            
            'indent'   => true
        ),

        array(
            'id'       => 'after_login_redirect',
            'type'     => 'select',
            'title'    => esc_html__( 'After Login Redirect Page', 'cityestate' ),
            'options'  => array(
                                'same_page' => esc_html__( 'Current Page', 'cityestate' ),
                                'diff_page' => esc_html__( 'Different Page', 'cityestate' )
                            ),
            'default'  => 'same_page'
        ),

        array(
            'id'       => 'after_after_login_redirect_link',
            'type'     => 'text',
            'required' => array( 'after_login_redirect', '=', 'diff_page' ),
            'title'    => esc_html__( 'Enter Redirect Page Link', 'cityestate' ),
            'subtitle' => esc_html__( 'This must be a URL', 'cityestate' ),
            'validate' => 'url',            
        ),

        array(
            'id'       => 'user_login_with_facebook',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Facebook ?', 'cityestate' ),
            'options'  => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__( 'No', 'cityestate' )
                            ),
            'default'  => 'no'
        ),

        array(
            'id'       => 'facebook_api_key',
            'type'     => 'text',
            'required' => array( 'user_login_with_facebook', '=', 'yes' ),
            'title'    => esc_html__( 'Facebook Api key', 'cityestate' ),
            'subtitle' => esc_html__( 'Facebook Api key for facebook login', 'cityestate' )            
        ),

        array(
            'id'       => 'facebook_secret_key',
            'type'     => 'text',
            'required' => array( 'user_login_with_facebook', '=', 'yes' ),
            'title'    => esc_html__( 'Facebook Secret Code', 'cityestate' ),
            'subtitle' => esc_html__( 'Facebook secret code for facebook login', 'cityestate' )            
        ),

        array(
            'id'       => 'user_login_with_google',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Google ?', 'cityestate' ),
            'options'  => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__( 'No', 'cityestate' )
                            ),            
            'default'  => 'no'
        ),

        array(
            'id'       => 'google_api_key',
            'type'     => 'text',
            'required' => array( 'user_login_with_google', '=', 'yes' ),
            'title'    => esc_html__( 'Google Api key', 'cityestate' ),
            'subtitle' => esc_html__( 'Google Api key for google login', 'cityestate' )            
        ),

        array(
            'id'       => 'google_client_id',
            'type'     => 'text',
            'required' => array( 'user_login_with_google', '=', 'yes' ),
            'title'    => esc_html__( 'Google OAuth Client ID', 'cityestate' ),
            'subtitle' => esc_html__( 'Google oAuth client id for google login', 'cityestate' )            
        ),

        array(
            'id'       => 'google_secret_key',
            'type'     => 'text',
            'required' => array( 'user_login_with_google', '=', 'yes' ),
            'title'    => esc_html__( 'Google Client Secret', 'cityestate' ),
            'subtitle' => esc_html__( 'Google client secret code for google login', 'cityestate' )
            
        ),

        array(
            'id'       => 'user_login_with_yahoo',
            'type'     => 'select',
            'title'    => esc_html__( 'Allow login via Yahoo ?', 'cityestate' ),
            'options'   => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__( 'No', 'cityestate' )
                            ),
            'default'  => 'no'
        ),

        array(
            'id'       => 'user_register_part',
            'type'     => 'section',            
            'title'    => esc_html__( 'Register Setting', 'cityestate' ),            
            'indent'   => true
        ),

        array(
            'id'       => 'auto_create_password',
            'type'     => 'select',
            'title'    => esc_html__( 'Users can type the password on registration form', 'cityestate' ),
            'subtitle' => esc_html__( 'If no, users will get the auto generated password via email', 'cityestate' ),
            'options'  => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__( 'No', 'cityestate' )
                            ),            
            'default'  => 'no'
        ),        

        array(
            'id'       => 'register_user_as_agent',
            'type'     => 'select',
            'title'    => esc_html__( 'Enable frontend regsiter user as agent', 'cityestate' ),
            'options'  => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__( 'No', 'cityestate' )
                            ),
            'desc'     => esc_html__( 'Register front-end user as agent', 'cityestate' ),
            'default'  => 'yes'
        ),

        array(
            'id'       => 'register_term_and_condition',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Terms & Conditions', 'cityestate' ),
            'subtitle' => esc_html__( 'Select terms & conditions page', 'cityestate' )
        ),       

    )

) );

?>