<?php

vc_map( 
	array(
        'name' 			=> esc_html__( 'Icon Box', 'cityestate' ),
        'base' 			=> 'iconbox',
        'description' 	=> esc_html__( 'Icon + text article', 'cityestate' ),
		'icon' 			=> 'cityestate_iconbox',
        'category' 		=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
        'params' 		=> array(

            array(
                'type' 			=> 'dropdown',
                'heading' 		=> esc_html__( 'Type', 'cityestate' ),
                'param_name' 	=> 'type',
                'value' 		=> array(
											esc_html__( 'Type 1', 'cityestate' ) => '0',
											esc_html__( 'Type 2', 'cityestate' ) => '1',
											esc_html__( 'Type 3', 'cityestate' ) => '2'
										),
                'description' 	=> esc_html__( 'You can choose among these pre-designed types.', 'cityestate' )
            ),

            array(
				'type'			=> 'textarea',
				'heading'		=> esc_html__( 'Title', 'cityestate' ),
				'param_name'	=> 'icon_title',
				'value'			=> '',
				'description' 	=> esc_html__( 'IconBox Title', 'cityestate' )
			),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> esc_html__( 'Title color (leave bank for default color)', 'cityestate' ),
				'param_name'	=> 'title_color',
				'value'			=> '',
				'description' 	=> esc_html__( 'Select title color', 'cityestate' )
			),
			
            array(
				'type'			=> 'textarea',
				'heading'		=> esc_html__( 'Content', 'cityestate' ),
				'param_name'	=> 'iconbox_content',
				'value'			=> '',
				'description' 	=> esc_html__( 'IconBox Content Goes Here', 'cityestate' )	
			),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> esc_html__( 'Content color (leave bank for default color)', 'cityestate' ),
				'param_name'	=> 'content_color',
				'value'			=> '',
				'description' 	=> esc_html__( 'Select content color', 'cityestate' )
			),
			
            array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Icon Size (leave blank for default size)', 'cityestate' ),
				'param_name'	=> 'icon_size',
				'value'			=> '',
				'description' 	=> esc_html__( 'Icon size in px format, Example: 16px', 'cityestate' )				
			),

			array(
				'type'			=> 'colorpicker',
				'heading'		=> esc_html__( 'Icon color (leave bank for default color)', 'cityestate' ),
				'param_name'	=> 'icon_color',
				'value'			=> '',
				'description' 	=> esc_html__( 'Select icon color', 'cityestate' )				
			),

            array(
                'type' 			=> 'attach_image',
                'heading' 		=> esc_html__( 'Image', 'cityestate' ),
                'param_name' 	=> 'icon_image',
                'value'			=> '',
                'description' 	=> wp_kses( __( 'Select Image instead of Icons.<br>Note: If you have another Icon that not is here. You can put PNG image of that instead of these Icons.', 'cityestate' ), array( 'br' => array() ) )
            ),
			
            array(
                'type' 			=> 'iconfonts',
                'heading' 		=> esc_html__( 'Icon', 'cityestate' ),
                'param_name' 	=> 'icon_name',
                'value'			=> '',
                'description' 	=> esc_html__( 'Select Icon', 'cityestate' )
            ),
           
        ),
    ) 
);


?>