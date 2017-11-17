<?php

// General
Redux::setSection( $opt_name, array(

    'title'  => esc_html__( 'General', 'cityestate' ),
    'id'     => 'general',
    'icon'   => 'el-icon-home',
    'fields' => array(

        array(
            'id'       => 'property_submit_by_user',
            'type'     => 'select',
            'title'    => esc_html__( 'Submit Property From Frontend', 'cityestate' ),
            'options'  => array(
                                'yes'   => esc_html__( 'Yes', 'cityestate' ),
                                'no'    => esc_html__( 'No', 'cityestate' )
                            ),
            'subtitle' => esc_html__( 'User or/and agent can submit property from frontend.', 'cityestate' ),
            'default'  => 'yes'
        ),        
        
        array(
            'id'       => 'show_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Breadcrumb?', 'cityestate' ),
            'subtitle' => esc_html__( 'Show/Hide breadcrumb', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),

        array(
            'id'       => 'show_breadcrumb_in_page',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'required' => array( 'show_breadcrumb', '=', '1' ),
            'options'  => array(
                                'only_home'         => esc_html__( 'Only Homepage', 'cityestate' ),
                                'all_pages'         => esc_html__( 'Homepage + Inner Pages', 'cityestate' ),
                                'only_innerpages'   => esc_html__( 'Only Inner Pages', 'cityestate' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'cityestate' )
                            ),
            'subtitle' => esc_html__( 'Select pages on which you want to show breadcrumb', 'cityestate' ),
            'default'  => 'only_innerpages'
        ),

        array(
            'id'       => 'show_breadcrumb_in_specific',
            'type'     => 'select',
            'multi'    => true,
            'required' => array( 'show_breadcrumb_in_page', '=', 'specific_pages' ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select multiple pages', 'cityestate' ),
            'data'     => 'pages'
        ),
    
    )

) );