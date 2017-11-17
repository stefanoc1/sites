<?php

vc_map(
	array(
		'name' 		=> esc_html__( 'Main Agent', 'cityestate' ),
		'base' 		=> 'main_agent',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'icon' 		=> 'main_agent',
		'params' 	=> array(
			
			array(
			   'type' 			=> 'attach_image',
			   'heading' 		=> esc_html__( 'Agent Photo', 'cityestate' ),
			   'param_name' 	=> 'agent_photo',
			   'description' 	=> esc_html__( 'Select the agent photo', 'cityestate' )
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Name', 'cityestate' ),
				'param_name' 	=> 'agent_name',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Enter the Agent name', 'cityestate')
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Certified', 'cityestate' ),
				'param_name' 	=> 'agent_certified',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Enter the Agent certified info', 'cityestate' )
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Social Media Label', 'cityestate' ),
				'param_name' 	=> 'agent_social_lbl',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Enter the Social Media Label', 'cityestate' )
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Facebook Profile Link', 'cityestate' ),
				'param_name' 	=> 'agent_social_facebook',
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Facebook Target', 'cityestate' ),
				'param_name' 	=> 'agent_social_facebook_target',
				'value' 		=> array(
										esc_html__( 'Self', 'cityestate' )		=> '_self',
										esc_html__( 'Blank', 'cityestate' )	 	=> '_blank',
										esc_html__( 'Parent', 'cityestate' )	=> '_parent'
									),
				'description' => '',
				'save_always' => true
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Twitter Profile Link', 'cityestate' ),
				'param_name' 	=> 'agent_social_twitter',
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Twitter Target', 'cityestate' ),
				'param_name' 	=> 'agent_social_twitter_target',
				'value' 		=> array(
										esc_html__( 'Self', 'cityestate' )		=> '_self',
										esc_html__( 'Blank', 'cityestate' )	 	=> '_blank',
										esc_html__( 'Parent', 'cityestate' )	=> '_parent'
									),
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'LinkedIn Profile Link', 'cityestate' ),
				'param_name' 	=> 'agent_social_linkedin',
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'LinkedIn Target', 'cityestate' ),
				'param_name' 	=> 'agent_social_linkedin_target',
				'value' 		=> array(
										esc_html__( 'Self', 'cityestate' )		=> '_self',
										esc_html__( 'Blank', 'cityestate' )	 	=> '_blank',
										esc_html__( 'Parent', 'cityestate' )	=> '_parent'
									),
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Pinterest Profile Link', 'cityestate' ),
				'param_name' 	=> 'agent_social_pinterest',
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Pinerest Target', 'cityestate' ),
				'param_name' 	=> 'agent_social_pinterest_target',
				'value' 		=> array(
										esc_html__( 'Self', 'cityestate' )		=> '_self',
										esc_html__( 'Blank', 'cityestate' )	 	=> '_blank',
										esc_html__( 'Parent', 'cityestate' )	=> '_parent'
									),				
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Google Plus Profile Link', 'cityestate' ),
				'param_name' 	=> 'agent_social_googleplus',
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Google Plus Target', 'cityestate' ),
				'param_name' 	=> 'agent_social_googleplus_target',
				'value' 		=> array(
										esc_html__( 'Self', 'cityestate' )		=> '_self',
										esc_html__( 'Blank', 'cityestate' )	 	=> '_blank',
										esc_html__( 'Parent', 'cityestate' )	=> '_parent'
									),
				'save_always' 	=> true
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Margin Top', 'cityestate' ),
				'param_name' 	=> 'agent_margin_top',
				'save_always' 	=> true
			),			
		)
	)
);


?>