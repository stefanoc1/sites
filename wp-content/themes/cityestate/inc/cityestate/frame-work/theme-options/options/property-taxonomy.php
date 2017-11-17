<?php

// Property Taxonomy
Redux::setSection( $opt_name, array(

    'title'     => esc_html__( 'Property Category', 'cityestate' ),
    'id'        => 'cityestate-property-taxonomy',    
    'icon'      => 'el-icon-globe',
    'fields'    => array(

        array(
            'id'        => 'taxonomy_per_page',
            'type'      => 'text',
            'title'     => esc_html__( 'Number of property per page ', 'cityestate' ),
            'default'   => '9'
        ),

        array(
            'id'        => 'taxonomies_list_list_view',
            'type'      => 'select',
            'title'     => esc_html__( 'Categories Default View', 'cityestate' ),
            'subtitle'  => esc_html__( 'Select default view for categories( City, Area, Type, Status, State ) pages. ', 'cityestate' ),
            'options'   => array(
                                    'list_list_view' => esc_html__( 'List View', 'cityestate' ),
                                    'list_grid_view' => esc_html__( 'Grid View', 'cityestate' ),
                                ),
            'default'   => 'list_list_view'
        ),

        array(
            'id'        => 'taxonomies_default_order',
            'type'      => 'select',
            'title'     => esc_html__( 'Order Properties By', 'cityestate' ),
            'subtitle'  => esc_html__( 'Select default view for categories( City, Area, Type, Status, State ) pages. ', 'cityestate' ),
            'options'   => array(
                                    'sort_lh'  => esc_html__( 'Price (Low to High)', 'cityestate' ),
                                    'sort_hl'  => esc_html__( 'Price (High to Low)', 'cityestate' ),
                                    'featured'  => esc_html__( 'Featured', 'cityestate' ),
                                    'sort_on'   => esc_html__( 'Date Old to New', 'cityestate' ),
                                    'sort_no'   => esc_html__( 'Date New to Old', 'cityestate' ),
                                ),
            'default'   => 'sort_lh'
        ),
                
        array(
            'id'        => 'taxonomies_sidebar_position',
            'type'      => 'select',
            'title'     => esc_html__( 'Sidebar Position', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose categories sidebar position for categories( City, Area, Type, Status, State ) pages. ', 'cityestate' ),
            'options'   => array(
                                    'none'  => esc_html__( 'None', 'cityestate' ),                                   
                                    'right' => esc_html__( 'Right Sidebar', 'cityestate' ),
                                    'left'  => esc_html__( 'Left Sidebar', 'cityestate' )
                                ),
            'default'   => 'right',            
        ),

        array(
            'id'        => 'taxonomies_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Choose Sidebar', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose categories sidebar for categories( City, Area, Type, Status, State ) pages. ', 'cityestate' ),
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
            'default'   => 'property-listing',
            'required'  => array('taxonomies_sidebar_position', '!=', 'none' ),
        ),

    )

));

?>