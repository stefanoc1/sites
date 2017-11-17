<?php
// Define global variable
global $post;

// Check page type
if( is_home() || is_day() || is_month() || is_year() || is_tag() || is_author() || is_category() || is_search() || is_404() ){
    // Check is search
    if( is_search() || is_404()){
        // Get page id
        $page_id = get_option( 'page_for_posts' );
        
        // Get image id
        $img_url = array();
        $img_url[0]             = cityestate_option( 'search_banner_image', 'url' );
        // Image height
        $image_height           = get_post_meta( $page_id, 'page_banner_height', true );
        // Page image overlay
        $page_image_overlay     = get_post_meta( $page_id, 'page_banner_overlay', true );
        // Page image opacity
        $page_image_opacity     = get_post_meta( $page_id, 'page_banner_opacity', true );
    } else {
        // Get page id
        $page_id                = get_option( 'page_for_posts' );
        // Get image id
        $image_id               = get_post_meta( $page_id, 'page_banner_image', true );
        $img_url                = wp_get_attachment_image_src( $image_id, 'full' );
        $image_height           = get_post_meta( $page_id, 'page_banner_height', true );

        // Check is home page
        if( is_home() ){
            // Page banner title
            $page_banner_title      = get_post_meta( $page_id, 'page_banner_title', true );
            // Page banner sub title
            $page_banner_subtitle   = get_post_meta( $page_id, 'page_banner_subtitle', true );
        }
        // Page image overlay
        $page_image_overlay     = get_post_meta( $page_id, 'page_banner_overlay', true );
        // Page image opacity
        $page_image_opacity     = get_post_meta( $page_id, 'page_banner_opacity', true );
    }

} else {
    // Image id
    $image_id               = get_post_meta( $post->ID, 'page_banner_image', true );
    $img_url                = wp_get_attachment_image_src( $image_id, 'full' );
    $image_height           = get_post_meta( $post->ID, 'page_banner_height', true );

    // Page banner title
    $page_banner_title      = get_post_meta( $post->ID, 'page_banner_title', true );
    $page_banner_subtitle   = get_post_meta( $post->ID, 'page_banner_subtitle', true );

    if(get_post_meta( $post->ID, 'original_page_title', true ) == 'yes' ) {
        $page_real_title = get_the_title();
    }

    // Page image overlay
    $page_image_overlay     = get_post_meta( $post->ID, 'page_banner_overlay', true );
    $page_image_opacity     = get_post_meta( $post->ID, 'page_banner_opacity', true );
}

$element_style = '';
list($r, $g, $b) = "";
// Image height
if( !empty($image_height) ){
    $image_height = 'height: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $image_height ) ? $image_height : $image_height . 'px' ) . ' !important;';
    $element_style .= $image_height ." width:auto !important; max-width: none !important;";
} ?>

        <?php if( $page_image_overlay != '' ){
                $hex = $page_image_overlay;
                list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");               
        } ?>

<div class="list-header banner-single-item" style="<?php echo esc_attr($image_height);?>">
    <div class="banner-inner" style="background-color: <?php echo "rgba( $r, $g, $b,  $page_image_opacity );" ?>"></div>
    <!-- Page image -->
    <img src="<?php echo esc_url($img_url[0]); ?>" alt="header" class="image_header" style="<?php echo esc_attr($element_style); ?>" />
    <div class="container" id="list-header-title">
        <div class="list_header_text"><?php 
            // Banner title
            if( !empty($page_banner_title) ){ ?><h2><?php echo esc_attr($page_banner_title); ?></h2><?php }
            // Banner sub title
            if( !empty($page_banner_subtitle) ){ ?><h3><?php echo esc_attr($page_banner_subtitle); ?></h3><?php } ?>            
            <?php if( !empty( $page_real_title ) && $page_real_title != "" )  { ?>
            <h3 class="page-origtinal-title"><?php echo $page_real_title ?></h3>  <?php } ?>
            <div class="breadcrumb">
                <ol class="breadcrumb"><?php
                    // Breadcrumbs status
                    $breadcrumbs_pages = cityestate_option( 'show_breadcrumb_in_page' );
                    if( is_home() ){ 
                        // Show in home page
                        if( $breadcrumbs_pages == 'only_home'){
                            if( is_front_page() ){
                                echo cityestate_blog_breadcrumbs();
                            }
                        // Show in all page
                        } else if( $breadcrumbs_pages == 'all_pages' ){
                            echo cityestate_blog_breadcrumbs();
                        // Show in inner page
                        } else if( $breadcrumbs_pages == 'only_innerpages' ){
                            if( !is_front_page() ){
                                echo cityestate_blog_breadcrumbs();
                            }
                        // Show in selected page
                        } else if($breadcrumbs_pages == 'specific_pages' ){
                            // Get selected page detail
                            $selected_pages    = cityestate_option( 'show_breadcrumb_in_specific' );
                            if( is_page( $selected_pages ) ){
                                echo cityestate_blog_breadcrumbs();
                            }
                        }                        
                    } else {
                        // Show in home page
                        if( $breadcrumbs_pages == 'only_home'){
                            if( is_front_page() ){
                                echo cityestate_breadcrumb();
                            }
                        // Show in all pages
                        } else if( $breadcrumbs_pages == 'all_pages' ){
                            echo cityestate_breadcrumb();
                        // Show in inner page
                        } else if( $breadcrumbs_pages == 'only_innerpages' ){
                            if( !is_front_page() ){
                                echo cityestate_breadcrumb();
                            }
                        // Show in selected page
                        } else if($breadcrumbs_pages == 'specific_pages' ){
                            // Get selected page detail
                            $selected_pages    = cityestate_option( 'show_breadcrumb_in_specific' );
                            if( is_page( $selected_pages ) ){
                                echo cityestate_breadcrumb();
                            }
                        }
                    } ?>
                </ol>
            </div>
        </div>        
    </div>
</div>