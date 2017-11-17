<?php
// Define global variable
global $post;

// Get search bar status
$search_on_header = cityestate_option( 'show_advance_search_on_header' );

// Search on header
if( $search_on_header != 0 ){
    // Header page
    $header_page = cityestate_option( 'show_advance_search_header_page' );    
}

// Check search is show
$search_is_show  = cityestate_option( 'header_menu_search_is_show' );

// Check search status
if( $search_is_show != 0 ){
    // Search position
    $search_position    = cityestate_option( 'header_search_position' );
    $fc_search_pages    = cityestate_option( 'header_search_bar_position' );
    // Specific page
    $bar_in_page        = cityestate_option( 'header_menu_search_is_show' );
}

// Check is home page
if( is_home() || is_search() || is_404() ){
    $page_for_posts = get_option( 'page_for_posts' );
    // Get header type
    $fc_header_type = get_post_meta( $page_for_posts, 'header_type', true );
} else {
    $fc_header_type = get_post_meta( $post->ID, 'header_type', true );
}

// Search form under menu
if( !is_page_template( 'templates/template_splash.php' ) ){
    if( $search_is_show != 0 && $search_position == 'under_nav' ){
        // Search in only home
        if( $fc_search_pages == 'only_home'){
            if( is_front_page() ){
                get_template_part('template-parts/advanced-search/search_form_undernav' );
            }
        // Search in all page
        } elseif( $fc_search_pages == 'all_pages' ){
            get_template_part('template-parts/advanced-search/search_form_undernav' );

        // Search in innerpage
        } elseif( $fc_search_pages == 'only_innerpages' ){
            if( !is_front_page() ){
                get_template_part('template-parts/advanced-search/search_form_undernav' );
            }
        // Search in selected page
        } else if($fc_search_pages == 'specific_pages' ){
            $header_specific = cityestate_option( 'show_advance_search_header_specific' );
            if( is_page( $bar_in_page ) ){
                get_template_part('template-parts/advanced-search/search_form_undernav' );
            }
        }
    }
}

// Check is splash page
if( is_page_template( 'templates/template_splash.php' ) ){
    // Show slider image
    get_template_part('template-parts/headers/slider-banner/splash_image');
} else {
    // Check header type
    if( !empty( $fc_header_type ) && $fc_header_type != 'none' ){
        // Header with slider
        if( $fc_header_type == 'property_slider' ){
            get_template_part('template-parts/headers/slider-banner/property_slider');
        // Header with revolution
        } else if( $fc_header_type == 'revolution_slider' ){
            get_template_part('template-parts/headers/slider-banner/revolution_slider');
        // Header with map
        } else if( $fc_header_type == 'property_map' ){
            get_template_part('template-parts/headers/slider-banner/map_slider');
        // Header with banner image
        } else if( $fc_header_type == 'static_image' ){
            get_template_part('template-parts/headers/slider-banner/static_image');
        // Header with video
        } else if( $fc_header_type == 'video' ){
            get_template_part('template-parts/headers/slider-banner/video');
        }
    }

}

// Check is not splash page
if( !is_page_template( 'templates/template_splash.php' ) ){
    if( $search_on_header != 0 ){
        // Show in only home page
        if( $header_page == 'only_home' ){
            if( is_front_page() ){
                get_template_part('template-parts/advanced-search/search_form');
            }
        // Show in all page
        } else if( $header_page == 'all_pages' ){
            get_template_part('template-parts/advanced-search/search_form');
        // Show in only inner page
        } else if( $header_page == 'only_innerpages' ){
            if (!is_front_page()) {
                get_template_part('template-parts/advanced-search/search_form');
            }
        // Show in selected page
        } else if($header_page == 'specific_pages' ){
            $header_specific = cityestate_option( 'show_advance_search_header_specific' );
            if( is_page( $header_specific ) ){
                get_template_part('template-parts/advanced-search/search_form');
            }
        }
    }
}

// Adance search
if( !is_page_template( 'templates/template_splash.php' ) ){
    if( $search_is_show != 0 && $search_position == 'under_banner' ){    
        // Show in home page only
        if( $fc_search_pages == 'only_home'){
            if( is_front_page() ){
                get_template_part('template-parts/advanced-search/search_form_undernav' );
            }
        // show in all pages
        } else if( $fc_search_pages == 'all_pages' ){
            get_template_part('template-parts/advanced-search/search_form_undernav' );
        // Show in inner page
        } else if( $fc_search_pages == 'only_innerpages' ){
            if( !is_front_page() ){
                get_template_part('template-parts/advanced-search/search_form_undernav' );
            }
        // Show in selected page
        } else if($fc_search_pages == 'specific_pages' ){
            $header_specific = cityestate_option( 'show_advance_search_header_specific' );
            if( is_page( $bar_in_page ) ){
                get_template_part('template-parts/advanced-search/search_form_undernav' );
            }
        }
    }
}

?>