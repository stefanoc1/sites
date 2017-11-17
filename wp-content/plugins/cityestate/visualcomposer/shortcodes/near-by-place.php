<?php

// Cityestate near by place shortcode
function cityestate_near_by_place( $atts, $content = null ){
    // Extact near by place values
	extract( shortcode_atts( array(
		'latitude'			=> 0,
		'longitude'			=> 0,
		'zoom'				=> 17,
		'scrollwheel'		=> '',
		'marker'			=> 'enable',
		'marker_image'		=> '',
		'info_content'      => '',
		'width'				=> '100%',
		'height'			=> '500px',
		'near_by_places'	=> '',
	), $atts ) );

    // Get the link or url of map marker
    if( is_numeric($marker_image) ){
		$marker_image = wp_get_attachment_url($marker_image);
	}

    // Set width and height of google map
	$width     = ( $width ) ? 'width:'.$width.';' : ';';
	$height    = ( $height ) ? 'height:'.$height.';' : ';';

	$output = '';

    // Set google map style
	$google_map_style = cityestate_option('google_map_style');

    // Create unique id for google map
	$token = wp_generate_password(7, false, false);

    $output =
    '<div class="col-xs-12 col-sm-8 col-md-8 no-padding">
        <div id="vc_near_by_place" style="'.esc_attr($width).esc_attr($height).'"></div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 no-padding">
        <ul class="single-property-near-by-list"></ul>
    </div>
    </div>';

    // Parse the near by place
	$near_by_places			= (array) vc_param_group_parse_atts( $near_by_places );
	$near_by_places_data	= array();

    // Collect the near by place in new array
    $Near_By_Place = array();
    foreach( $near_by_places as $data ):
        $temp                   = array();
        $temp['place_type']		= isset( $data['place_type'] ) ? $data['place_type'] : '';
		$temp['place_image']	= isset( $data['place_marker_icon'] ) ? wp_get_attachment_url($data['place_marker_icon']) : '';
		$Near_By_Place[] 		= $temp;
	endforeach;

    // Call js for specially near by place
    wp_enqueue_script( 'cityestate_near_by_place', get_template_directory_uri() . '/js/cityestate_near_by_place.js', array('jquery') );
    // Localize near by place js
    wp_localize_script( 'cityestate_near_by_place', 'CityEstate_near_by_place_Calls_Var', 
        array( 
            'latitude'          => $latitude,
            'longitude'         => $longitude,
            'zoom'              => $zoom,
            'scrollwheel'       => $scrollwheel,
            'google_map_style'   => $google_map_style,
            'map_marker'        => $marker,
            'marker_image'      => $marker_image,
            'info_content'      => $info_content,
            'Near_By_Place'     => $Near_By_Place,
            'Distance_Label'    => esc_html__( 'KM', 'cityestate' )
        ) 
    );	

	return $output;
}
add_shortcode( 'near_by_place','cityestate_near_by_place' );

?>