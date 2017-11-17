<?php
// Declare global variable
global $post, $current_user;
wp_get_current_user();

// Get user id and user favorite property status
$user_id     		= $current_user->ID;
$cityestate_option 	= 'cityestate_favorites_'.$user_id;
$cityestate_option 	= get_option( $cityestate_option );

if( !empty($cityestate_option) ){
	// Property id search in array
    $key = array_search( $post->ID, $cityestate_option );
} else {
	$key = '';
}

// Set favorite property icon
if( $key != false || $key != '' ) {
    $cityestate_class = 'fa fa-heart';
} else {
    $cityestate_class = 'fa fa-heart-o';
}

$property_features = '';

$property_features =  '<a href="javascript:void(0);" class="like-property add-favorite" data-propertyid="'.intval( $post->ID ).'" data-toggle="tooltip" data-placement="left" title="'.esc_attr__( 'FAVORITE', 'cityestate' ).'"> <i class="'.esc_attr( $cityestate_class ).'" aria-hidden="true"></i> </a>';

return $property_features;