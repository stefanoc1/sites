<?php

// Property
Redux::setSection( $opt_name, array(

    'title'  	=> esc_html__( 'Property Detail Page', 'cityestate' ),
    'id'     	=> 'property-page',
    'icon'   	=> 'el-icon-cog',
    'fields'	=> array(

        array(
            'id'       => 'property_page_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Property Content Layout', 'cityestate' ),
            'options'  => array(
				                'default'   => esc_html__( 'Default', 'cityestate' ),
				                'tabs'      => esc_html__( 'Tabs', 'cityestate' ),				                
				            ),
            'default'  => 'default'
        ),

        array(
            'id'       => 'show_print_property',
            'type'     => 'switch',
            'title'    => esc_html__( 'Print Property Button', 'cityestate' ),
            'subtitle' => esc_html__( 'Enable/Disable print property button', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' ),
        ),

        array(
            'id'       => 'property_page_show_agent',
            'type'     => 'switch',
            'title'    => esc_html__( 'Agent Contact Forms', 'cityestate' ),
            'subtitle' => esc_html__( 'Enable/Disable agent contact forms.', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),

        array(
            'id'        => 'property_page_similar',
            'type'      => 'text',
            'title'     => esc_html__( 'Number Of Similar Property', 'cityestate' ),
            'subtitle'  => esc_html__( 'Number of similar property listing in property detail page.', 'cityestate' ),
            'default'   => 6,
        ),

    )

));

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Layout Manager', 'cityestate' ),
    'id'            => 'property-section',
    'subsection'    => true,
    'fields'        => array(
        
        array(
            'id'      => 'property_detail_layout',
            'type'    => 'sorter',
            'title'   => 'Property Layout Manager',
            'desc'    => esc_html__( 'Drag and drop layout manager, to quickly organize your property layout contents.', 'cityestate' ),
            'options' => array(
                'enabled'  => array(
                    'description'           => esc_html__( 'Description', 'cityestate' ),
                    'details'               => esc_html__( 'Details', 'cityestate' ),
                    'floor_plans'           => esc_html__( 'Floor Plans', 'cityestate' ),
                    'property_documents'    => esc_html__( 'Property Documents', 'cityestate' ),
                    'walkscore'             => esc_html__( 'Walkscore', 'cityestate'),                                     
                    'property_video'        => esc_html__( 'Property Video', 'cityestate' ),
                    'near_by_place'         => esc_html__( 'Near By Place', 'cityestate' ),
                    'get_directions'        => esc_html__( 'Get Directions', 'cityestate' ),
                    'share_property'        => esc_html__( 'Share Property', 'cityestate' ),
                    'similar_properties'    => esc_html__( 'Similar Properties', 'cityestate' ),
                ),
                'disabled' => array()
            ),
        )
    )
));

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Layout Manager Tabs', 'cityestate' ),
    'id'            => 'property-section-tabs',
    'desc'          => '',
    'subsection'    => true,
    'fields'        => array(

        array(
            'id'      => 'property_detail_layout_tabs',
            'type'    => 'sorter',
            'title'   => esc_html__( 'Property Tabs Version Layout Manager', 'cityestate' ),
            'desc'    => esc_html__( 'Drag and drop layout manager, to quickly organize your property layout contents.', 'cityestate' ),
            'options' => array(
                                'enabled'  => array(
                                    'description'           => esc_html__( 'Description', 'cityestate' ),
                                    'details'               => esc_html__( 'Details', 'cityestate' ),
                                    'floor_plans'           => esc_html__( 'Floor Plans', 'cityestate' ),
                                    'property_documents'    => esc_html__( 'Property Documents', 'cityestate' ),
                                    'walkscore'             => esc_html__( 'Walkscore', 'cityestate'),                                     
                                    'property_video'        => esc_html__( 'Property Video', 'cityestate' ),
                                    'near_by_place'         => esc_html__( 'Near By Place', 'cityestate' ),
                                    'get_directions'        => esc_html__( 'Get Directions', 'cityestate' ),
                                    'share_property'        => esc_html__( 'Share Property', 'cityestate' ),
                                    'similar_properties'    => esc_html__( 'Similar Properties', 'cityestate' ),
                                ),
                                'disabled' => array()
            ),
        )

    )

));

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Share Property', 'cityestate' ),
    'id'            => 'share-property',
    'desc'          => '',
    'subsection'    => true,
    'fields'        => array(

        array(
            'id'       => 'property_detail_share_social',
            'type'     => 'switch',
            'title'    => esc_html__( 'Share Property', 'cityestate' ),
            'subtitle' => esc_html__( 'Enable/Disable share property on property detail page.', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' ),
        ),

        array(
            'id'      => 'property_detail_share_show',
            'type'    => 'sorter',
            'title'   => esc_html__( 'Share Property Manager', 'cityestate' ),
            'desc'    => esc_html__( 'Drag and drop social media manager.', 'cityestate' ),
            'options' => array(
                                'enabled'  => array(
                                    'facebook'      => esc_html__( 'Facebook', 'cityestate' ),
                                    'twitter'       => esc_html__( 'Twitter', 'cityestate' ),
                                    'google_plus'   => esc_html__( 'Google Plus', 'cityestate'),                                     
                                ),
                                'disabled' => array(
                                    'pinterest'     => esc_html__( 'Pinterest', 'cityestate' ),
                                    'email'         => esc_html__( 'Email', 'cityestate' ),
                                )
            ),
            'required' => array( 'property_detail_share_social', '=', '1' )
        )
    )

));

?>