<?php
if( !function_exists( 'cityestate_importer_description_text' ) ){

// Way to set menu, import revolution slider, and set home page.
if( !function_exists( 'cityestate_menu_revolutionslider_homepage_setup' ) ){
    function cityestate_menu_revolutionslider_homepage_setup( $demo_active_import , $demo_directory_path ){
        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        // Import slider(s) for the current demo being imported
        if( class_exists( 'RevSlider' ) ){
            $wbc_sliders_array = array( 'Demo_Cityestate' => 'cityestate-slider.zip' );
            if( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ){
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
                if( file_exists( $demo_directory_path.$wbc_slider_import ) ){
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
                }
            }
        }
        
        // Setting Menus
        $wbc_menu_array = array( 'Demo_Cityestate' );
        if( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ){
            $top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
            $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
            $one_page_menu = get_term_by( 'name', 'One Page Menu', 'nav_menu' );
            $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
            if( isset( $main_menu->term_id ) ){
                set_theme_mod( 'nav_menu_locations', array(
                        'top-menu' => $top_menu->term_id,
                        'main-menu' => $main_menu->term_id,
                        'one-page-menu' => $one_page_menu->term_id,
                        'footer-menu'  => $footer_menu->term_id
                    )
                );
            }
        }
        
        // Set HomePage
        $wbc_home_pages = array(
            'Demo_Cityestate' => 'Home'
        );
        if( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ){
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if( isset( $page->ID ) ){
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }
    }
    add_action( 'wbc_importer_after_content_import', 'cityestate_menu_revolutionslider_homepage_setup', 10, 2 );
}