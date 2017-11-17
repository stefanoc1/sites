<?php

// Headers
Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'Headers', 'cityestate' ),
    'id'               => 'headers',
    'icon'             => 'el el-screen'

) );

Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'Header Type', 'cityestate' ),
    'id'               => 'header-styles',
    'subsection'       => true,
    'fields'           => array(

        array(
            'id'       => 'header_style_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Header Type', 'cityestate' ),
            'subtitle' => esc_html__( 'Select header style', 'cityestate' ),
            'options'  => array(
                                '1' => esc_html__( 'Normal', 'cityestate' ),
                                '2' => esc_html__( 'Transparent', 'cityestate' ),
                            ),
            'default'  => '1'
        ),

        array(
            'id'       => 'header_menu_with_button',
            'type'     => 'select',
            'title'    => esc_html__( 'Menu Options', 'cityestate' ),
            'subtitle'  => esc_html__( 'Select extra menu options', 'cityestate' ),
            'options'  => array(
                                'submit_property'   => esc_html__( 'Submit Property', 'cityestate' ),
                                'login_register'    => esc_html__( 'Login & Register', 'cityestate' ),
                                'book_now'          => esc_html__( 'Book Now', 'cityestate' ),
                                'contact_me'          => esc_html__( 'Contact Me', 'cityestate' )
                            ),      
            'default'  => ''
        ),

        array(
            'id'       => 'header_menu_url',
            'type'     => 'select',
            'multi'    => true,
            'required' => array( 
                                    array('header_menu_with_button', '!=', 'login_register'),
                                    array('header_menu_with_button', '!=', 'book_now'),
                                    array('header_menu_with_button', '!=', 'contact_me'),
                                ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

         array(
            'id'       => 'header_menu_custom_url',
            'type'     => 'text',
            'multi'    => true,
            'required' => array( 
                                    array('header_menu_with_button', '!=', 'login_register'),
                                    array('header_menu_with_button', '!=', 'submit_property'),
                                ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'default'  => '#'
        ),

        array(
            'id'       => 'header_layout_width',
            'type'     => 'select',
            'title'    => esc_html__( 'Menu Layout', 'cityestate' ),
            'subtitle'  => esc_html__( 'Select menu layout', 'cityestate' ),
            'options'  => array(
                                'container'         => esc_html__( 'Boxed', 'cityestate' ),
                                'container-fluid'   => esc_html__( 'Full Width', 'cityestate' )
                            ),
            'default'  => 'container'
        ),

        array(

            'id'       => 'header_menu_alignment',
            'type'     => 'select',
            'title'    => esc_html__( 'Menu Align', 'cityestate' ),
            'subtitle' => esc_html__( 'Select menu align', 'cityestate' ),
            'options'  => array(
                                'navbar'  => esc_html__( 'Left Align', 'cityestate' ),
                                'navbar-right' => esc_html__( 'Right Align', 'cityestate' )
                            ),
            'default'  => 'navbar'
        ),

        array(
            'id'       => 'header_menu_is_sticky',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sticky Menu Option', 'cityestate' ),
            'subtitle' => esc_html__( 'Enable/Disable sticky menu', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),            

        array(
            'id'     => 'hd_social_end',
            'type'   => 'section',
            'indent' => false
        )       

    )

) );

// Advance Search
Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'Advanced Search', 'cityestate' ),
    'id'               => 'header-search',
    'subsection'       => true,
    'fields'           => array(
        
        array(
            'id'       => 'header_menu_search_is_show',
            'type'     => 'switch',
            'title'    => esc_html__( 'Search Option', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),        

        array(
            'id'       => 'header_search_position',
            'type'     => 'select',
            'required' => array( 'header_menu_search_is_show', '=', '1' ),
            'title'    => esc_html__( 'Search Form Position', 'cityestate' ),
            'options'  => array(
                                'under_nav'     => esc_html__( 'Under Navigation', 'cityestate' ),
                                'under_banner'  => esc_html__( 'Under banner ( Slider, Map etc )', 'cityestate' )
                            ),
            'desc'     => esc_html__( 'Select search form position', 'cityestate' ),
            'default'  => 'under_nav'
        ),

        array(
            'id'       => 'header_search_bar_position',
            'type'     => 'select',
            'required' => array( 'header_menu_search_is_show', '=', '1' ),
            'title'    => esc_html__( 'Select Pages On Which You Want To Show Search Form', 'cityestate' ),
            'options'  => array(
                                'only_home'         => esc_html__( 'Only Homepage', 'cityestate' ),
                                'all_pages'         => esc_html__( 'Homepage + Inner Pages', 'cityestate' ),
                                'only_innerpages'   => esc_html__( 'Only Inner Pages', 'cityestate' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'cityestate' )
                            ),
            'desc'     => esc_html__( 'Select on which pages you want to show search form', 'cityestate' ),
            'default'  => 'all_pages'
        ),

        array(
            'id'       => 'header_search_bar_in_page',
            'type'     => 'select',
            'multi'    => true,
            'required' => array( 'header_search_bar_position', '=', 'specific_pages' ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select multiple pages', 'cityestate' ),
            'data' => 'pages'
        )

    )

) );

// Top Bar
Redux::setSection( $opt_name, array(
    
    'title'            => esc_html__( 'Top Bar', 'cityestate' ),
    'id'               => 'header-top-bar',
    'subsection'       => true,
    'fields'           => array(
        
        array(
            'id'       => 'header_top_bar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show header top bar', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),

        array(
            'id'       => 'header_top_bar_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide Top Bar in Mobile Screen?', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' )
        ),

        array(
            'id'       => 'header_top_bar_left',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Left Part', 'cityestate' ),
            'subtitle' => esc_html__( 'What would you like to show on top bar left part.', 'cityestate' ),
            'options'  => array(
                                'none'                          => esc_html__( 'Nothing', 'cityestate' ),
                                'menu_bar'                      => esc_html__( 'Menu ( Create and assing menu under Appearance -> Menus )', 'cityestate' ),
                                'social_icons'                  => esc_html__( 'Social Icons', 'cityestate' ),
                                'contact_info'                  => esc_html__( 'Contact Info', 'cityestate' ),
                                'login_register'                => esc_html__( 'Login Or Register', 'cityestate' ),
                                'contact_login_register'        => esc_html__( 'Contact Info + Login Or Register', 'cityestate' ),
                                'email_contact'                 => esc_html__( 'Email + Contact Info', 'cityestate' ),
                                'slogan'                        => esc_html__( 'Slogan', 'cityestate' )
                            ),
            'default'  => 'none'
        ),

        array(
            'id'       => 'header_top_bar_right',
            'type'     => 'select',
            'title'    => esc_html__( 'Top Bar Right Part', 'cityestate' ),
            'subtitle' => esc_html__( 'What would you like to show on top bar right part.', 'cityestate' ),
            'options'  => array(
                                'none'                          => esc_html__( 'Nothing', 'cityestate' ),
                                'menu_bar'                      => esc_html__( 'Menu ( Create and assing menu under Appearance -> Menus )', 'cityestate' ),
                                'social_icons'                  => esc_html__( 'Social Icons', 'cityestate' ),
                                'contact_info'                  => esc_html__( 'Contact Info', 'cityestate' ),
                                'login_register'                => esc_html__( 'Login Or Register', 'cityestate' ),
                                'contact_login_register'        => esc_html__( 'Contact Info + Login Or Register', 'cityestate' ),
                                'email_contact'                 => esc_html__( 'Email + Contact Info', 'cityestate' ),
                                'slogan'                        => esc_html__( 'Slogan', 'cityestate' )
                            ),
            'default'  => 'none'
        ),

        // Header Call Us Part
        array(
            'id'       => 'hd_contact_start',
            'type'     => 'section',            
            'title'    => esc_html__( 'Contact Number', 'cityestate' ),
            'indent'   => true
        ),

        array(
            'id'       => 'header_top_bar_call_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'cityestate' ),            
            'default'  => 'Call Us'
        ),

        array(
            'id'       => 'header_top_bar_phone_number',
            'type'     => 'text',            
            'title'    => esc_html__( 'Phone Number', 'cityestate' ),
            'default'  => '367-254-7690'            
        ),

        array(
            'id'       => 'hd_email_start',
            'type'     => 'section',            
            'title'    => esc_html__( 'Contact Email', 'cityestate' ),
            'indent'   => true
        ),

        array(
            'id'       => 'header_top_bar_email',
            'type'     => 'text',
            'title'    => esc_html__( 'Email ID', 'cityestate' ),            
            'default'  => 'info@cityestate.com'
        ),

        array(
            'id'     => 'hd_contact_end',
            'type'   => 'section',
            'indent' => false
        ),

        // Header Login or Register
        array(
            'id'       => 'hd_login_register',
            'type'     => 'section',            
            'title'    => esc_html__( 'Login or Register', 'cityestate' ),
            'indent'   => true
        ),

        array(
            'id'        => 'header_top_bar_login_register',
            'type'      => 'textarea',            
            'title'     => esc_html__( 'Login or Register Text', 'cityestate' ),
            'default'  => 'Login or Register'
        ),

        array(
            'id'        => 'header_top_bar_logout',
            'type'      => 'textarea',            
            'title'     => esc_html__( 'Logout Text', 'cityestate' ),
            'default'  => 'Logout'
        ),

        // Header Slogan Part
        array(
            'id'       => 'hd_slogan_part',
            'type'     => 'section',            
            'title'    => esc_html__( 'Website Slogan', 'cityestate' ),
            'indent'   => true
        ),

        array(
            'id'        => 'header_top_bar_slogan',
            'type'      => 'textarea',            
            'title'     => esc_html__( 'Website Slogan', 'cityestate' ),
            'subtitle'  => esc_html__( 'Enter website slogan', 'cityestate' )
        ),
        
        // Header Socail Media Part
        array(
            'id'       => 'hd_social_start',
            'type'     => 'section',            
            'title'    => esc_html__( 'Social Media Information', 'cityestate' ),
            'indent'   => true
        ),
        
        array(
            'id'       => 'header_top_bar_social_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'cityestate' ),            
            'default'  => 'We are social'
        ),

        array(
            'id'        => 'tob_par_facebook',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Facebook profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Facebook Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_twitter',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Twitter profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Twitter Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_google',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Google profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Google Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_pinterest',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Pinterest profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Pinterest Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_youtube',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Youtube profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Youtube Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_dribbble',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Dribbble profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Dribbble Profile URL', 'cityestate' ),
            'default'   => '#'
        ),            

        array(
            'id'        => 'tob_par_vimeo',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Vimeo profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Vimeo Profile URL', 'cityestate' ),
            'default'   => '#'
        ),                        

        array(
            'id'        => 'tob_par_linkedin',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Linkedin profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Linkedin Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_rss',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Rss profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Rss Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_instagram',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Instagram profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Instagram Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_flickr',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Flickr profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Flickr Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_reddit',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Reddit profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Reddit Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_delicious',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Delicious profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Delicious Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_lastfm',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Lastfm profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Lastfm Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_tumblr',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Tumblr profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Tumblr Profile URL', 'cityestate' ),
            'default'   => '#'
        ),

        array(
            'id'        => 'tob_par_skype',
            'type'      => 'text',
            'desc'      => esc_html__( 'Enter Skype profile URL', 'cityestate' ),
            'title'     => esc_html__( 'Skype Profile URL', 'cityestate' ),
            'default'   => '#'
        ),        

    )

) );

?>