<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Team', 'cityestate' ),
		'base' 		=> 'cityestate-team',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'icon' 		=> 'icon-team',
		'params' 	=> array(
			
			array(
				'param_name' 	=> 'posts_limit',
				'type' 			=> 'textfield',
				'value' 		=> '6',
				'heading' 		=> esc_html__( 'Limit Agent number:', 'cityestate' ),				
				'save_always' 	=> true,
			),
		)
	)
);

?>