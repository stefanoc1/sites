<?php

// Include the main taxonomy file
require_once( "Tax-meta-class.php" );

// Check is admin
if( is_admin() ){
    // Configure taxonomy field
    $property_type = array(
        'id'              => 'property_type_meta',
        'local_images'    => false,
        'title'           => esc_html__( 'Property Type', 'cityestate' ),
        'pages'           => array( 'property_type' ),
        'use_with_theme'  => false,
        'context'         => 'normal',
        'fields'          => array(),
    );

    // Code for retina image
    $property_type_icon_retina =  new Tax_Meta_Class( $property_type );
    $property_type_icon_retina->addImage( 'property_type_icon_retina', array( 'name' => esc_html__( 'Google Map Marker Retina Icon ', 'cityestate' ) ) );
    $property_type_icon_retina->Finish();

    // Code for normal image
    $property_type_icon = new Tax_Meta_Class( $property_type );
    $property_type_icon->addImage( 'property_type_icon', array( 'name' => esc_html__( 'Google Map Marker Icon', 'cityestate' ) ) );
    $property_type_icon->Finish();
}