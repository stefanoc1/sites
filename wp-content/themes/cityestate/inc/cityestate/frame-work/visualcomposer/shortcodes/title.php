<?php

vc_map(
	array(
		'name' 			=> esc_html__( 'Max Title', 'cityestate' ),
		'base' 			=> 'maxtitle',
		'description' 	=> esc_html__( 'MaxTitle', 'cityestate' ),
		'category' 		=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'icon' 			=> 'icon-wpb-maxtitle',
		'params' 		=> array(

			array(
				'heading' 		=> esc_html__( 'Type', 'cityestate' ),
				'description' 	=> esc_html__( 'Title Type', 'cityestate' ),
				'type' 			=> 'dropdown',
				'param_name' 	=> 'type',
				'value' 		=> array(
											esc_html__( 'Maxtitle 1', 'cityestate' ) => '1',
											esc_html__( 'Maxtitle 2', 'cityestate' ) => '2',
											esc_html__( 'Maxtitle 3', 'cityestate' ) => '3',
											esc_html__( 'Maxtitle 4', 'cityestate' ) => '4',
											esc_html__( 'Maxtitle 5', 'cityestate' ) => '5',
											esc_html__( 'Maxtitle 6', 'cityestate' ) => '6',
										),
			),

			array(
				'heading' 		=> esc_html__( 'Heading', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Just for SEO<br>Note: it doesn\'t change the size of the max title in the page.', 'cityestate'), array( 'br' => array() ) ),
				'type' 			=> 'dropdown',
				'param_name' 	=> 'heading',
				'value' 		=> array(
											'h1' => '1',
											'h2' => '2',
											'h3' => '3',
											'h4' => '4',
											'h5' => '5',
											'h6' => '6',
										),
				'std' 			=> '2',
			),

			array(
				'heading' 		=> esc_html__( 'Position', 'cityestate' ),
				'description' 	=> wp_kses( __( 'Position of the title text.', 'cityestate'), array( 'br' => array() ) ),
				'type' 			=> 'dropdown',
				'param_name' 	=> 'position',
				'value' 		=> array(
										esc_html__( 'Left', 'cityestate' ) 		=>  'left',
										esc_html__( 'Center', 'cityestate' ) 	=> 'center',
										esc_html__( 'Right', 'cityestate' ) 	=> 'right',
									),
			),

			array(
				'heading' 		=> esc_html__( 'Title', 'cityestate' ),
				'description' 	=> esc_html__( 'Enter the title', 'cityestate'),
				'type' 			=> 'textfield',
				'param_name' 	=> 'maxtitle_content',
			),

			array(
				'heading'		=> esc_html__( 'Title Text Color', 'cityestate' ),
				'type'			=> 'colorpicker',
				'param_name'	=> 'maxtitle_color',				
			),
			
		),
	) 
);

?>