<?php

// Cityestate iconbox shortcode
function cityestate_iconbox( $attr,  $content = null ){
	// Extract iconbox values
	extract( shortcode_atts( array(
		'type'				=> '',
		'icon_title'		=> '',
		'title_color'		=> '',
		'iconbox_content'	=> '',
		'content_color'		=> '',
		'icon_size'			=> '',
		'icon_color'		=> '',
		'icon_image'		=> '',
		'icon_name'			=> '',		
	), $attr ) );

	// Join the content
	ob_start();

	$output = '';
	// Iconbox title color
	$title_style 	= !empty($title_color)?' style="color:'.$title_color.'"':'';
	// Iconbox content color
	$content_style 	= !empty($content_color)?' style="color:'.$content_color.'"':'';

	// Check the type of iconbox
	if( $type == 0 ){
		$output .= '
		<div class="media life-changing-features-2">
			<div class="media-left">';
				// Set icon for iconbox
				if( !empty($icon_name) && $icon_name != 'none' ) :
					$output .= do_shortcode( "[icon name='$icon_name' size='$icon_size' color='$icon_color']" );
				elseif( !empty($icon_image) ):
					// Set image as icon for iconbox
					if( is_numeric($icon_image) ){
						$icon_image = wp_get_attachment_url( $icon_image );
					}
					// Iconbox image
					$output .= '<img class="media-object" src="'.$icon_image.'" alt="' . $icon_title . '">';
				endif;
			$output .= '
			</div>
			<div class="media-body">
				<h4 class="media-heading" '.$title_style.'>' . sprintf( esc_html__( '%s', 'cityestate' ), $icon_title ) . '</h4>
				<p class="media-detail" '.$content_style.'>' . sprintf( esc_html__( '%s', 'cityestate' ), $iconbox_content ) .'</p>
			</div>
		</div>';
	} else if( $type == 1 ){
		$output .= '
		<div class="life-changing-features">
			<div class="media">
				<div class="media-left">';
				// Set icon for iconbox
				if( !empty($icon_name) && $icon_name != 'none' ) :
					$output .= do_shortcode( "[icon name='$icon_name' size='$icon_size' color='$icon_color']" );
				elseif( !empty($icon_image) ):
					// Set image as icon for iconbox
					if( is_numeric($icon_image) ){
						$icon_image = wp_get_attachment_url( $icon_image );
					}
					// Iconbox image
					$output .= '<img class="media-object" src="'.$icon_image.'" alt="' . sprintf( esc_html__( '%s', 'cityestate' ), $icon_title ) . '">';
				endif;
				$output .= '
				</div>
				<div class="media-body">
					<h4 class="media-heading" '.$title_style.'>' . sprintf( esc_html__( '%s', 'cityestate' ), $icon_title ) . '</h4>
					<p class="media-detail" '.$content_style.'>' . sprintf( esc_html__( '%s', 'cityestate' ), $iconbox_content ) .'</p>
				</div>
			</div>
		</div>';
	} else if( $type == 2 ){
		$output .= '
		<div class="feature-box">
			<div class="feature-icon">';
				// Set icon for iconbox
				if( !empty($icon_name) && $icon_name != 'none' ) :
					$output .= do_shortcode( "[icon name='$icon_name' size='$icon_size' color='$icon_color']" );
				elseif( !empty($icon_image) ):
					// Set image as icon for iconbox
					if(is_numeric($icon_image)){
						$icon_image = wp_get_attachment_url( $icon_image );
					}					
					// Iconbox image
					$output .= '<img class="media-object" src="'.$icon_image.'" alt="' . sprintf( esc_html__( '%s', 'cityestate' ), $icon_title ) . '">';
				endif;				
			$output .= '
			</div>
			<h5>'. sprintf( esc_html__( '%s', 'cityestate' ), $icon_title ) .'</h5>
			<h3>'. sprintf( esc_html__( '%s', 'cityestate' ), $iconbox_content ) .'</h3>
		</div>';		
	}
	
	return $output;
}
add_shortcode( 'iconbox', 'cityestate_iconbox' );

?>