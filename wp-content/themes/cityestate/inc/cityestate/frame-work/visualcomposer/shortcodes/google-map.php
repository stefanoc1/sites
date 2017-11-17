<?php

vc_map( 
	array(
	    'name' 			=> esc_html__( 'Cityestate GoogleMap', 'cityestate' ),
	    'base' 			=> 'gmap',
		'description' 	=> esc_html__( 'Google map', 'cityestate' ),
	    'icon' 			=> 'google_map',
		'category' 		=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
	    'params'		=> array(

			array(
				'heading' 		=> esc_html__( 'Latitude', 'cityestate' ),
				'description' 	=> wp_kses( __( 'This option is not necessary if an address is set.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'latitude',
				'type' 			=> 'textfield',
			),

			array(
				'heading' 		=> esc_html__( 'Longitude', 'cityestate' ),
				'description' 	=> wp_kses( __( 'This option is not necessary if an address is set.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'longitude',
				'type' 			=> 'textfield',
			),

			array(
				'heading' 		=> esc_html__( 'Zoom', 'cityestate' ),
				'description' 	=> wp_kses( __('Default map zoom level. (1-19)<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'zoom',
				'std' 			=> '17',
				'type' 			=> 'textfield'
			),

			array(
				'heading' 		=> esc_html__( 'Scrollwheel', 'cityestate' ),
				'param_name' 	=> 'scrollwheel',
				'description' 	=> '<br/>',
				'value' 		=> array( esc_html__( 'Enable', 'cityestate' ) => 'enable' ),
				'type' 			=> 'checkbox'
			),

			array(
				'heading' 		=> esc_html__( 'Marker', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Enable an arrow pointing at the address.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'marker',
				'value' 		=> array( esc_html__( 'Enable', 'cityestate' ) => 'enable' ),
				'type' 			=> 'checkbox',
				'std' 			=> 'enable',
			),

			array(
				'param_name' 	=> 'marker_image',
				'type' 			=> 'attach_image',
				'heading' 		=> esc_html__( 'Marker Image/Icon', 'cityestate')  ,
				'description' 	=> esc_html__( 'Select the custom google map marker image or icon ', 'cityestate')  ,
				'save_always' 	=> true
			),

			array(
				'heading' 		=> esc_html__( 'Popup Marker Content', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Content to be shown in a popup above the marker.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'html',
				'type' 			=> 'textarea',
			),

			array(
				'heading' 		=> esc_html__( 'MapType', 'cityestate' ),
				'param_name' 	=> 'maptype',
				'description' 	=> '<br/>',
				'std' 			=> 'ROADMAP',
				'value' 		=> array(
										esc_html__( 'Default road map', 'cityestate' ) => 'ROADMAP',
										esc_html__( 'Google Earth satellite', 'cityestate' ) => 'SATELLITE',
										esc_html__( 'Mixture of normal and satellite', 'cityestate' ) => 'HYBRID',
										esc_html__( 'Physical map', 'cityestate' ) => 'TERRAIN',
									),
				'type' 			=> 'dropdown',
			),

			array(
				'heading' 		=> esc_html__( 'Width (optional)', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Default is 100%.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'width',
				'std' 			=> '100%',
				'type' 			=> 'textfield'
			),
			
			array(
				'heading' 		=> esc_html__( 'Height', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Default is 500px.<br/><br/>', 'cityestate' ), array( 'br' => array() ) ),
				'param_name' 	=> 'height',
				'std' 			=> '500px',
				'type' 			=> 'textfield'				
			),
		),        
    ) 
);

?>