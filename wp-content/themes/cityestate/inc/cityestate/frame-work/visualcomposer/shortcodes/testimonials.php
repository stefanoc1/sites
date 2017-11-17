<?php

vc_map(
	array(
		'name' 			=> esc_html__( 'Testimonials', 'cityestate' ),
		'base' 			=> 'testimonials',
		'description' 	=> esc_html__( 'Show testimonials slides', 'cityestate' ),
		'icon' 			=> 'cityestate-testimonials',
		'category' 		=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),		
		'params' 		=> array(

			array(
				'param_name' 	=> 'posts_limit',
				'type' 			=> 'textfield',
				'value' 		=> '9',
				'heading' 		=> esc_html__( 'Limit:', 'cityestate' ),
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
				'param_name' 	=> 'orderby',
				'type' 			=> 'dropdown',
				'value' 		=> array( 
										esc_html__( 'None', 'cityestate' ) 			=> 'none', 
										esc_html__( 'ID', 'cityestate' ) 			=> 'ID', 
										esc_html__( 'Title', 'cityestate' ) 		=> 'title', 
										esc_html__( 'Date', 'cityestate' ) 			=> 'date', 
										esc_html__( 'Random', 'cityestate' ) 		=> 'rand', 
										esc_html__( 'Menu Order', 'cityestate' ) 	=> 'menu_order' 
									),
				'heading' 		=> esc_html__( 'Order By:', 'cityestate' ),
				'save_always' 	=> true,
			),

			array(
				'param_name' 	=> 'order',
				'type' 			=> 'dropdown',
				'value' 		=> array( 
										esc_html__( 'ASC', 'cityestate' ) 	=> 'ASC', 
										esc_html__( 'DESC', 'cityestate' ) 	=> 'DESC' 
									),
				'heading' 		=> esc_html__( 'Order:', 'cityestate' ),
				'save_always' 	=> true,
			),

			array(
				'param_name' 	=> 'list_style',
				'type' 			=> 'dropdown',
				'value' 		=> array( esc_html__( 'Style 1', 'cityestate' ) => '0', esc_html__( 'Style 2', 'cityestate' ) => '1', esc_html__( 'Style 3', 'cityestate' ) => '2' ),
				'heading' 		=> esc_html__( 'Style:', 'cityestate' ),				
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
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
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
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
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
			),

			array(
				'param_name' 	=> 'slider_auto_speed',
				'type' 			=> 'textfield',
				'value' 		=> '5000',
				'heading' 		=> esc_html__( 'Auto Play Speed:', 'cityestate' ),
				'description' 	=> esc_html__( 'Autoplay Speed in milliseconds. Default 5000', 'cityestate' ),
				'save_always' 	=> true,
				'group' 		=> esc_html__( 'Carousel Settings', 'cityestate' )
			),

		)
	)
);