<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Partners', 'cityestate' ),
		'base' 		=> 'partners',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'icon' 		=> 'taxonomy-grid',
		'params' 	=> array(			

			array(
				'param_name' 	=> 'partners_logo',
				'type' 			=> 'attach_images',
				'heading' 		=> esc_html__( 'Partners Logo/Image', 'cityestate' ),				
				'save_always' 	=> true
			),
		)
	)
);

?>