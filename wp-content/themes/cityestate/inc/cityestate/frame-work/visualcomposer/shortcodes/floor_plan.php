<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Floor Plan', 'cityestate' ),
		'base' 		=> 'floor_plan',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'floor_plan',
		'params' 	=> array(
			
			array(
				'heading'		=> esc_html__( 'Floor Plan', 'cityestate' ),
				'type'			=> 'param_group',
				'param_name'	=> 'floor_plans',
				'params' 		=> array(

					array(
						'heading' 		=> esc_html__( 'Floor Name', 'cityestate' ),
						'param_name' 	=> 'floor_name',
						'type' 			=> 'textfield',
						'save_always' 	=> true
					),

					array(
						'heading' 		=> esc_html__( 'Floor Image', 'cityestate' ),				
						'param_name' 	=> 'floor_image',
						'type' 			=> 'attach_image',						
						'save_always' 	=> true
					),

					array(
						'heading'		=> esc_html__( 'Floor Attributes', 'cityestate' ),
						'type'			=> 'textarea',
						'param_name'	=> 'floor_attributes',
						'admin_label'	=> true,
					),

					array(
						'heading'		=> esc_html__( 'Floor Description', 'cityestate' ),
						'type'			=> 'textarea',
						'param_name'	=> 'floor_desc',
						'admin_label'	=> true,
					),

					array(
						'heading' 		=> esc_html__( 'Floor Price', 'cityestate' ),
						'param_name' 	=> 'floor_price',
						'type' 			=> 'textfield',						
						'save_always' 	=> true
					),
				),
			),				
		)
	)
);

?>