<?php

// Cityestate bloxdark row shortcode
function cityestate_bloxdark_shortcode( $atts, $content = null ){
	// Extract bloxdark row values
    extract( shortcode_atts( array(
        'img' 				=> '',
        'height' 			=> '',
        'padding_top'  		=> 0,
        'padding_bottom'  	=> 0,
		'bg_attachment' 	=> 'false',
		'bg_position' 		=> 'center center',
		'bgcover'			=> 'true',
		'repeat'			=> 'no-repeat',
		'dark'				=> 'false',
		'class'				=> '',
		'bgcolor'			=> '',
		'row_color'			=> '',				
		'id'				=> ''
    ), $atts ) );			
		
	// Get image link or url of image
	if( is_numeric($img) ){
		$img = wp_get_attachment_url( $img );		
	}
	
	// Collect and set the background image style
	$fixed = ($bg_attachment == 'true')? 'fixed' : '';
	$background_style = !empty($img) ?" background: url('{$img}') {$repeat} {$fixed}; background-position: {$bg_position}":'';
	$background_size = ($bgcover=='true') ? 'background-size: cover;':'';
	
	// Set height of row
	$fc_height = ltrim($height);
	if( substr($fc_height,-2,2) == "px" )
		$height_style = " min-height:{$fc_height}; ";
	else
		$height_style = " min-height:{$fc_height}px; ";
	
	// Set top padding of row
	$padding_top = ltrim($padding_top);
	$padding_top = (substr($padding_top,-2,2) == "px") ? $padding_top : $padding_top.'px';

	// Set bottom padding of row
	$padding_bottom = ltrim($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2) == "px") ? $padding_bottom : $padding_bottom.'px';
	
	// Set padding of row
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	
	// Set background color of row
	if( !empty($bgcolor) )
		$bgcolor = 'background-color:' . $bgcolor . ';';
    
	// Set row dark or normal
	$is_dark = ( 'true' == $dark )? ' dark ' : '';
	
	// Set row id if is available
	if( !empty($id) )
   		$output = '</div></section><section id="'.$id.'" class="blox dark '.$is_dark.$class .'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay"></div><div class="fc_row vc_row-fluid full-row"><div class="container">';
	else
		$output = '</div></section><section class="blox dark '.$is_dark.$class .'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay"></div><div class="fc_row vc_row-fluid full-row"><div class="container">';

    // Run row shortcode
    $output .= do_shortcode($content); 
    $output .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
    return $output;
}
add_shortcode( 'bloxdark', 'cityestate_bloxdark_shortcode' );

// Cityestate blox row shortcode
function cityestate_blox_shortcode( $atts, $content = null ){
	// Extract blox row values
    extract( shortcode_atts( array(
        'img' 				=> '',
        'height' 			=> '',
        'padding_top'  		=> 0,
        'padding_bottom'  	=> 0,
		'bg_attachment' 	=> 'false',
		'bg_position' 		=> 'center center',
		'bgcover'			=> 'true',
		'repeat'			=> 'no-repeat',
		'dark'				=> 'false',
		'class'				=> '',
		'bgcolor'			=> '',						
		'row_color'			=> '',
		'id'				=> ''
    ), $atts ) );
	
	// Get row image
	if( is_numeric($img) ){
		$img = wp_get_attachment_url( $img );
	}   
	
	// Set row background image
	$fixed = ($bg_attachment == 'true') ? 'fixed' : '';
	$background_style = !empty($img) ?" background: url('{$img}') {$repeat} {$fixed}; background-position: {$bg_position};":'';
	$background_size = 	($bgcover == 'true') ? 'background-size: cover;':'';
	
	// Set height of row
	$fc_height = ltrim($height);
	if( substr($fc_height,-2,2) == "px" )
		$height_style = " min-height:{$fc_height}; ";
	else
		$height_style = " min-height:{$fc_height}px; ";
	
	// Set top padding of row
	$padding_top = ltrim($padding_top);
	$padding_top = (substr($padding_top,-2,2) == "px") ? $padding_top : $padding_top.'px';

	// Set bottom padding of row
	$padding_bottom = ltrim($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2) == "px") ? $padding_bottom : $padding_bottom.'px';
	
	// Set padding of row
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	
	// Set background color of row
	if( !empty($bgcolor) )
		$bgcolor = ' background-color:' . $bgcolor . ';';
    // Set row background dark or normal
	$is_dark = ( 'true' == $dark )? ' dark ' : '';
	
	// Set row background color
	$color_overlay = "";
	if( !empty($row_color) ){
		$color_overlay = 'background-color:' . cityestate_hex2rgba($row_color, 0.5);
	}

	// Set row id
	if( !empty($id) )
    	$output = '</div></section><section id="'.$id.'" class="blox '.$is_dark.$class.'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay" style="'.  $color_overlay .'"></div><div class="fc_row vc_row-fluid full-row"><div class="container">';
	else
    	$output = '</div></section><section class="blox '.$is_dark.$class.'" style="'.$padding_style.$background_style.$background_size.$height_style.$bgcolor.'"><div class="max-overlay" style="'.  $color_overlay .'"></div><div class="fc_row vc_row-fluid full-row"><div class="container">';
    
    // Run row shortcode
    $output .= do_shortcode($content); 
    $output .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
    return $output;
}
add_shortcode( 'blox', 'cityestate_blox_shortcode' );

// Cityestate parallax row shortcode
function cityestate_parallax( $atts, $content = null ){
	// Extract parallax row values
	extract( shortcode_atts( array(
		'img' 				=> '',
		'height' 			=> '',
		'padding_top' 		=> 0,
		'padding_bottom' 	=> 0,
		'bg_attachment' 	=> 'false',
		'bgcover' 			=> 'true',
		'repeat' 			=> 'no-repeat',
		'dark' 				=> 'false',
		'speed'				=> '6',
		'class' 			=> '',
		'bgcolor'			=> '',
		'row_pattern'		=> '',
		'row_color'			=> '',
		'id'				=> ''
	), $atts ) );

	// Get image of parallax row
	if( is_numeric($img) ){
		$img = wp_get_attachment_url( $img );
	}

	// Set background image style
	$fixed = ($bg_attachment == 'true') ? 'fixed center top':'center';
	$background_style = !empty($img) ?" background: url('{$img}') {$repeat} {$fixed}; ":'';
	$background_size = 	($bgcover=='true') ? 'background-size: cover;':'';

	// Set height of row
	$w_height = ltrim($height);
	if( substr($w_height,-2,2) == "px" )
		$height_style = " min-height:{$w_height}; ";
	else
		$height_style = " min-height:{$w_height}px; ";

	// Set padding of row
	$padding_top = ltrim($padding_top);
	$padding_top = (substr($padding_top,-2,2) == "px") ? $padding_top : $padding_top.'px';
	$padding_bottom = ltrim($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2) == "px") ? $padding_bottom : $padding_bottom.'px';
	$padding_style = " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	
	// Set background color of row
	if( !empty($bgcolor) )
		$bgcolor = ' background-color:' . $bgcolor . ';';

	// Set row color like dark or normal
	$is_dark 	= ('true' == $dark) ? ' dark ' : '';
	
	// Set the row id if is exit
	$section_id = ( !empty($id) ) ? 'id="'.$id.'"' : '';
	
	// Set background overlay color with opacity
	if( !empty($row_color) ){
		$color_overlay = 'background-color:' . cityestate_hex2rgba($row_color, 0.5);
	}
	
	// Set page parallax speed
	$speed = ($speed > 1) ? $speed/10 : $speed;

	$output = '</div></section><section '.$section_id.' class="parallax-sec '.$is_dark.' blox ' . $class .' '.$row_pattern . '" style="' . $padding_style . $background_style . $bgcolor . $background_size . $height_style . '" data-stellar-background-ratio="'.$speed. '"><div class="max-overlay" style="'.  $color_overlay .'"></div><div data-stellar-ratio="1" class="fc_row vc_row-fluid "><div class="container">';
	// Run the parallax row code
	$output .= do_shortcode($content);
	$output .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
	return $output;
}
add_shortcode( 'parallax', 'cityestate_parallax' );

// Cityestate video row shortcode
function cityestate_videorow_shortcode( $atts, $content = null ){
    // Extract video row values
	extract( shortcode_atts( array(
        'img' 				=> '',
        'height' 			=> '',
        'padding_top'  		=> 0,
        'padding_bottom'  	=> 0,
		'dark'				=>'false',
		'class'				=>'',
		'video_pattern'		=>'true',
		'id'				=>'',
		'video_src'			=>'host',
		'video_sharing_url'	=>'',
		'mp4_format'		=>'',
		'webm_format'		=>'',
		'ogg_format'		=>'',
		'img_preview_video'	=>'',
	), $atts ) );

	// Get background image
	if( is_numeric( $img_preview_video ) ){ 
		$img_preview_video = wp_get_attachment_url( $img_preview_video );
	}

	// Set height of video row
	$height_style = ($height) ? ' min-height: ' . $height . 'px !important; ' : 'min-height: 380px;' ;
	// Set padding of video row
	$padding_style = " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";	
	// Set row id
	$id = ($id) ? 'id="' . $id . '"' : '' ;	
	// Set row background pattern
	$spattern = ( $video_pattern == 'true' ) ? 'class="spattern"' : '' ;
	
	// Set outer element of video row
	$output = '</div></section><section ' . $id . ' class="video-sec ' . $class . '" style="' . $padding_style . $height_style . '">';
	$output .= '<div class="fc_row vc_row-fluid full-row">';
	$output .= '<div ' . $spattern . '>';

	// Video host by self
	if ( $video_src == 'host' ) :
		// Set video class
		$default_screen_video = 'class="video-item" ';
		// Set values in video tag
		$output .= '<video autoplay loop muted preload="auto" ' . $default_screen_video . '>';
		// Set video fotmat
		$output .= ! empty( $mp4_format ) ? '<source src="' . $mp4_format . '" type="video/mp4">' : '';
		$output .= ! empty( $webm_format ) ? '<source src="' . $webm_format . '" type="video/webm">' : '';
		$output .= ! empty( $ogg_format ) ? '<source src="' . $ogg_format . '" type="video/ogg">' : '';
		$output .= esc_html__('Your browser does not support the video tag. I suggest you upgrade your browser.','cityestate');
		$output .= '</video><div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-position: 50% 50%; background-repeat: no-repeat; background-size: auto 100%; background: transparent url(' . $img_preview_video . ') 50% 50% / cover no-repeat ;"></div>';
	elseif ( $video_src == 'video_sharing' ) :
		// For youtube video
		$output .= '<div class="youtube-wrap"><div class="yt-player" id="' . $video_sharing_url . '"></div></div>';
		$output .= '<div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; background-position: 50% 50%; background-repeat: no-repeat; background-size: auto 100%; background: transparent url(' . $img_preview_video . ') 50% 50% / cover no-repeat ;"></div>';
		wp_enqueue_script('youtube-api');
	endif;

	// Video row background is dark or normal
	$dark = ( $dark == 'true' ) ? ' dark ' : '';
    // Set inner or outer elements of video row
    $output .= '<article class="slides-content ' . $dark . '">';
    $output .= '<div class="container">';	
    // Run video row shortcode
    $output .= do_shortcode($content);
    $output .= '</div></article>'; 
    $output .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	
    return $output;
}
add_shortcode( 'videorow', 'cityestate_videorow_shortcode' );

// Cityestate max slider shortcode
function  cityestate_maxslider_shortcode( $atts, $content = null ){
    // Extract max slider values
    extract( shortcode_atts( array(  
		'slide1_img_url'		=> '',
		'slide2_img_url'		=> '',
		'slide3_img_url'		=> '',
		'slide4_img_url'		=> '',
		'slide5_img_url'		=> '',
		'slide_img_pattern'		=> 'true',
		'slide_img_parallax'	=> 'true',
		'id'					=> ''
	), $atts ) );			
   
	// Get the max slider images
	if( is_numeric($slide1_img_url) )
		$slide1_img_url = wp_get_attachment_url( $slide1_img_url );

	// Get the max slider images
	if( is_numeric($slide2_img_url) )
		$slide2_img_url = wp_get_attachment_url( $slide2_img_url );

	// Get the max slider images
	if( is_numeric($slide3_img_url) )
		$slide3_img_url = wp_get_attachment_url( $slide3_img_url );

	// Get the max slider images
	if( is_numeric($slide4_img_url) )
		$slide4_img_url = wp_get_attachment_url( $slide4_img_url );
	
	// Get the max slider images
	if( is_numeric($slide5_img_url) )
		$slide5_img_url = wp_get_attachment_url( $slide5_img_url );
	
    // Set id of max slider if is available
    if( !empty($id) )
    	$output = '</div></section><section id="'.$id.'" class="max-hero maxslider">';
    else  
    	$output = '</div></section><section class="max-hero maxslider">';

    // Set outer element of max slider
    $output .= '<div class="slides-control"><div class="slides-container';
    
    // Mas slider with pattern or without pattern
    if( 'true' == $slide_img_pattern )
		$output .= ' spattern ';

    if( 'true' == $slide_img_parallax )
		$output .= ' sparallax';

    $output .= '">';
    
    // Check image max slider image is available
    if( !empty($slide1_img_url) )
    	$output .= '<div class="slide1 slide-image" style="background-image: url(\''.$slide1_img_url.'\')"></div>';
    
    // Check image max slider image is available
    if( !empty($slide2_img_url) )
    	$output .= '<div class="slide2 slide-image" style="background-image: url(\''.$slide2_img_url.'\')"></div>';
    
    // Check image max slider image is available
    if( !empty($slide3_img_url) )
    	$output .= '<div class="slide3 slide-image" style="background-image: url(\''.$slide3_img_url.'\')"></div>';
    
    // Check image max slider image is available
    if( !empty($slide4_img_url) )
    	$output .= '<div class="slide4 slide-image" style="background-image: url(\''.$slide4_img_url.'\')"></div>'; 
    
    // Check image max slider image is available
    if( !empty($slide5_img_url) )
    	$output .= '<div class="slide5 slide-image" style="background-image: url(\''.$slide5_img_url.'\')"></div>';        

    // Set max slider navigation
    $output .= '</div></div>'; 
    $output .= '<nav class="slides-navigation"><a href="#" class="next"></a><a href="#" class="prev"></a></nav>';
    $output .= '<div class="slides-content"><div class="container">';
    // Run shortcode of max slider
    $output .= do_shortcode($content);    
    $output .= '</div></div></section>'; 
    $output .= '<section class="container"><div class="row-wrapper-x">';
	
    return $output;
}
add_shortcode( 'maxslider', 'cityestate_maxslider_shortcode' );

// Cityestate Convert hexdec color string to rgb(a) string
function cityestate_hex2rgba( $color, $opacity = false ){

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
	    return $default; 

	//Sanitize $color if "#" is provided 
    if( $color[0] == '#' ){
    	$color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if( strlen($color) == 6 ){
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } else if( strlen( $color ) == 3 ){
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
            return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if( $opacity ){
    	if( abs($opacity) > 1 )
    		$opacity = 1.0;
    	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
    	$output = 'rgb('.implode(",",$rgb).')';
    }

	//Return rgb(a) color string
	return $output;
}