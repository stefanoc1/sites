<?php

// Cityestate main agent shortcode
function cityestate_main_agent( $atts, $content = null ){
    // Extract main agent values
	extract( shortcode_atts( array(
		'agent_photo'						=> '',
		'agent_name'						=> '',
		'agent_certified'					=> '',
		'agent_social_lbl'					=> '',
		'agent_social_facebook' 			=> '',
        'agent_social_twitter' 				=> '',
        'agent_social_linkedin' 			=> '',
        'agent_social_pinterest' 			=> '',
        'agent_social_googleplus' 			=> '',
        'agent_social_facebook_target' 		=> '',
        'agent_social_twitter_target' 		=> '',
        'agent_social_linkedin_target' 		=> '',
        'agent_social_pinterest_target' 	=> '',
        'agent_social_googleplus_target' 	=> ''
	), $atts ) );

    // Get the agent photo using media id
	if( is_numeric($agent_photo) ){
        $agent_photo_src = wp_get_attachment_url( $agent_photo );
    } else {
        $agent_photo_src = $agent_photo;
    }

	$output = '
	<div class="main-agent-info">
		<div class="container">
			<img src="'.esc_url($agent_photo_src).'" alt="'.esc_attr($agent_name).'" />
			<div class="main-agent-ifno-detail">
				<h3>'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_name ).'</h3><br/>
				<h4>'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_certified ).'</h4>
			</div>';
			// Show agent social media
            if( !empty($agent_social_facebook) || !empty($agent_social_twitter) || !empty($agent_social_linkedin) || !empty($agent_social_pinterest) || !empty($agent_social_googleplus) ){
			$output .= '<ul class="agent-social-list pull-right">
				<li>
					'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_social_lbl ).'
				</li>';
                
                // Facebook social media
                if( !empty($agent_social_facebook) ){
                    $output .= '<li><a target="'.esc_attr($agent_social_facebook_target).'" href="'.esc_url($agent_social_facebook).'"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>';
                }
                // Twitter social media
                if( !empty($agent_social_twitter) ){
                    $output .= '<li><a target="'.esc_attr($agent_social_twitter_target).'" href="'.esc_url($agent_social_twitter).'"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                }
                // Linkedin social media
                if( !empty($agent_social_linkedin) ){
                    $output .= '<li><a target="'.esc_attr($agent_social_linkedin_target).'" href="'.esc_url($agent_social_linkedin).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
                }
                // Pinterest social media
                if( !empty($agent_social_pinterest) ){
                    $output .= '<li><a target="'.esc_attr($agent_social_pinterest_target).'" href="'.esc_url($agent_social_pinterest).'"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
                }
                // Google plus social media
                if( !empty($agent_social_googleplus) ) {
                    $output .= '<li><a target="'.esc_attr($agent_social_googleplus_target).'" href="'.esc_url($agent_social_googleplus).'"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
                }
            $output .= '</ul>';
           }
        $output .= '
		</div>
	</div>';

	return $output;
}
add_shortcode( 'main_agent','cityestate_main_agent' );

?>