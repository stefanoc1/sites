<?php

// Cityestate custom style
function cityestate_custom_style(){

    $logo_desktop = $logo_mobile = '';

    // Set logo width and height
    $logo_desktop_size 	= cityestate_option( 'desktop_logo_dimensions' );
    $logo_width 	    = isset( $logo_desktop_size['width'] ) ? $logo_desktop_size['width'] : '';
    $logo_height 	    = isset( $logo_desktop_size['height'] ) ? $logo_desktop_size['height'] : '';

    if( !empty($logo_width) && !empty($logo_height) && $logo_width != 'px' ){
        $logo_desktop = "
        .main-logo img {
            width: {$logo_width};
            height: {$logo_height};
        }";        
    }

    //Body Background color
    $body_bg_color = cityestate_option( 'body_bg_color' );
    $body_background_color = "";

    if( !empty($body_bg_color) && $body_bg_color != '#ffffff') {

        $body_background_color= "
        body {
            background-color:{$body_bg_color}
        }";
    }

    //Header Background color
    $header_bg_color = cityestate_option( 'header_bg_color' );
    $header_background_color = "";

    if( !empty($header_bg_color) && $header_bg_color != '#ffffff') {

        $header_background_color= "
        header {
            background-color:{$header_bg_color}
        }";
    }

    //Topbar Background color
    $topbar_bg_color = cityestate_option( 'topbar_bg_color' );
    $topbar_background_color = "";

    if( !empty($topbar_bg_color) && $topbar_bg_color != '#ffffff') {

        $topbar_background_color= "
        .first-header  {
            background-color:{$topbar_bg_color}
        }";
    }

    //Menu Background color
    $menu_bg_color = cityestate_option( 'menu_bg_color' );
    $menu_background_color = "";

    if( !empty($menu_bg_color) && $menu_bg_color != '#ffffff') {

        $menu_background_color= "
        .second-header {
            background-color:{$menu_bg_color}
        }";
    }

    //Topbar Social Icon color
    $topbar_social_color = cityestate_option( 'topbar_social_color' );
    $topbar_social_font_color = "";

    if( !empty($topbar_social_color) && $topbar_social_color != '#8696ab') {

        $topbar_social_font_color= "
        .first-header span.social-tag,
        .first-header ul.socials a,
        .first-header .usersection > ul li a,
        .first-header .contact-info h2 a,
        .first-header .contact-info span {
            color:{$topbar_social_color}
        }";
    }

    //Topbar Social Icon color
    $topbar_social_hover_color = cityestate_option( 'topbar_social_hover_color' );
    $topbar_social_font_hover_color = "";

    if( !empty($topbar_social_hover_color) && $topbar_social_hover_color != '#0f1e32') {

        $topbar_social_font_hover_color= "
        .first-header ul.socials a:hover,
        .first-header .usersection > ul li a:hover,
        .first-header .contact-info h2 a:hover {
            color:{$topbar_social_hover_color}
        }";
    }

    //Menu Link color
    $menu_links_color = cityestate_option( 'menu_links_color' );
    $menu_links_font_color = "";

    if( !empty($menu_links_color) && $menu_links_color != '#5f6e82') {

        $menu_links_font_color= "
        .menu #nav > li > a {
            color:{$menu_links_color} !important
        }";
    }

    //Menu Linnk Hover color
    $menu_links_hover_color = cityestate_option( 'menu_links_hover_color' );
    $menu_links_font_hover_color = "";

    if( !empty($menu_links_hover_color) && $menu_links_hover_color != '#323a45') {

        $menu_links_font_hover_color= "
        .menu #nav > li > a:hover, 
        #nav > li:hover > a {
            color:{$menu_links_hover_color} !important
        }";
    }

    //Submenu Background color
    $submenu_bg_color = cityestate_option( 'submenu_bg_color' );
    $submenu_background_color = "";

    if( !empty($submenu_bg_color) && $submenu_bg_color != '#ffffff') {

        $submenu_background_color= "
        .menu #nav ul li a, 
        .menu ul.sub-menu li a {
            background-color:{$submenu_bg_color}
        }";
    }

    //Submenu Link Color
    $submenu_links_color = cityestate_option( 'submenu_links_color' );
    $submenu_links_font_color = "";

    if( !empty($submenu_links_color) && $submenu_links_color != '#5f6e82') {

        $submenu_links_font_color= "
        .menu #nav ul.sub-menu li > a, 
        #nav ul.sub-menu li > a {
            color:{$submenu_links_color} !important;
        }";
    }

     //Submenu Link Hover Color
    $submenu_links_hover_color = cityestate_option( 'submenu_links_hover_color' );
    $submenu_links_font_hover_color = "";

    if( !empty($submenu_links_hover_color) && $submenu_links_hover_color != '#323a45') {

        $submenu_links_font_hover_color= "
        .menu #nav ul.sub-menu li > a:hover, 
        #nav ul.sub-menu li:hover > a {
            color:{$submenu_links_hover_color} !important;
        }";
    }

    //Submenu Link Hover Color
    $submenu_border_color = cityestate_option( 'submenu_border_color' );
    $submenu_border_style_color = "";

    if( !empty($submenu_border_color) && $submenu_border_color != '#c3d2e6') {

        $submenu_border_style_color= " 
        .menu #nav ul li a,
        .menu ul.sub-menu li a,
        .menu .sub-menu {
            border-color:{$submenu_border_color} !important;
        }";
    }

     //Submenu Link Hover Color
    $submit_property_bg_color = cityestate_option( 'submit_property_bg_color' );
    $submit_property_background_color = "";

    if( !empty($submit_property_bg_color) && $submit_property_bg_color != '#c3d2e6') {

        $submit_property_background_color= " 
        .menu .nav.navbar-nav > li.submit-property {
            background-color:{$submit_property_bg_color};
        }";
    }

    $submit_property_link_color = cityestate_option( 'submit_property_link_color' );
    $submit_property_font_link_color = "";

    if( !empty($submit_property_link_color) && $submit_property_link_color != '#323a45') {

        $submit_property_font_link_color= " 
        .menu #nav > li.submit-property a {
            color:{$submit_property_link_color} !important;
        }";
    }

    $submit_property_border_color = cityestate_option( 'submit_property_border_color' );
    $submit_property_border_style_color = "";

    if( !empty($submit_property_border_color) && $submit_property_border_color != '#fd7f59') {

        $submit_property_border_style_color= " 
        .menu .nav.navbar-nav > li.submit-property {
            border-color:{$submit_property_border_color};
        }";
    }

     //Submenu Link Hover Color
    $submit_property_bg_hover_color = cityestate_option( 'submit_property_bg_hover_color' );
    $submit_property_background_hover_color = "";

    if( !empty($submit_property_bg_hover_color) && $submit_property_bg_hover_color != '#fd7f59') {

        $submit_property_background_hover_color= " 
        .menu .nav.navbar-nav > li.submit-property:hover {
            background-color:{$submit_property_bg_hover_color};
        }";
    }

    $submit_property_link_hover_color = cityestate_option( 'submit_property_link_hover_color' );
    $submit_property_font_link_hover_color = "";

    if( !empty($submit_property_link_hover_color)) {

        $submit_property_font_link_hover_color= " 
        .menu #nav > li.submit-property a:hover {
            color:{$submit_property_link_hover_color} !important;
        }";
    }

    $submit_property_border_hover_color = cityestate_option( 'submit_property_border_hover_color' );
    $submit_property_border_style_hover_color = "";

    if( !empty($submit_property_border_hover_color) && $submit_property_border_hover_color != '#fd7f59') {

        $submit_property_border_style_hover_color= " 
        .menu .nav.navbar-nav > li.submit-property:hover {
            border-color:{$submit_property_border_hover_color};
        }";
    }

    $advance_search_bg_color = cityestate_option( 'advance_search_bg_color' );
    $advance_search_background_color = "";

    if( !empty($advance_search_bg_color) && $advance_search_bg_color != '#fd7f59') {

        $advance_search_background_color= " 
        .third-header {
            background-color:{$advance_search_bg_color};
        }";
    } else if(empty($advance_search_bg_color) || $advance_search_bg_color == "") {

        $advance_search_background_color= " 
        .third-header {
            background-color: transparent;
        }";
    }

    $advacne_search_filed_btn_color = cityestate_option( 'advacne_search_filed_btn_color' );
    $advacne_search_filed_button_color = "";

    if( !empty($advacne_search_filed_btn_color) && $advacne_search_filed_btn_color != '#fd7f59') {

        $advacne_search_filed_button_color= " 
        input.search-field.advance {
            color:{$advacne_search_filed_btn_color} !important;
        }";
    }

    $advacne_search_submit_btn_bg_color = cityestate_option( 'advacne_search_submit_btn_bg_color' );
    $advacne_search_submit_button_background_color = "";

    if( !empty($advacne_search_submit_btn_bg_color) && $advacne_search_submit_btn_bg_color != '#fd7f59') {

        $advacne_search_submit_button_background_color= "
        .search-header .search-field.submit-search {
            background-color:{$advacne_search_submit_btn_bg_color} !important;
        }";
    }

    $advacne_search_submit_btn_text_color = cityestate_option( 'advacne_search_submit_btn_text_color' );
    $advacne_search_submit_button_text_color = "";

    if( !empty($advacne_search_submit_btn_text_color) && $advacne_search_submit_btn_text_color != '#ffffff') {

        $advacne_search_submit_button_text_color= "
        .search-header .search-field.submit-search {
            color:{$advacne_search_submit_btn_text_color} !important;
        }";
    }

    $advacne_search_form_elements_bg_color = cityestate_option( 'advacne_search_form_elements_bg_color' );
    $advacne_search_form_elements_background_color = "";

    if( !empty($advacne_search_form_elements_bg_color) && $advacne_search_form_elements_bg_color != '#ffffff') {

        $advacne_search_form_elements_background_color= "
        .search-header .search-field.keyword,
        .bootstrap-select.search-field .btn,
        input.search-field.advance {
            background-color:{$advacne_search_form_elements_bg_color} !important;
        }";
    }

    $advacne_search_position = cityestate_option( 'advacne_search_position' );
    $advacne_search_position_style  = "";

    if( !empty($advacne_search_position)) {

        $advacne_search_position_style = "
        .third-header {
            position:{$advacne_search_position} !important;
        }";
    }

    $advacne_search_marign_top = cityestate_option( 'advacne_search_marign_top' );
    $advacne_search_marign_top_style  = "";

    if( !empty($advacne_search_marign_top)) {

        $advacne_search_marign_top_style = "
        .third-header {
            margin-top:{$advacne_search_marign_top} !important;
        }";
    }

    $dashbord_mytabs_bg_color = cityestate_option( 'dashbord_mytabs_bg_color' );
    $dashbord_mytabs_background_color = "";

    if( !empty($dashbord_mytabs_bg_color) && $dashbord_mytabs_bg_color != '#323A45') {

        $dashbord_mytabs_background_color= " 
        .my-tabs {
            background-color:{$dashbord_mytabs_bg_color};
        }";
    } else if(empty($dashbord_mytabs_bg_color) || $dashbord_mytabs_bg_color == "") {

        $dashbord_mytabs_background_color= " 
        .my-tabs {
            background-color: transparent;
        }";
    }

    $dashboard_mytabs_marign_top = cityestate_option( 'dashboard_mytabs_marign_top' );
    $dashboard_mytabs_marign_top_style  = "";

    if( !empty($dashboard_mytabs_marign_top)) {

        $dashboard_mytabs_marign_top_style = "
        .my-tabs {
            margin-top:{$dashboard_mytabs_marign_top} !important;
        }";
    }

    // Custom extra css
    $custom_css = cityestate_option('custom_css');

    // Cityestate apply inline style
    wp_add_inline_style( 'cityestate-style',
    	$logo_desktop.
        $custom_css.
        $body_background_color.
        $header_background_color.
        $topbar_background_color.
        $menu_background_color.
        $topbar_social_font_color.
        $topbar_social_font_hover_color.
        $menu_links_font_color.
        $menu_links_font_hover_color.
        $submenu_background_color.
        $submenu_links_font_color.
        $submenu_links_font_hover_color.
        $submenu_border_style_color.
        $submit_property_background_color.
        $submit_property_border_style_color.
        $submit_property_font_link_color.
        $submit_property_background_hover_color.
        $submit_property_border_style_hover_color.
        $submit_property_font_link_hover_color.
        $advance_search_background_color.
        $advacne_search_filed_button_color.
        $advacne_search_submit_button_background_color.
        $advacne_search_submit_button_text_color.
        $advacne_search_form_elements_background_color.
        $advacne_search_position_style.
        $advacne_search_marign_top_style.
        $dashbord_mytabs_background_color.
        $dashboard_mytabs_marign_top_style
    );

}

add_action( 'wp_enqueue_scripts', 'cityestate_custom_style', 21 );

?>