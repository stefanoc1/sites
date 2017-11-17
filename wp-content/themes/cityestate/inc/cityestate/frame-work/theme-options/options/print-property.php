<?php

// Property Print
Redux::setSection( $opt_name, array(
    
    'title'  => esc_html__( 'Print Property Details', 'cityestate' ),
    'id'     => 'print_property_detail',
    'icon'   => 'el-icon-print el-icon-small',
    'fields' => array(

        array(
            'id'		=> 'property_print_logo',
            'url'		=> true,
            'type'		=> 'media',
            'title'		=> esc_html__( 'Print Property Logo', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> array( 'url'	=> get_template_directory_uri() .'/images/logo.png' ),
            'subtitle'	=> esc_html__( 'Upload your custom site logo for print with property details.', 'cityestate' ),
        ),

        array(
            'id'       => 'show_print_property_desctiption',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Description', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' ),
        ),

        array(
            'id'       => 'show_print_property_basic_detail',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Details', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' ),
        ),

        array(
            'id'       => 'show_print_property_floor_plan',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Floor Plans Information', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' ),
        ),

        array(
            'id'       => 'show_print_property_gallery',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Photo Gallery', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' ),
        ),

        array(
            'id'       => 'show_print_property_agent',
            'type'     => 'switch',
            'title'    => esc_html__( 'Property Agent Info', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' ),
        ),

    )

));