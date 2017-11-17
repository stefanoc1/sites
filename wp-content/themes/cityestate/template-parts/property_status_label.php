<?php

$status_label = '';

// Get property status
$property_status = cityestate_category_detail( 'property_status', 'names' );

// Check property status is available
if( !empty($property_status) ){
	$status_label .= '<span class="status-label">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_status ).'</span>';
}

// get property label
$property_label = cityestate_category_detail( 'property_label', 'names' );

// Check property label is available
if( !empty($property_label) ){
	$status_label .= '<span class="label-label">'.sprintf( esc_html__( '%s', 'cityestate' ), $property_label ).'</span>';
}

return $status_label;