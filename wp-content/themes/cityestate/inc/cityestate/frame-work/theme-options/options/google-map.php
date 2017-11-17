<?php

// Google Map
Redux::setSection( $opt_name, array(

    'title'     => esc_html__( 'Google Map Settings', 'cityestate' ),
    'id'        => 'cityestate-googlemap-settings',    
    'icon'      => 'el-icon-globe',
    'fields'    => array(

        array(
            'id'       => 'google_map_ssl_key',
            'type'     => 'select',
            'title'    => esc_html__( 'Google Maps With SSL', 'cityestate' ),
            'subtitle' => esc_html__( 'Use google maps with ssl', 'cityestate' ),
            'options'  => array(
				                'no' 	=> esc_html__( 'No', 'cityestate' ),
				                'yes'   => esc_html__( 'Yes', 'cityestate' )
				            ),
            'default'  => 'no'
        ),

        array(
            'id'       => 'google_map_api_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Google Maps API KEY', 'cityestate' ),
            'desc'     => wp_kses( __( 'We strongly encourage you to get an APIs Console key and post the code in Theme Options. You can get it from <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key">here</a>.', 'cityestate' ), $allowed_html_array ),
            'subtitle' => esc_html__( 'Enter your google maps api key', 'cityestate' ),
            'default'  => ''            
        ),

        array(
            'id'       => 'google_map_default_zoom',
            'type'     => 'text',
            'title'    => esc_html__( 'Set Default Map Zoom', 'cityestate' ),
            'subtitle' => esc_html__( '1 to 20', 'cityestate' ),
            'default'  => '12'
        ),

        array(
            'id'       => 'google_map_pin_cluster_show',
            'type'     => 'select',
            'title'    => esc_html__( 'Set Pin Cluster', 'cityestate' ),
            'subtitle' => esc_html__( 'Use pin cluster on google map', 'cityestate' ),
            'options'  => array(
				                'yes'   => esc_html__( 'Yes', 'cityestate' ),
				                'no'   	=> esc_html__( 'No', 'cityestate' )
				            ),
            'default'  => 'yes'
        ),

        array(
            'id'       => 'google_map_style',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Select Style for Google Map', 'cityestate' ),
            'subtitle' => esc_html__( 'Use https://snazzymaps.com/ to create styles', 'cityestate' ),
            'mode'     => 'plain'
        )

    )

));

?>