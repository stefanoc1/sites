<?php

$cf7 = get_posts( "post_type='wpcf7_contact_form'&numberposts=-1" );
$contact_forms = array();

if( $cf7 ){
	foreach( $cf7 as $cform ){
		$contact_forms[ $cform->post_title ] = $cform->ID;
	}
} else {
	$contact_forms[ esc_html__( 'No contact forms found', 'cityestate' ) ] = 0;
}

vc_map(
	array(
		'name' 		=> esc_html__( 'Agent Info', 'cityestate' ),
		'base' 		=> 'agent_info',
		'category' 	=> esc_html__( 'CityEstate Shortcodes', 'cityestate' ),
		'icon' 		=> 'agent_info',
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
				'heading' 		=> esc_html__( 'Phone Number', 'cityestate' ),
				'param_name' 	=> 'agent_phone_number',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Enter the Agent Phone Number', 'cityestate' )
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Email ID', 'cityestate' ),
				'param_name' 	=> 'agent_email_id',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Enter the Agent Email ID', 'cityestate' )
			),

			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Contact Form Title', 'cityestate' ),
				'param_name' 	=> 'agent_contact_title',
				'value' 		=> '',
				'description' 	=> esc_html__( 'Enter the Agent Contact Form Title', 'cityestate' )
			),

			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Select contact form', 'cityestate' ),
				'param_name' 	=> 'agent_contact_shortcode',
				'value' 		=> $contact_forms,
				'save_always' 	=> true,
				'description' 	=> esc_html__( 'Choose previously created contact form from the drop down list.', 'cityestate' ),
			),
			
		)
	)
);


?>