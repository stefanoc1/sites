<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Properties Carousel', 'cityestate' ),
		'base' 		=> 'cityestate_carousel',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'property-carousel',
		'params' 	=> array(			

			array(
				'param_name' 	=> 'property_type',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_type_id(),
				'heading' 		=> esc_html__( 'Property Type Filter:', 'cityestate' ),				
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'property_status',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_status_id(),
				'heading' 		=> esc_html__( 'Property Status Filter:', 'cityestate' ),				
				'save_always' 	=> true

			),

			array(
				'param_name' 	=> 'property_city',
				'type' 			=> 'dropdown',
				'value' 		=> cityestate_admin_property_city_id(),
				'heading' 		=> esc_html__( 'Property City Filter:', 'cityestate' ),				
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'property_area',
				'type' 			=> 'dropdown',
				'value'		 	=> cityestate_admin_property_area_id(),
				'heading' 		=> esc_html__( 'Property Area Filter:', 'cityestate' ),				
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'property_location',
				'type' 			=> 'dropdown',
				'value'		 	=> cityestate_admin_property_location_id(),
				'heading' 		=> esc_html__( 'Property State / Country Filter:', 'cityestate' ),				
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'property_label',
				'type' 			=> 'dropdown',
				'value'		 	=> cityestate_admin_property_label_id(),
				'heading' 		=> esc_html__( 'Property State Filter:', 'cityestate' ),				
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'featured_property',
				'type' 			=> 'dropdown',
				'value' 		=> array( '- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes' ),
				'heading' 		=> esc_html__( 'Featured Properties:', 'cityestate' ),
				'description' 	=> esc_html__( 'You can make a post featured by clicking featured properties checkbox while add/edit post', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'property_id',
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading' 		=> esc_html__( 'Properties IDs:', 'cityestate' ),
				'description' 	=> esc_html__( 'Enter properties ids comma separated. Ex 12,305,34', 'cityestate' ),
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'posts_limit',
				'type' 			=> 'textfield',
				'value' 		=> '18',
				'heading' 		=> esc_html__( 'Limit property number:', 'cityestate' ),				
				'save_always' 	=> true,
			),

			array(
				'param_name' 	=> 'offset',
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading' 		=> esc_html__( 'Offset posts:', 'cityestate' ),				
				'save_always' 	=> true
			),
			
			array(
				'param_name' 	=> 'property_list_style',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Style 1', 'cityestate' ) => '0', esc_html__( 'Style 2', 'cityestate' ) => '1', esc_html__( 'Style 3', 'cityestate' ) => '2' ),
				'heading' 		=> esc_html__( 'Style:', 'cityestate' ),				
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'number_of_item',
				'type' 			=> 'textfield',
				'value' 		=> '6',
				'heading' 		=> esc_html__( 'Number Of Property In One Slide:', 'cityestate' ),				
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'slider_infinite',
				'type' 			=> 'dropdown',
				'value' 		=> array(
										esc_html__( 'Yes', 'cityestate' ) 	=> 'true',
										esc_html__( 'No', 'cityestate' ) 	=> 'false'
									),
				'heading' 		=> esc_html__( 'Infinite Scroll:', 'cityestate' ),				
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'slider_auto',
				'type' 			=> 'dropdown',
				'value' 		=> array(
										esc_html__( 'Yes', 'cityestate' ) 	=> 'carousel',
										esc_html__( 'No', 'cityestate' ) 	=> 'no'
									),
				'heading' 		=> esc_html__( 'Auto Play:', 'cityestate' ),				
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' ),
			),

			array(
				'param_name' 	=> 'slider_auto_speed',
				'type' 			=> 'textfield',
				'value' 		=> '5000',
				'heading' 		=> esc_html__( 'Auto Play Speed:', 'cityestate' ),
				'description' 	=> 'Autoplay Speed in milliseconds. Default 5000',				
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' ),
			),			

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Bordered?', 'cityestate' ),
				'param_name' 	=> 'slider_description_border',
				'value'			=> array(
										esc_html__( 'Yes', 'cityestate' )	=> 'true',
										esc_html__( 'No', 'cityestate' )	=> 'false'
									),
				'description' 	=> esc_html__( 'Want border in property detail section?', 'cityestate' )
			),

		)
	)
);

?>