<?php

// Show revolution slider
global $post;
if( is_plugin_active('revslider/revslider.php') ){
    $revslider_slug = get_post_meta( $post->ID, 'page_banner_rev_slider', true );
    // Execute revolution slider
    putRevSlider($revslider_slug);
}

?>