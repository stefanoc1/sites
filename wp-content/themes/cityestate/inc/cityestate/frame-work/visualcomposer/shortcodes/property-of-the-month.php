<?php

// Get property
$property_list  = get_posts( array( 'post_type' => 'property', 'posts_per_page' => -1 ) );
$property       = array();

// Check property is found
if( !empty($property_list) ){
    // Collect property detail
    foreach( $property_list as $key => $value ){
        $property[$value->post_title] = $value->ID;
    }
}

vc_map(
	array(
		'name' 		=> esc_html__( 'Property Of The Month', 'cityestate' ),
		'base' 		=> 'property_of_month',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'class' 	=> '',
		'icon' 		=> 'property-of-month',
		'params' 	=> array(

			array(
				'param_name' 	=> 'property_month',
				'type' 			=> 'dropdown',
				'value' 		=> $property,
				'heading' 		=> esc_html__( 'Select Property Of The Month:', 'cityestate' ),
				'save_always' 	=> true
			),			

			array(
				'param_name' 	=> 'property_label',
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading' 		=> esc_html__( 'Property Label:', 'cityestate' ),
				'description' 	=> esc_html__( 'Enter property label Ex: Property Of The Month', 'cityestate' ),
				'save_always' 	=> true
			),

			array(
				'param_name' 	=> 'property_word_limit',
				'type' 			=> 'textfield',
				'value' 		=> '15',
				'heading' 		=> esc_html__( 'Limit Words:', 'cityestate' ),
				'description' 	=> esc_html__( 'Number of words show in property description area.', 'cityestate' ),
				'save_always' 	=> true,
			),

			array(
				'param_name' 	=> 'property_more_btn',
				'type' 			=> 'textfield',
				'value' 		=> 'Explore More',
				'heading' 		=> esc_html__( 'Explore More Button Text:', 'cityestate' ),				
				'save_always' 	=> true,
			),

			array(
				'param_name' 	=> 'property_more_btn_link',
				'type' 			=> 'textfield',				
				'heading' 		=> esc_html__( 'Explore More Button Link:', 'cityestate' ),
				'description' 	=> esc_html__( 'If you have blank this field then automatically asign current property link.', 'cityestate' ),
				'save_always' 	=> true,
			),				

		)
	)
);

?>