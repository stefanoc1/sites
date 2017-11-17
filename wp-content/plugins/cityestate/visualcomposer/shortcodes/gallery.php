<?php

// Cityestate gallery shortcode
function cityestate_gallery( $atts, $content = null ){
	// Extract gallery values
	extract( shortcode_atts( array(
		'gallery_images' => '',		
	), $atts ) );
	$output = "";
	
	// Parse gallery
	$gallery_images			= (array) vc_param_group_parse_atts( $gallery_images );
	$gallery_images_data	= array();

	foreach( $gallery_images as $data ):
		// Collect the gallery info
		$temp 					= $data;
		$temp['gallery_image']	= isset( $data['gallery_image'] ) ? $data['gallery_image'] : '';
		$temp['image_caption']	= isset( $data['image_caption'] ) ? $data['image_caption'] : '';
		$gallery_images_data[] 	= $temp;
	endforeach;	
	
	// Store outer element in variable
	$output .= '<ul class="gallery-list">';

	// Collect the gallery detail
	foreach( $gallery_images_data as $gallery ):		
		if( is_numeric($gallery['gallery_image']) ){
			// Gallery image
			$gallery_image = wp_get_attachment_url($gallery['gallery_image']);			
		}
		// Gallery image caption
		$image_caption = $gallery['image_caption'];

		$output .=
		'<li>
			<div class="single-galery-inner" data-toggle="modal" data-target="#image_lightbox">
				<img src="'.esc_url($gallery_image).'" alt="'.sprintf( esc_html__( '%s', 'cityestate' ), $image_caption ).'">
				<div class="single-gallery-image-overley">
					<div class="single-gallery-image-overley-content">
						<img src="'.get_template_directory_uri().'/images/overley.png" alt="Overley">
						<p>'.sprintf( esc_html__( '%s', 'cityestate' ), $image_caption ).'</p>
					</div>
				</div>
			</div>
		</li>';
	endforeach;

	// Close the last element
	$output .= '</ul>';
	
	return $output;
}
add_shortcode( 'gallery','cityestate_gallery' );

?>