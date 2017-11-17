<?php
$output = $el_class = '';

extract( shortcode_atts( array(
    'el_class' 				=> '',
    'row_type'				=> 0,
    'animate'				=> 'fc-animate',
    'row_id'				=> '',
    'blox_image'			=> '',
    'blox_height'			=> '',
	'blox_bg_attachment'	=> 'false',
	'blox_bg_position'		=>  'center center',
    'blox_cover'			=> 'true',
    'blox_repeat'			=> 'no-repeat',	
	'align_center'			=> '',
    'full_container' 		=> '',
    'responsive_bg_none' 	=> '',
    'blox_padding_top'		=> '',
    'blox_padding_bottom'	=> '',
    'blox_dark'				=> 'false',
    'blox_class'			=> '',
    'blox_bgcolor'			=> '',
    'parallax_speed'		=> '6',

	// video background
	'video_src'			=> 'host',
	'video_sharing_url'	=> '',
	'mp4_format'		=> '',
	'webm_format'		=> '',
	'ogg_format'		=> '',
	'img_preview_video'	=> '',
	'video_pattern'		=> 'true',
	
	'row_color'=>'',
	
	'maxslider_image1'		=>'',
	'maxslider_image2'		=>'',
	'maxslider_image3'		=>'',
	'maxslider_image4'		=>'',
	'maxslider_image5'		=>'',
	'maxslider_parallax'	=>'true',
	'maxslider_pattern'		=>'true',
		
   
), $atts ) );

// Add visual composer script and css
wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_dequeue_script( 'waypoints' );
wp_enqueue_style('js_composer_custom_css');

// Extract the class
$el_class = $this->getExtraClass($el_class);

// Filtet css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'fc_row '.$el_class, $this->settings['base'] );

// Set row id
$row_id_s = (!empty($row_id))?'id="'.$row_id.'"':'';

// Set blox row class
$blox_class .= $animate ? ' fc-animate' : '';

// Check visual composer row type
switch( $row_type ){
	// Set full width row
	case 1:
		$output .= '</div></section><section '.$row_id_s.' class="' . $css_class . ' ' . $blox_class . ' full-row">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</section><section class="container"><div class="row-wrapper-x">'.$this->endBlockComment('row');
	break;
	// Set blox row
	case 2: 
		$output = wpb_js_remove_wpautop("[blox id='$row_id' row_color='$row_color' bgcolor='$blox_bgcolor' img='{$blox_image}' dark='{$blox_dark}' height='{$blox_height}' padding_top='{$blox_padding_top}' padding_bottom='{$blox_padding_bottom}' bg_attachment='{$blox_bg_attachment}' bg_position='{$blox_bg_position}' bgcover='{$blox_cover}' repeat='{$blox_repeat}' class='{$align_center} {$full_container} {$responsive_bg_none} {$blox_class}']" . $content . "[/blox]");
	break;
	// Set parallax row
	case 3:
		$output = wpb_js_remove_wpautop("[parallax id='$row_id' row_color='$row_color' bgcolor='$blox_bgcolor' img='{$blox_image}' dark='{$blox_dark}' height='{$blox_height}' padding_top='{$blox_padding_top}' padding_bottom='{$blox_padding_bottom}' bg_attachment='{$blox_bg_attachment}' bgcover='{$blox_cover}' repeat='{$blox_repeat}' speed='{$parallax_speed}' class='{$align_center} {$full_container} {$responsive_bg_none} {$blox_class}']".$content."[/parallax]");
	break;
	// Set video row
	case 4:
		$output = wpb_js_remove_wpautop("[videorow id='$row_id' img='{$blox_image}' dark='{$blox_dark}' height='{$blox_height}' padding_top='{$blox_padding_top}' padding_bottom='{$blox_padding_bottom}' bg_attachment='{$blox_bg_attachment}' bgcover='{$blox_cover}' repeat='{$blox_repeat}' class='{$align_center} {$blox_class}' video_src='$video_src' video_sharing_url='$video_sharing_url' mp4_format='$mp4_format' webm_format='$webm_format' ogg_format='$ogg_format' img_preview_video='$img_preview_video' video_pattern='$video_pattern']" . $content . "[/videorow]");
	break;
	// Set slider row
	case 5:
		$output = wpb_js_remove_wpautop("[maxslider id='$row_id' slide1_img_url='$maxslider_image1' slide2_img_url='$maxslider_image2' slide3_img_url='$maxslider_image3' slide4_img_url='$maxslider_image4' slide5_img_url='$maxslider_image5' slide_img_pattern='$maxslider_pattern' slide_img_parallax='$maxslider_parallax']" . $content . '[/maxslider]');
	break;
	// Set default container row
	default:
		if( !empty($row_id) )
			$output .= '<section id="'.$row_id.'" class="' . $css_class . ' ' . $blox_class . '">';
		else
			$output .= '<section class="' . $css_class . ' ' . $blox_class . '">';

		$output .= wpb_js_remove_wpautop($content);
		$output .= '</section>'.$this->endBlockComment('row');		
	break;
}

echo wpb_js_remove_wpautop($output);