<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Cityestate Tab', 'cityestate' ),
		'base' 		=> 'cityestate_tab',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'cityestate_tab',
		'params' 	=> array(
			
			array(
				'heading'		=> esc_html__( 'Tab', 'cityestate' ),
				'type'			=> 'param_group',
				'param_name'	=> 'tabs',
				'params' 		=> array(

					array(
						'heading' 		=> esc_html__( 'Tab Name', 'cityestate' ),
						'param_name' 	=> 'tab_name',
						'type' 			=> 'textfield',
						'save_always' 	=> true
					),

					array(
						'heading' 		=> esc_html__( 'Tab Image', 'cityestate' ),			
						'param_name' 	=> 'tab_image',
						'type' 			=> 'attach_image',
						'save_always' 	=> true
					),

					array(
						'heading'		=> esc_html__( 'Dimension Label', 'cityestate' ),
						'type'			=> 'textfield',
						'param_name'	=> 'dimension_label',
						'admin_label'	=> true,
					),

					array(
						'heading'		=> esc_html__( 'Dimension Size', 'cityestate' ),
						'type'			=> 'textfield',
						'param_name'	=> 'dimension_size',
						'admin_label'	=> true,
					),

					array(
						'heading' 		=> esc_html__( 'Tab Title', 'cityestate' ),
						'param_name' 	=> 'tab_title',
						'type' 			=> 'textfield',
						'save_always' 	=> true
					),

					array(
						'heading'		=> esc_html__( 'Tab Description', 'cityestate' ),
						'type'			=> 'textarea',
						'param_name'	=> 'tab_desc',
						'admin_label'	=> true,
					),					
				),
			),				
		)
	)
);

?>