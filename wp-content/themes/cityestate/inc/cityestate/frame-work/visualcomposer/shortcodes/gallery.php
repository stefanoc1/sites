<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Gallery', 'cityestate' ),
		'base' 		=> 'gallery',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'gallery',
		'params' 	=> array(
			
			array(
				'heading'		=> esc_html__( 'Gallery Images', 'cityestate' ),
				'type'			=> 'param_group',
				'param_name'	=> 'gallery_images',
				'params' 		=> array(
					
					array(
						'heading' 		=> esc_html__( 'Gallery Image', 'cityestate' ),			
						'param_name' 	=> 'gallery_image',
						'type' 			=> 'attach_image',
						'save_always' 	=> true
					),

					array(
						'heading'		=> esc_html__( 'Image Caption', 'cityestate' ),
						'type'			=> 'textfield',
						'param_name'	=> 'image_caption',
						'admin_label'	=> true,
					),
				),
			),
		)
	)
);

?>