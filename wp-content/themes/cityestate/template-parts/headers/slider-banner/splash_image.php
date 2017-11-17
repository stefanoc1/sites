<?php
// Define global variable
global $post;


// Check page type
if( is_home() || is_day() || is_month() || is_year() || is_tag() || is_author() || is_category() ){
    // Get page id
    $page_id  = get_option( 'page_for_posts' );
    
    // Get image id
    $image_id = get_post_meta( $page_id, 'splash_image', true );
    $img_url  = wp_get_attachment_image_src( $image_id, 'full' );
    
    // Check is home page
    if( is_home() ){
        // Get splash title
        $splash_title      = get_post_meta( $page_id, 'splash_title', true );
        // Get splash sub title
        $splash_subtitle   = get_post_meta( $page_id, 'splash_subtitle', true );
    }

    // Page image overlay status
    $page_image_overlay     = get_post_meta( $page_id, 'splash_image_overlay', true );    
    // Page image opacity
    $page_image_opacity     = get_post_meta( $page_id, 'splash_image_opacity', true );

    // Show splash search
    $splash_search          = get_post_meta( $page_id, 'splash_search', true );    
    $splash_full_screen     = get_post_meta($page_id, 'splash_full_screen', true);    
} else {
    // Get image id
    $image_id               = get_post_meta( $post->ID, 'splash_image' );
    $img_url = array();
    $index = 0;
    foreach ($image_id as $img_id) {
         $img_url[$index] = wp_get_attachment_image_src( $img_id, 'full' );
         $index++;
    }
    
    // Get splash title
    $splash_title      = get_post_meta( $post->ID, 'splash_title', true );
    // Get splash sub title
    $splash_subtitle   = get_post_meta( $post->ID, 'splash_subtitle', true );

    // Page image overlay status
    $page_image_overlay     = get_post_meta( $post->ID, 'splash_image_overlay', true );
    // Page image opacity
    $page_image_opacity     = get_post_meta( $post->ID, 'splash_image_opacity', true );

    // Show splash search
    $splash_search          = get_post_meta( $post->ID, 'splash_search', true );    
    $splash_full_screen     = get_post_meta( $post->ID, 'splash_full_screen', true );    
}
if( $page_image_overlay != '' ){
    $hex = $page_image_overlay;
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");               
}
// Check splash full page
if( $splash_full_screen == 'yes' ) {
    $splash_full_screen = 'banner_fix_screen';
} else {
    $splash_full_screen = '';
} ?>
<div class="list-header banner-single-item <?php echo esc_attr($splash_full_screen); ?>">
    <div id="splashimageslider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php $counter = 0; 
                foreach ($img_url as $image_url) { ?>
                    <div class="item <?php echo ( $counter == 0 ) ? esc_attr('active') : ''; ?>">
                        <img src="<?php echo esc_url($image_url[0]); ?>" alt="header" class="image_header" />
                    </div>
            <?php $counter++; } ?>
        </div>
    </div>

    <div class="banner-inner" style="background-color: <?php echo "rgba( $r, $g, $b,  $page_image_opacity );" ?>"></div>
    <div class="container" id="list-header-title">
        <div class="list_header_text"><?php 
            if( !empty($splash_title) ){ ?>
                <h2><?php echo esc_attr($splash_title); ?></h2><?php 
            }            
            if( !empty($splash_subtitle) ){ ?>
                <h3><?php echo esc_attr($splash_subtitle); ?></h3><?php 
            }
            if( $splash_search == 'yes' ){
                get_template_part('template-parts/advanced-search/search_form_plash', 'splash');
            } ?>
        </div>        
    </div>
</div>