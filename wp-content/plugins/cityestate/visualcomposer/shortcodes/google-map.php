<?php

// Cityestate google map
function cityestate_gmap( $atts, $content = null ){
	// Extract google map values
	extract( shortcode_atts( array(
		'latitude'		=> 0,
		'longitude'		=> 0,
		'zoom'			=> 17,
		'scrollwheel'	=> '',
		'marker'		=> 'enable',
		'marker_image'	=> '',
		'html'			=> '',
		'maptype'		=> 'ROADMAP',
		'width'			=> '100%',
		'height'		=> '500px',
	), $atts ) );

	// Get gallery image
	if( is_numeric($marker_image) ){
		$marker_image = wp_get_attachment_url($marker_image);			
	}

	// Set image width and height
	$width 	= ( $width ) ? 'width:'.$width.';' : ';';
	$height = ( $height ) ? 'height:'.$height.';' : ';';

	$output = '';

	// Set unique id of google map
	$token = wp_generate_password(7, false, false);

	// Google map style
	$google_map_style = cityestate_option( 'google_map_style' );
	if($google_map_style != "" ) {
		$google_map_style = 'styles : '.$google_map_style;
	}
	$output = '<div class="map-outer"><div id=map'.$token.' style="'.esc_attr($width).esc_attr($height).'"></div></div>'; ?>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize(){
	        	var lat_long = {lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?>};

				// Initialize google map
				var map = new google.maps.Map(document.getElementById('map<?php echo $token; ?>'), {
	          		zoom: <?php echo $zoom; ?>,
	          		scrollwheel: <?php echo $scrollwheel == 'enable' ? 'true' : 'false' ?>,
	          		mapTypeId:google.maps.MapTypeId.<?php echo $maptype; ?>,
	          		center: lat_long,
	          		<?php echo $google_map_style; ?>
	        	});

	        	// Google map marker
	        	var map_marker = '<?php echo $marker; ?>';
	        	// Google map marker image
	        	var marker_image = '<?php echo $marker_image; ?>';

				if( map_marker == 'enable' ){
		        	// Show google map marker
		        	var marker = new google.maps.Marker({
		          		position: lat_long,
		          		map: map,
		          		icon: marker_image		          		
		        	});
		        	// Set marker content in info window
		        	var html = '<?php echo $html; ?>';
		        	if( html != '' ){
			        	var infowindow = new google.maps.InfoWindow({
			          		content: html
			        	});
			        	marker.addListener('click', function(){
			          		infowindow.open(map, marker);
			        	});
			        }
		        }
	      	}
	      	// Call google map
			google.maps.event.addDomListener(window, 'load', initialize);
		});
	</script><?php

	return $output;
}
add_shortcode( 'gmap','cityestate_gmap' );

?>