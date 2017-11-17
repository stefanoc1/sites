<?php

// Style
Redux::setSection( $opt_name, array(
    
    'title' => esc_html__( 'Style Options', 'cityestate' ),
    'id'    => 'styling',    
    'icon'  => 'el-icon-brush'

) );

Redux::setSection( $opt_name, array(

    'title'  		=> esc_html__( 'Body Style', 'cityestate' ),
    'id'     		=> 'styling-body',
    'subsection' 	=> true,
    'fields' 		=> array(

        array(
            'id'            => 'body_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Background Color', 'cityestate' ),
            'subtitle'      => esc_html__( 'Choose body background color', 'cityestate' ),
            'default'       => '#ffffff',
            'transparent'   => false
        ),

    )

));


Redux::setSection( $opt_name, array(
    
    'title'  		=> esc_html__( 'Headers', 'cityestate' ),
    'id'     		=> 'styling-headers',
    'subsection' 	=> true,
    'fields' 		=> array(
        
        // Header One
        array(
            'id'            => 'header_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Header Background Color', 'cityestate' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'topbar_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Topbar Background Color', 'cityestate' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'topbar_social_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Topbar Social Icon Color', 'cityestate' ),
            'default'       =>'#8696ab',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'topbar_social_hover_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Topbar Social Icon Hover Color', 'cityestate' ),
            'default'       =>'#0f1e32',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'            => 'menu_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Menu Background Color', 'cityestate' ),
            'default'       =>'#ffffff',
            'mode'          => 'background',
            'transparent'   => false
        ),

        array(
            'id'       		=> 'menu_links_color',
            'type'     		=> 'color',
            'title'    		=> esc_html__( 'Menu Links color', 'cityestate' ),
            'default'  		=> '#5f6e82',
            'transparent' 	=> false
        ),

        array(
            'id'       => 'menu_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Menu Links Hover color', 'cityestate' ),
            'default'  => '#323a45',
            'transparent'   => false
        ),

        array(
            'id'     => 'info-header-submenu',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => esc_html__( 'Sub Menu Dropdown', 'cityestate' )            
        ),

        array(
            'id'       => 'submenu_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Submenu Background Color', 'cityestate' ),
            'default'  => '#FFFFFF',
            'transparent' => false
        ),

        array(
            'id'            => 'submenu_links_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Submenu Links color', 'cityestate' ),
            'default'       => '#5f6e82',
            'transparent'   => false
        ),

        array(
            'id'       => 'submenu_links_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Submenu Links Hover color', 'cityestate' ),
            'default'  => '#323a45',
            'transparent'   => false
        ),

        array(
            'id'            => 'submenu_border_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Submenu Border color', 'cityestate' ),
            'default'       => '#c3d2e6',
            'transparent'   => false
        ),

        array(
            'id'            => 'submit_property_bg_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Submit Property Background Color', 'cityestate' ),
            'default'       => '#ffffff',
            'transparent'   => false
        ),

        array(
            'id'       => 'submit_property_link_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Submit Property Links color', 'cityestate' ),
            'default'  => '#fd7f59',
            'transparent'   => false
        ),

        array(
            'id'            => 'submit_property_border_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Submit Property Border Hover color', 'cityestate' ),
            'default'       => '#fd7f59',
            'transparent'   => false
        ),

        array(
            'id'            => 'submit_property_bg_hover_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Submit Property Background Hover Color', 'cityestate' ),
            'default'       => '#fd7f59',
            'transparent'   => false
        ),

        array(
            'id'       => 'submit_property_link_hover_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Submit Property Links Hover color', 'cityestate' ),
            'default'  => '#ffffff',
            'transparent'   => false
        ),

        array(
            'id'            => 'submit_property_border_hover_color',
            'type'          => 'color',
            'title'         => esc_html__( 'Submit Property Border color', 'cityestate' ),
            'default'       => '#fd7f59',
            'transparent'   => false
        ),

    )

));

/* Advance Search
----------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    
    'title'         => esc_html__( 'Advanced Search', 'cityestate' ),
    'id'            => 'styling-advanced-search',
    'subsection'    => true,
    'fields'        => array(

        array(
            'id'       => 'advance_search_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Advance Search Background Color', 'cityestate' ),
            'subtitle' => esc_html__( 'Pick a background color for the advanced search (default: #01c0c8).', 'cityestate' ),
            'default'  => '#01c0c8',
            'transparent' => false
        ),

        array(
            'id'       => 'advacne_search_filed_btn_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Advance search filed open close buton color', 'cityestate' ),
            'default'  => '#fd7f59',
            'transparent' => false
        ),

        array(
            'id'       => 'advacne_search_submit_btn_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Advance search submit buton color', 'cityestate' ),
            'default'  => '#fd7f59',
            'transparent' => false
        ),

        array(
            'id'       => 'advacne_search_submit_btn_text_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Advance search submit buton color', 'cityestate' ),
            'default'  => '#ffffff',
            'transparent' => false
        ),

        array(
            'id'       => 'advacne_search_form_elements_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Advance search form element background color', 'cityestate' ),
            'default'  => '#ffffff',
            'transparent' => false
        ),

        array(
            'id'       => 'advacne_search_position',
            'type'     => 'select',
            'title'    => esc_html__( 'Advance search form position', 'cityestate' ),
            'options'  => array(
                                'absolute'   => esc_html__( 'Absolute', 'cityestate' ),
                                'realative'    => esc_html__( 'Relative', 'cityestate' )
                            ),
            'default'  => 'relative'
        ),

        array(
            'id'       => 'advacne_search_marign_top',
            'type'     => 'text',
            'title'    => esc_html__( 'Advance search margin top in px (10px)', 'cityestate' ),
            'default'  => '0'
        ),

    )

));

Redux::setSection( $opt_name, array(
    
    'title'         => esc_html__( 'Dashboard', 'cityestate' ),
    'id'            => 'styling-dashboard',
    'subsection'    => true,
    'fields'        => array(

        array(
            'id'       => 'dashbord_mytabs_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Dashboard Tabs Background Color', 'cityestate' ),
            'subtitle' => esc_html__( 'Pick a background color for the dashboard tab (default: #323A45).', 'cityestate' ),
            'default'  => '#323A45',
            'transparent' => false
        ),

        array(
            'id'       => 'dashboard_mytabs_marign_top',
            'type'     => 'text',
            'title'    => esc_html__( 'Dashboard tabs margin top in px (10px)', 'cityestate' ),
            'default'  => '0'
        ),

    )

));

?>