<?php
// Get property address
$property_address = get_post_meta( get_the_ID(), 'property_address', true );

$location_info = '';

// Check property address is available
if( !empty($property_address) ){
	$location_info = '<p class="property-box1-address">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_address).'</p>';
}

return $location_info;