<?php

// Agents
Redux::setSection( $opt_name, array(

    'title'  => esc_html__( 'Agents', 'cityestate' ),
    'id'     => 'cityestate-agents',
    'icon'   => 'el-icon-cog',
    'fields' => array(    	

        array(
            'id'        => 'section_agent_list',
            'type'      => 'section',
            'title'     => esc_html__( 'Agents List Page', 'cityestate' ),
            'indent'    => true
        ),

        array(
            'id'        => 'list_agent_per_page',
            'type'      => 'text',
            'title'     => esc_html__( 'Number of agents per page ', 'cityestate' ),
            'default'   => '9'
        ),

        array(
            'id'        => 'section_about_agent',
            'type'      => 'section',            
            'title'     => esc_html__( 'Agents Detail Page', 'cityestate' ),
            'indent'    => true
        ),

        array(
            'id'       => 'agent_property_list',
            'type'     => 'select',
            'title'    => esc_html__( 'Agent Properties Layout', 'cityestate' ),
            'subtitle' => esc_html__( 'Select properties layout for agent property list.', 'cityestate' ),
            'options'  => array(
                                'list_list_view' => esc_html__( 'List View', 'cityestate' ),
                                'list_grid_view' => esc_html__( 'Grid View', 'cityestate' ),
                            ),
            'default' => 'list_list_view'
        ),

        array(
            'id'        => 'sidebar_position',
            'type'      => 'select',
            'title'     => esc_html__( 'Select Sidebar Position', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose page Sidebar Position', 'cityestate' ),
            'options'   => array(
                                    'none'     => esc_html__( 'None', 'cityestate' ),                                   
                                    'right'    => esc_html__( 'Right Sidebar', 'cityestate' ),
                                    'left'     => esc_html__( 'Left Sidebar', 'cityestate' )
                            ),
            'default'  => 'right'
        ),

        array(
            'id'        => 'page_sidebar',
            'type'      => 'select',
            'title'     => esc_html__( 'Choose Sidebar To Display', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose Agent Detail Page Sidebar', 'cityestate' ),
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
            'default'  => 'property-listing'
        ),

    )

));

?>