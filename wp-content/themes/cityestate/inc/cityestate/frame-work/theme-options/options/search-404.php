<?php

// 404 Page
Redux::setSection( $opt_name, array(

    'title'  	=> esc_html__( 'Search & 404', 'cityestate' ),
    'id'     	=> 'search-404',
    'icon'   	=> 'el-icon-error',
    'fields'	=> array(

        array(
            'id'       => 'search-page',
            'type'     => 'section',            
            'title'    => esc_html__( 'Search Page', 'cityestate' ),
            'indent'   => true
        ),

        array(
            'id'        => 'search_banner_image',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Select banner image for search page.', 'cityestate' ),
            'read-only' => false,            
        ),

        array(
            'id'        => 'search_sidebar_position',
            'type'      => 'select',
            'title'     => esc_html__( 'Sidebar Position', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose sidebar position for search page.', 'cityestate' ),
            'options'   => array(
                                    'none'  => esc_html__( 'None', 'cityestate' ),                                   
                                    'right' => esc_html__( 'Right Sidebar', 'cityestate' ),
                                    'left'  => esc_html__( 'Left Sidebar', 'cityestate' )
                                ),
            'default'   => 'right',            
        ),

        array(
            'id'        => 'search_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Choose Sidebar', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose sidebar for search page. ', 'cityestate' ),
            'options'   => array(
                                    'none'                      => esc_html__( 'None', 'cityestate' ),                                   
                                    'right-sidebar'             => esc_html__( 'Right Sidebar', 'cityestate' ),
                                    'left-sidebar'              => esc_html__( 'Left Sidebar', 'cityestate' ),
                                    'property-listing'          => esc_html__( 'Property Listings', 'cityestate' ),
                                    'single-property'           => esc_html__( 'Single Property', 'cityestate' ),
                                    'agent-sidebar'             => esc_html__( 'Agent Sidebar', 'cityestate' ),
                                    'search-sidebar'            => esc_html__( 'Search Sidebar', 'cityestate' ),
                                    'page-sidebar'              => esc_html__( 'Page Sidebar', 'cityestate' ),
                                    'idx-sidebar'               => esc_html__( 'IDX Sidebar', 'cityestate' ),                                    
                                ),
            'default'   => 'default-sidebar',
            'required'  => array('search_sidebar_position', '!=', 'none' ),
        ),

        array(
            'id'       => '404-page',
            'type'     => 'section',            
            'title'    => esc_html__( 'Page 404', 'cityestate' ),
            'indent'   => true
        ),

        array(
            'id'       => '404_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Page Title', 'cityestate' ),            
            'default'  => 'Oh oh! Page not found.'
        ),

        array(
            'id'        => '404_description',
            'type'      => 'text',
            'title'     => esc_html__( 'Page Description', 'cityestate' ),
            'default'   => "We're sorry, the page you are looking for doesn't exist.<br>
                			You can search your topic using the box below or return to the homepage."
        )

    )

));

?>