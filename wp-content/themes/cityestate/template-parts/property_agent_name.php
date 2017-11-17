<?php
// Get agent id
$agent_id 	= get_post_meta( get_the_ID(), 'agents', true );
// Get agent name
$agent_name = get_the_title($agent_id);

$output = '';

// Check agent id is available
if( !empty($agent_id) ){
	$output = '<p class="proprerty-owners">'.esc_html__( 'By ', 'cityestate' ).'<a href='.esc_url(get_the_permalink($agent_id)).'><span>'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_name ).'</span></a></p>';
}

return $output; ?>