<?php

// Add metabox
function cityestate_add_metabox( $meta_boxes ) { 

    // Agent metabox
    require_once( CITYESTATE_PATH . 'framework/meta-box/meta-box/agent_metabox.php' );

    // Invoice metabox
    require_once( CITYESTATE_PATH . 'framework/meta-box/meta-box/invoice_metabox.php' );

    // Package metabox
    require_once( CITYESTATE_PATH . 'framework/meta-box/meta-box/package_metabox.php' );

    // Page metabox
    require_once( CITYESTATE_PATH . 'framework/meta-box/meta-box/page_metabox.php' );

    // Property metabox
    require_once( CITYESTATE_PATH . 'framework/meta-box/meta-box/property_metabox.php' );

    // Testimonial metabox
    require_once( CITYESTATE_PATH . 'framework/meta-box/meta-box/testimonial_metabox.php' );   

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'cityestate_add_metabox' );