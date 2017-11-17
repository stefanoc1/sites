<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Taxonomy Grid', 'cityestate' ),
		'base' 		=> 'taxonomy_grid',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'icon' 		=> 'taxonomy-grid',
		'params' 	=> array(			

			array(
				'param_name' 	=> 'taxonomy_type',
				'type'     		=> 'dropdown',
				'value' 		=> array(
											esc_html__( 'Select', 'cityestate' )			=> 'select',
											esc_html__( 'Property Type', 'cityestate' )		=> 'property_type',
											esc_html__( 'Property Status', 'cityestate' )	=> 'property_status',
											esc_html__( 'Property Feature', 'cityestate' )	=> 'property_feature',
											esc_html__( 'Property City', 'cityestate' )		=> 'property_city',
											esc_html__( 'Property Area', 'cityestate' )		=> 'property_area',
											esc_html__( 'Property Location', 'cityestate' )	=> 'property_location',
										),
				'heading' 		=> esc_html__( 'Taxonomy Type Filter:', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'property_type',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_type_id( false ),
				'heading' 		=> esc_html__( 'Property Type:', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'taxonomy_type', 'value' => array( 'property_type' ) ),
			),

			array(
				'param_name' 	=> 'property_status',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_status_id( false ),
				'heading' 		=> esc_html__( 'Property Status:', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'taxonomy_type', 'value' => array( 'property_status' ) ),
			),

			array(
				'param_name' 	=> 'property_feature',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_features_id( false ),
				'heading' 		=> esc_html__( 'Property Feature:', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'taxonomy_type', 'value' => array( 'property_feature' ) ),
			),

			array(
				'param_name' 	=> 'property_city',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_city_id( false ),
				'heading' 		=> esc_html__( 'Property City:', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'taxonomy_type', 'value' => array( 'property_city' ) ),
			),

			array(
				'param_name' 	=> 'property_area',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_area_id( false ),
				'heading' 		=> esc_html__( 'Property Area:', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'taxonomy_type', 'value' => array( 'property_area' ) ),
			),

			array(
				'param_name' 	=> 'property_location',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_location_id( false ),
				'heading' 		=> esc_html__( 'Property State / Country:', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'taxonomy_type', 'value' => array( 'property_location' ) ),
			),

			array(
				'param_name' 	=> 'taxonomy_image',
				'type' 			=> 'attach_image',
				'heading' 		=> esc_html__( 'Taxonomy Image', 'cityestate' ),
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'show_taxonomy_name',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Yes', 'cityestate' ) => 'yes', esc_html__( 'No', 'cityestate' ) => 'no' ),
				'heading' 		=> esc_html__( 'Show Taxonomy Name:', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'custom_taxonomy_label',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Select', 'cityestate' ) => '', esc_html__( 'Yes', 'cityestate' ) => 'yes', esc_html__( 'No', 'cityestate' ) => 'no' ),
				'heading' 		=> esc_html__( 'Customize Property Counter Label:', 'cityestate' ),
				'dependency' 	=> array( 'element' => 'show_taxonomy_name', 'value' => array( 'yes' ) ),
			),

			array(
				'type' 			=> 'textfield',				
				'param_name' 	=> 'taxonomy_label',				
				'heading' 		=> esc_html__( 'Custom Taxonomy Label', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'custom_taxonomy_label', 'value' => array( 'yes' ) ),
			),

			array(
				'param_name' 	=> 'show_counter_property',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Yes', 'cityestate' ) => 'yes', esc_html__( 'No', 'cityestate' ) => 'no' ),
				'heading' 		=> esc_html__( 'Show Property Counter:', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'custom_counter_label',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Select', 'cityestate' ) => '', esc_html__( 'Yes', 'cityestate' ) => 'yes', esc_html__( 'No', 'cityestate' ) => 'no' ),
				'heading' 		=> esc_html__( 'Customize Property Counter Label:', 'cityestate' ),
				'dependency' 	=> array( 'element' => 'show_counter_property', 'value' => array( 'yes' ) ),
			),

			array(
				'type' 			=> 'textfield',				
				'param_name' 	=> 'counter_label',				
				'heading' 		=> esc_html__( 'Custom Counter Label', 'cityestate' ),				
				'dependency' 	=> array( 'element' => 'custom_counter_label', 'value' => array( 'yes' ) ),
			),

		)
	)
);

?>