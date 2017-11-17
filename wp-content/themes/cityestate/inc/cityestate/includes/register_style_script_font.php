<?php

// Cityestate add css and script
function cityestate_add_css_script(){

	global $post, $current_user;

    // Register Fonts
    wp_enqueue_style( 'cityestate-fonts', cityestate_fonts_url(), '', '', 'all' );

    // Register Styles
    wp_enqueue_style( 'jquery-ui-css', get_template_directory_uri().'/css/jquery-ui.css' );
    wp_enqueue_style( 'font-awesome.min', get_template_directory_uri().'/css/font-awesome.min.css', array(), '4.3.0', 'all' );
    wp_enqueue_style( 'bootstrap.min', get_template_directory_uri().'/css/bootstrap.min.css', array(), '3.3.4', 'all' );
    wp_enqueue_style( 'bootstrap-select.min', get_template_directory_uri().'/css/bootstrapSelect/bootstrap-select.min.css', array(), '1.10.0', 'all' );
    wp_enqueue_style( 'jquery-ui', get_template_directory_uri().'/css/jquery-ui.css', array(), '1.11.4', 'all' );
    wp_enqueue_style( 'jquery-mmenu', get_template_directory_uri().'/css/jquery.mmenu.all.css', array(), '1.11.4', 'all' );

    wp_enqueue_style( 'cityestate-js-composer', get_template_directory_uri().'/inc/cityestate/frame-work/visualcomposer/assets/js_composer.min.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-visualcomposer', get_template_directory_uri().'/css/visualcomposer.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-row', get_template_directory_uri().'/css/cityestate-row.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-iconfont', get_template_directory_uri().'/css/cityestate-iconfont.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-blog', get_template_directory_uri().'/css/cityestate-blog.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-element', get_template_directory_uri().'/css/cityestate-element.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-style', get_template_directory_uri().'/css/cityestate-style.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-more-style', get_template_directory_uri().'/css/cityestate-more-style.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-custom', get_template_directory_uri().'/css/cityestate-custom.css', array(), CITYESTATE_THEME_VERSION, 'all' );
    wp_enqueue_style( 'cityestate-style', get_stylesheet_uri(), array(), CITYESTATE_THEME_VERSION, 'all' );
    
    // Register Scripts
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-touch-punch' );
    wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'cityestate-cookie', get_template_directory_uri().'/js/jquery.cookie.js', array( 'jquery' ), '1.4.1', true );
    wp_enqueue_script( 'jquery-ui', get_template_directory_uri().'/js/jquery-ui.js', array( 'jquery' ), '1.11.4', true );
    wp_enqueue_script( 'jquery-lib', get_template_directory_uri() . '/js/jquery.plugins.js', array( 'jquery' ), CITYESTATE_THEME_VERSION, true );
    wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri().'/js/jquery.mmenu.all.min.js', array( 'jquery' ), '3.3.4', true );
    wp_enqueue_script( 'bootstrap.min', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '3.3.4', true );
    wp_enqueue_script( 'bootstrap-select.min', get_template_directory_uri().'/js/bootstrapSelect/bootstrap-select.min.js', array( 'jquery' ), '1.10.0', true );
    wp_enqueue_script( 'cityestate-row', get_template_directory_uri() . '/js/cityestate-row.js', array( 'jquery' ), CITYESTATE_THEME_VERSION, true );
    wp_enqueue_script( 'cityestate-custom', get_template_directory_uri().'/js/custom.js', array( 'jquery' ), CITYESTATE_THEME_VERSION, true );

    // Google map details
    $google_map_ssl_key = cityestate_option('google_map_ssl_key');
    $google_map_api_key = cityestate_option('google_map_api_key');    

    if( esc_html( $google_map_ssl_key ) == 'yes' ){
        wp_enqueue_script('google-map', 'https://maps-api-ssl.google.com/maps/api/js?libraries=places&key='.esc_html( $google_map_api_key ),array('jquery'), '1.0', false);
    } else {
        if( !empty($google_map_api_key) ){
            wp_enqueue_script('google-map', 'http://maps.googleapis.com/maps/api/js?libraries=places&key='.esc_html( $google_map_api_key ),array('jquery'), array('jquery'), '1.0', false);
        } else {
            wp_enqueue_script('google-map', 'http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCBnyL9MhOZlec1Mz1_qImukxi-VFqQKJw', array('jquery'), '1.0', false);
        }                
    }
    $header_type = "";
    if( !is_search() && !is_404()) {
        $header_type = get_post_meta( $post->ID, "header_type", true );
    }

    // Google map
    if( $header_type == 'property_map' || is_page_template( 'templates/property_listing.php' )  || is_page_template( 'templates/template_agency.php' ) || is_page_template( 'templates/template_single_property.php' ) || is_page_template( 'templates/dashboard_submit_property.php' ) ){
        cityestate_google_map();
    }
    
    if( is_singular('property') ){
        cityestate_property_detail();
    }

    // Dashboard invoice or save search page
    if( is_page_template( 'templates/dashboard_invoices.php' ) || is_page_template( 'templates/dashboard_saved_search.php' ) ){
        cityestate_invoice_save_search();
    }

    // Cityestate Window on load
    cityestate_on_load();

    // Cityestate login and register
    cityestate_login_register();

    // User dashboard property list
    if( is_page_template( 'templates/dashboard_properties.php' ) || is_page_template( 'templates/template_payment.php' ) ){
        cityestate_property_payment();
    }

    // Property sort and layout
    if( is_page_template( 'templates/property_listing.php' ) || is_page_template( 'templates/template_search.php' ) || is_tax( 'property_type') || is_tax( 'property_feature' ) || is_tax( 'property_status' ) || is_tax( 'property_city' ) || is_tax( 'property_area' ) || is_tax( 'property_location' ) ){
        cityestate_property_view_sort();
    }

    // Check is user profile page
    if( is_page_template( 'templates/dashboard_profile.php' ) ){
        cityestate_user_profile();
    }

    // Check is property submit page
    if( is_page_template( 'templates/dashboard_submit_property.php' ) ){
        cityestate_submit_property();
    }

}
add_action( 'wp_enqueue_scripts', 'cityestate_add_css_script' );

// Cityestate register Fonts
if( ! function_exists( 'cityestate_fonts_url' ) ){
    
    function cityestate_fonts_url(){
        // Define variables
        $fonts_url = '';
        $fonts     = array();
        $subsets   = '';
        // Set Poppins font
        if( 'off' !== _x( 'on', 'Poppins font: on or off', 'cityestate' ) ){
            $fonts[] = 'Rubik:300,300i,400,400i,500,500i,700,700i,900,900i';
        }

        // Check is font found
        if( $fonts ){
            $fonts_url = add_query_arg( array( 'family' => urlencode( implode( '|', $fonts ) ), 'subset' => urlencode( $subsets ), ), 'https://fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
}

// Property detail page
function cityestate_property_detail(){
    
    // get property lat and long
    $property_location = get_post_meta( get_the_ID(), 'property_location', true );
    
    if( !empty($property_location) ){
        // Property lat and long
        $property_lat_lng = explode( ',', $property_location );
        
        $property_lat = $property_lat_lng[0];
        $property_lng = $property_lat_lng[1];

        // Property get direction
        $get_direction = get_post_meta( get_the_ID(), 'property_map_get_direction', true );

        // Check property get direction is active
        if( !empty($get_direction) && $get_direction == "show" ){
            $get_direction = $get_direction;
        }
    }

    $near_by_place = get_post_meta( get_the_ID(), 'near_by_place', true );

    wp_enqueue_script('google-map-info-box', get_template_directory_uri() . '/js/infobox.js', array('google-map'), '1.1.9', false);

    $google_map_pin_cluster_show = cityestate_option('google_map_pin_cluster_show');
    if( $google_map_pin_cluster_show != 'no' ) {
        wp_enqueue_script('google-map-marker-cluster', get_template_directory_uri() . '/js/markerclusterer.js', array('google-map'), '2.1.1', false);
    }

    // Property detail page
    wp_enqueue_script( 'cityestate_property_detail', get_template_directory_uri() . '/js/cityestate_property_detail.js', array('jquery') );
    wp_localize_script( 'cityestate_property_detail', 'CityEstate_property_detail',
        array(
            'admin_url'     => admin_url( 'admin-ajax.php' ),
            'property_lat'  => $property_lat,
            'property_lng'  => $property_lng,
            'KM_label'      => esc_html__( 'KM', 'cityestate' ),
            'map_style'     => cityestate_option( 'google_map_style' ),
            'infobox_close' => get_template_directory_uri() . '/images/map/close.png',
            'near_by_place' => $near_by_place,
        )
    );
}

// Cityestate google map
function cityestate_google_map(){
    
    global $post;

    // Check page is valid
    if( !is_404() && !is_search() ){
        $header_type = get_post_meta($post->ID, 'header_type', true);
        $city = get_post_meta( $post->ID, 'page_map_city', false );
    }    

    wp_enqueue_script('google-map-info-box', get_template_directory_uri() . '/js/infobox.js', array('google-map'), '1.1.9', false);

    $google_map_pin_cluster_show = cityestate_option('google_map_pin_cluster_show');
    if( $google_map_pin_cluster_show != 'no' ) {
        wp_enqueue_script('google-map-marker-cluster', get_template_directory_uri() . '/js/markerclusterer.js', array('google-map'), '2.1.1', false);
    }

    // Cityestate Ajax Calls
    wp_enqueue_script( 'cityestate_google_map', get_template_directory_uri() . '/js/cityestate_google_map.js', array('jquery') );
    wp_localize_script( 'cityestate_google_map', 'CityEstate_google_map',
        array(
            'admin_url'         => admin_url( 'admin-ajax.php' ),
            'map_style'         => cityestate_option( 'google_map_style' ),
            'map_zoom'          => cityestate_option( 'google_map_default_zoom' ),
            'infobox_close'     => get_template_directory_uri() . '/images/map/close.png',
            'cluster_icon'      => get_template_directory_uri() . '/images/map/cluster-icon.png',
            'no_found'          => esc_html__( "We didn't find any results", 'cityestate' ),
            'city'              => $city,
        )
    );
}

// User dashboard property payment
function cityestate_property_payment(){
    global $post;

    // User dashboard property payment
    wp_enqueue_script( 'cityestate_property_payment', get_template_directory_uri() . '/js/cityestate_property_payment.js', array('jquery') );
    wp_localize_script( 'cityestate_property_payment', 'CityEstate_property_payment',
        array( 
            'admin_url' => admin_url( 'admin-ajax.php' ),
            'price_position'        => cityestate_option( 'property_price_position' ),
            'paid_currency'         => cityestate_option( 'paid_currency_type' ),
            'bank_text'             => esc_html__( 'To be paid', 'cityestate' ),
            'confirm_featured_msg'  => esc_html__( 'Are you sure you want to make this a featured listing?', 'cityestate' ),            
            'featured_label'        => esc_html__( 'Featured', 'cityestate' ),
            'no_featured_left'      => esc_html__( 'You have used all the "Featured" listings in your package.', 'cityestate' ),
            'paypal_connect'        => esc_html__( 'Connecting to paypal, Please wait... ', 'cityestate' ),
            'bank_connect'          => esc_html__( 'Processing, Please wait...', 'cityestate' ),
            'bank_thanks'           => esc_html__( 'Thank you. Please check your email for payment instructions.','cityestate' ),
            'bank_title'            => esc_html__( 'Direct Payment Instructions', 'cityestate' ),
            'bank_button'           => esc_html__( 'Send me the invoice', 'cityestate' ),
            'bank_info'             => cityestate_option('wire_transfer_info'),            
            'confirm_rearrang'      => esc_html__( 'Are you sure you want to relist this property?', 'cityestate' ),
            'confirm_featured'      => esc_html__( 'Are you sure you want to make this a featured listing?', 'cityestate' ),
            'current_tempalte'      => get_page_template_slug( $post->ID ),
        ) 
    ); 
}

// Property invoice and save search page
function cityestate_invoice_save_search(){
   // Property invoice and save search page
    wp_enqueue_script( 'cityestate_invoice_save_search', get_template_directory_uri() . '/js/cityestate_invoice_save_search.js', array('jquery') );
    wp_localize_script( 'cityestate_invoice_save_search', 'CityEstate_invoice_save_search', array( 'admin_url' => admin_url( 'admin-ajax.php' ) ) ); 
}

// Login and register user
function cityestate_login_register(){
    global $post;
    // User login redirect
    $login_redirect = cityestate_option( 'after_login_redirect' );    
    if( $login_redirect == 'same_page' ){        
        // Check is taxonomy page
        if( is_tax() ){
            $login_redirect = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        } else {
            // Check is home or blog page
            if( is_home() || is_front_page() ){
                $login_redirect = site_url();
            } else {
                // Check is not 404 or search page
                if( !is_404() && !is_search() ) {
                    $login_redirect = get_permalink($post->ID);
                }
            }
        }
    } else {
        $login_redirect = cityestate_option( 'after_login_redirect_link' );
    }

    // Login and register user
    wp_enqueue_script( 'cityestate_login_register', get_template_directory_uri() . '/js/cityestate_login_register.js', array('jquery') );
    wp_localize_script( 'cityestate_login_register', 'CityEstate_login_register', array( 'admin_url' => admin_url( 'admin-ajax.php' ), 'login_redirect' => $login_redirect, 'login_process' => esc_html__( 'Sending user info, please wait...', 'cityestate' ), ) );
}

// Load for property layout and sort
function cityestate_property_view_sort(){
    
    $property_view = '';
    
    // Check is property listing template page
    if( is_page_template( 'templates/property_listing.php' ) ){
        $property_view = get_post_meta( get_the_ID(), 'list_list_view', true );
    }

    // Check is template search page
    if( is_page_template( 'templates/template_search.php' ) ){
        $property_view = cityestate_option( 'adv_sea_result_layout' );
    }

    // Check is property taxonomy page
    if( is_tax( 'property_type') || is_tax( 'property_feature' ) || is_tax( 'property_status' ) || is_tax( 'property_city' ) || is_tax( 'property_area') || is_tax( 'property_location' ) ){
        $property_view = cityestate_option( 'taxonomies_list_list_view' );        
    }

    // Property sort and layout
    wp_enqueue_script( 'cityestate_sort_layout', get_template_directory_uri() . '/js/cityestate_sort_layout.js', array('jquery') );
    wp_localize_script( 'cityestate_sort_layout', 'CityEstate_sort_layout', array( 'property_view' => $property_view ) );
}

// Cityestate call on load
function cityestate_on_load(){

    global $post, $current_user;

    wp_get_current_user();
    $user_id = $current_user->ID;

    // Retina logo
    $retina_logo            = cityestate_option( 'header_retina_logo', 'url' );
    $retina_logo_width      = cityestate_option( 'retina_logo_width' );
    $retina_logo_width      = preg_replace( '#[^0-9]#', '', strip_tags( $retina_logo_width ) );
    $retina_logo_height     = cityestate_option( 'retina_logo_height' );        
    $retina_logo_height     = preg_replace( '#[^0-9]#', '', strip_tags( $retina_logo_height ) );

    // Transparent menu and header
    $transparent_retina_logo    = cityestate_option( 'header_transparent_retina_logo','url' );
    
    // Advance search min price
    $min_price = cityestate_option( 'adv_sea_min_price' );
    if( empty( $min_price ) ) {
        $min_price = '100';
    }
    
    // Advance search max price
    $max_price = cityestate_option( 'adv_sea_max_price' );
    if( empty( $max_price ) ) {
        $max_price = '500000';
    }

    // Advance search selected min price
    $selected_min_price = ( isset($_GET['min_price'] ) ) ? $_GET['min_price'] : '' ;
    if( !isset($selected_min_price) || empty($selected_min_price) ){
        $selected_min_price = $min_price;
    } else {
        $selected_min_price = explode( ',', $selected_min_price );
        $selected_min_price = implode( '', $selected_min_price );
    }

    // Advance search selected max price
    $selected_max_price = ( isset($_GET['max_price'] ) ) ? $_GET['max_price'] : '' ;
    if( !isset($selected_max_price) || empty($selected_max_price) ){
        $selected_max_price = $max_price;
    } else {
        $selected_max_price = explode( ',', $selected_max_price );
        $selected_max_price = implode( '', $selected_max_price );
    }
    
    // Property price symbol and decimal
    $price_symbol   = cityestate_option( 'property_price_symbol' );
    $price_decimal  = cityestate_option( 'property_price_decimal_tho_sep' );

    wp_enqueue_script( 'jquery-ui-autocomplete' );    

    // Add JS in window load
    wp_enqueue_script( 'cityestate_on_load', get_template_directory_uri() . '/js/cityestate_on_load.js', array( 'jquery', 'plupload' ), CITYESTATE_THEME_VERSION, true );
    wp_localize_script( 'cityestate_on_load', 'CityEstate_on_load', 
        array( 
            'admin_url'     => admin_url( 'admin-ajax.php' ),
            'retina_logo'           => $retina_logo,
            'retina_logo_width'     => $retina_logo_width,
            'retina_logo_height'    => $retina_logo_height,

            'transparent_retina_logo' => $transparent_retina_logo,

            'min_price' => $min_price,
            'max_price' => $max_price,

            'selected_min_price' => $selected_min_price,
            'selected_max_price' => $selected_max_price,

            'price_symbol'  => $price_symbol,
            'price_decimal' => $price_decimal,

            'is_keyword_auto'       => cityestate_option( 'adv_sea_keyword_auto' ),
            'keyword_autocomplete'  => cityestate_search_keyword(),
            
            'user_id' => $user_id,
        )
    );
}

// For submit property
function cityestate_user_profile(){
    // Include plupload library
    wp_enqueue_script( 'plupload' );        
    // Include user profile js
    wp_enqueue_script( 'cityestate_user_profile', get_template_directory_uri() . '/js/cityestate_user_profile.js', array( 'jquery', 'plupload' ), CITYESTATE_THEME_VERSION, true );
    wp_localize_script( 'cityestate_user_profile', 'CityEstate_user_profile', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'upload_nonce' => wp_create_nonce( 'profile_upload' ), 'file_format' => esc_html__( 'Valid file formats', 'cityestate' ) ) );
}

// For submit property
function cityestate_submit_property(){
    // Include jQuery library
    wp_enqueue_script( 'plupload' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-geocomplete', get_template_directory_uri() . '/js/jquery.geocomplete.min.js', array('jquery'), '1.7.0', true );
    wp_enqueue_script( 'cityestate-geocomplete', get_template_directory_uri() . '/js/cityestate_geocomplete.js', array('jquery'), '1.7.0', true );
    wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '1.14.0', true );
    wp_enqueue_script( 'cityestate_submit_property', get_template_directory_uri() . '/js/cityestate_submit_property.js', array( 'jquery', 'plupload', 'jquery-ui-sortable' ), CITYESTATE_THEME_VERSION, true );

    // Submit property required field and near by place
    $require_field = cityestate_option( 'required_submit_property_field' );
    $near_by_place = cityestate_near_by_places();

    $property_data = array(
        // Property js ajax and nonce for security
        'ajaxURL'           => admin_url( 'admin-ajax.php' ),
        'property_nonce'    => wp_create_nonce( 'property_allow_upload' ),
        
        // Property upload media
        'upload_file_type'  => esc_html__( 'Valid file formats', 'cityestate' ),
        'image_limit'       => cityestate_option('property_image_limit'),
        'image_size'        => cityestate_option('property_image_size'),            
        
        // Floor plan labels
        'floor_plan_title'      => esc_html__( 'Plan Title', 'cityestate' ),
        'floor_plan_size'       => esc_html__( 'Plan Size', 'cityestate' ),
        'floor_plan_bedroom'    => esc_html__( 'Plan Bedrooms', 'cityestate' ),
        'floor_plan_bathroom'   => esc_html__( 'Plan Bathrooms', 'cityestate' ),
        'floor_plan_price'      => esc_html__( 'Plan Price', 'cityestate' ),
        'floor_plan_image'      => esc_html__( 'Plan Image', 'cityestate' ),
        'floor_plan_info'       => esc_html__( 'Plan Description', 'cityestate' ),        
        'floor_plan_upload'     => esc_html__( 'Upload', 'cityestate' ),

        // Near by place label
        'near_by_places'    => $near_by_place,
        'near_place_type'   => esc_html__( 'Place Type', 'cityestate' ),
        'near_place_icon'   => esc_html__( 'Place Icon', 'cityestate' ),
    );
    wp_localize_script( 'cityestate_submit_property', 'CityEstate_property_ajax_call', $property_data );
}

// Header custom JS
if( is_admin() ){
    function cityestate_header_scripts(){
        // Get code from backend
        $custom_js_header = cityestate_option( 'custom_js_header' );
        if( $custom_js_header != '' ){
            echo ( $custom_js_header );
        }
    }
    add_action( 'wp_head', 'cityestate_header_scripts' );
}

// Footer custom JS
if( is_admin() ){
    function cityestate_footer_scripts(){
        // Get code from backend
        $custom_js_footer = cityestate_option('custom_js_footer');
        if( $custom_js_footer != '' ){
            echo ( $custom_js_footer );
        }    
    }
    add_action( 'wp_footer', 'cityestate_footer_scripts', 100 );
}

// Include file in admin
if( is_admin() ){    
    function cityestate_admin_script_style(){        
        // Admin script for page template
        wp_enqueue_script( 'cityestate_init', get_template_directory_uri() .'/js/admin/cityestate_init.js', array( 'jquery', 'media-upload', 'thickbox' ) );
        // Admin approve wire transfer payment
        wp_enqueue_script( 'cityestate_admin_approved', get_template_directory_uri() .'/js/admin/cityestate_approved_ajax.js', array('jquery') );
        wp_localize_script( 'cityestate_admin_approved', 'CityEstate_admin_approved', array( 'ajaxurl' => admin_url('admin-ajax.php'), 'paid_status' => esc_html__( 'Paid', 'cityestate' ) ) );
        // CSS for metabox and icon
        wp_enqueue_style( 'cityestate_admin', get_template_directory_uri(). '/css/admin/cityestate_metabox.css',  '', '', 'all' );
        wp_enqueue_style( 'cityestate_icon', get_template_directory_uri(). '/css/cityestate-iconfont.css', null, null );
    }
    add_action('admin_enqueue_scripts', 'cityestate_admin_script_style');
}

?>