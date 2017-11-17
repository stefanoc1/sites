<?php

// Cityestate agent info box shortcode
function cityestate_agent_info( $atts, $content = null ){
	// Extract agent info values
	extract( shortcode_atts( array(
		'agent_photo'				=> '',
		'agent_name'				=> '',
		'agent_certified'			=> '',
		'agent_phone_number'		=> '',
		'agent_email_id'			=> '',
		'agent_contact_title'		=> '',
		'agent_contact_shortcode'	=> '',
	), $atts ) );

	// Check agent photo id is number
	if( is_numeric($agent_photo) ){
		$agent_photo = wp_get_attachment_url($agent_photo);
	}

	$output = '
	<div class="single-agent-contact-form">
		<div class="container">
			<div class="row">
				<dev class="col-xs-12 sol-sm-3 col-md-3">
					<img src="'.esc_url($agent_photo).'" alt="Agent">
				</dev>
				<dev class="col-xs-12 sol-sm-9 col-md-9">
					<h3>'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_name ).' </h3> <span class="certification">'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_certified ).'</span>
					<p class="cotnact-detail">
						<img src="'.get_template_directory_uri().'/images/phone-calls-white.png" alt="Phone Calls">
						<a href="tel:'.$agent_phone_number.'">'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_phone_number ).'</a>
						<img src="'.get_template_directory_uri().'/images/message-white.png" alt="Message">
						<a href="mailto:'.$agent_email_id.'">'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_email_id ).'</a>
					</p>
					<h4>'.$agent_contact_title.'</h4>
					'.do_shortcode('[contact-form-7 id="'.$agent_contact_shortcode.'" title="Cityestate"]').'
				</dev>
			</div>
		</div>		
	</div>';
	return $output;
}
add_shortcode( 'agent_info','cityestate_agent_info' );

?>