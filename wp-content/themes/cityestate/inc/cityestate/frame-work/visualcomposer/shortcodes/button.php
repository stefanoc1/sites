<?php

vc_map( 
	array(
	'name' 			=> 'Cityestate Button',
	'base' 			=> 'button',
	'description' 	=> 'Button shortcode',
	'category' 		=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
	'icon' 			=> 'cityestate_button',
	'params' 		=> array(

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Shape', 'cityestate' ),
				'param_name' 	=> 'shape',
				'value' 		=> array(
										esc_html__( 'Default', 'cityestate' )	=> '',
										esc_html__( 'Square', 'cityestate' )	=> 'square',
										esc_html__( 'Rounded', 'cityestate' ) 	=> 'rounded',
									),
				'description' => esc_html__( 'Button Type', 'cityestate' )
			),
			
			array(
				'type' 			=> 'textarea',
				'heading' 		=> esc_html__( 'Content', 'cityestate' ),
				'param_name' 	=> 'btn_content',
				'value'			=> '',
				'description' 	=> esc_html__( 'Button Text Content', 'cityestate' )
			),
			
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'URL', 'cityestate' ),
				'param_name' 	=> 'url',
				'value'			=> '#',
				'description' 	=> esc_html__( 'Button URL Link', 'cityestate' )
			),
									
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Target', 'cityestate' ),
				'param_name' 	=> 'target',
				'description' 	=> esc_html__( 'Button URL Target', 'cityestate' ),
				'value' 		=> array(
										esc_html__( 'Self', 'cityestate' )		=>'_self',
										esc_html__( 'Blank', 'cityestate' )		=>'_blank',
										esc_html__( 'Parent', 'cityestate' )	=>'_parent',
										esc_html__( 'Top', 'cityestate' )		=>'_top',
									),
			),
			
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Color', 'cityestate' ),
				'param_name' 	=> 'color',
				'description' 	=> esc_html__( 'Button Color', 'cityestate'),
				'value' 		=> array(
										esc_html__( 'Default', 'cityestate' )	=> 'theme-skin',
										esc_html__( 'Green', 'cityestate' )		=> 'green',
										esc_html__( 'Gold', 'cityestate' )		=> 'gold',
										esc_html__( 'Red', 'cityestate' )		=> 'red',
										esc_html__( 'Blue', 'cityestate' )		=> 'blue',
										esc_html__( 'Gray', 'cityestate' )		=> 'gray',
										esc_html__( 'Dark gray', 'cityestate' )	=> 'dark-gray',
										esc_html__( 'Cherry', 'cityestate' )	=> 'cherry',
										esc_html__( 'Orchid', 'cityestate' )	=> 'orchid',
										esc_html__( 'Pink', 'cityestate' )		=> 'pink',
										esc_html__( 'Orange', 'cityestate' )	=> 'orange',
										esc_html__( 'Teal', 'cityestate' )		=> 'teal',
										esc_html__( 'SkyBlue', 'cityestate' )	=> 'skyblue',
										esc_html__( 'Jade', 'cityestate' )		=> 'jade',
										esc_html__( 'White', 'cityestate' )		=> 'white',
										esc_html__( 'Black', 'cityestate' )		=> 'black',
									),
			),
									
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Size', 'cityestate' ),
				'param_name' 	=> 'size',
				'description' 	=> esc_html__( 'Button Size', 'cityestate' ),
				'value' 		=> array(
										esc_html__( 'Small', 'cityestate' )		=> 'small',
										esc_html__( 'Medium', 'cityestate' )	=> 'medium',
										esc_html__( 'Large', 'cityestate' )		=> 'large',	
									),
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Bordered?', 'cityestate' ),
				'param_name' 	=> 'border',
				'value'			=> array(
										esc_html__( 'Normal', 'cityestate' )	=> 'false',
										esc_html__( 'Bordered', 'cityestate' )	=> 'true'
									),
				'description' 	=> esc_html__( 'Is button bordered?', 'cityestate' )
			),
			
			array(
				'type' 			=> 'iconfonts',
				'heading' 		=> esc_html__( 'Icon', 'cityestate' ),
				'param_name' 	=> 'icon',
				'value'			=> '',
				'description' 	=> esc_html__( 'Select Button Icon', 'cityestate' )
			),

		),
	)
);

?>