<?php
// Get property area
$property_area = cityestate_category_detail( 'property_area', 'names' );

$output = '';

// Check property area is available
if( !empty($property_area) ){
	$output .= '<p class="property-homes">'.esc_html__( 'In ', 'cityestate' ).'<span>'.sprintf( esc_html__( '%s', 'cityestate' ), $property_area ).'</span></p>';
}
return $output;