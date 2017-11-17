<?php

// Cityestate team shortcode
function cityestate_team( $atts, $content = null ){
    
    global $post;

    // Extract team values    
    extract( shortcode_atts( array(
        'posts_limit' => '',        
    ), $atts ) );   

    $output = '';

    // Get team posts
    $args = array( 'post_type' => 'cityestate_agent', 'posts_per_page' => $posts_limit );
    $wp_query = new WP_Query( $args );

    // Check agent is found
    if( $wp_query->have_posts() ):
        
        while( $wp_query->have_posts() ): $wp_query->the_post();
            // Get agent detail            
            $agent_name         = get_the_title();
            $about_agent        = get_post_meta( get_the_ID(), 'about_agent', true );
            $agent_position     = get_post_meta( get_the_ID(), 'agent_position', true );
            $agent_facebook     = get_post_meta( get_the_ID(), 'agent_facebook', true );
            $agent_twitter      = get_post_meta( get_the_ID(), 'agent_twitter', true );
            $agent_linkedin     = get_post_meta( get_the_ID(), 'agent_linkedin', true );
            $agent_googleplus   = get_post_meta( get_the_ID(), 'agent_googleplus', true );
            $agent_youtube      = get_post_meta( get_the_ID(), 'agent_youtube', true );
            $agent_pinterest    = get_post_meta( get_the_ID(), 'agent_instagram', true );
            $agent_instagram    = get_post_meta( get_the_ID(), 'agent_pinterest', true );
            $agent_vimeo        = get_post_meta( get_the_ID(), 'agent_vimeo', true );
            
            $output .=
            '<div class="col-xs-12 col-sm-6 col-md-3">
            	<div class="agent-image">';
        			// Agent photo
                    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "cityestate_image_265_260" );
                    if( !empty($post_thumbnail) ){
                        $output .= '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.esc_attr($agent_name).'" />';
                    } else {
                        $output .= cityestate_image_placeholder('cityestate_image_265_260');
                    }
                    // About agent
                    $agent_content = wp_trim_words( $about_agent, 20, '...' );
                    
                    // Number of agent property
                    $output .= '
        			<div class="agent-hover-detail">
        				<p>'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_content ).'</p>
        			</div>
        		</div>
        		<div class="agent-info">
        			<h3 class="agent-info-name"><a href="'.esc_url(get_the_permalink($post->ID)).'">'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_name ).'</a></h3>
        			<h4 class="agent-info-detail">'.sprintf( esc_html__( '%s', 'cityestate' ), $agent_position ).'</h4>';
                    // Check agent is social media
        			if( !empty($agent_facebook) || !empty($agent_twitter) || !empty($agent_linkedin) || !empty($agent_googleplus) || !empty($agent_pinterest) || !empty($agent_youtube) || !empty($agent_instagram) || !empty($agent_vimeo) ){
        			$output .= '<ul class="agent-social-list">';
                        // Set agent facebook social media
                        if( !empty($agent_facebook) ){
                            $output .= '<li><a href="'.esc_url($agent_facebook).'"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent twitter social media
                        if( !empty($agent_twitter) ){
                            $output .= '<li><a href="'.esc_url($agent_twitter).'"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent linkedin social media
                        if( !empty($agent_linkedin) ){
                            $output .= '<li><a href="'.esc_url($agent_linkedin).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent google plus social media
                        if( !empty($agent_googleplus) ) {
                            $output .= '<li><a href="'.esc_url($agent_googleplus).'"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent pinterest social media
                        if( !empty($agent_pinterest) ){
                            $output .= '<li><a href="'.esc_url($agent_pinterest).'"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent youtube social media
                        if( !empty($agent_youtube) ){
                            $output .= '<li><a href="'.esc_url($agent_youtube).'"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent instagram social media
                        if( !empty($agent_instagram) ){
                            $output .= '<li><a href="'.esc_url($agent_instagram).'"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
                        }
                        // Set agent vimeo social media
                        if( !empty($agent_vimeo) ){
                            $output .= '<li><a href="'.esc_url($agent_vimeo).'"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>';
                        }
                    $output .= '</ul>';
        			}
        		$output .= '</div>
            </div>';
        endwhile;
    endif;        
    return $output;
}

add_shortcode( 'cityestate-team', 'cityestate_team' );

?>