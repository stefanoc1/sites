<?php

// Get property featured status
$property_featured = get_post_meta( get_the_ID(), 'featured', true );

$features = '';

// Check property is featured
if( $property_featured != 0 ){
	$features = '<span class="featured-label">'.esc_html__( 'FEATURED', 'cityestate' ).'</span>';
}
return $features;