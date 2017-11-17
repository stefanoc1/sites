<?php
/**
 * Cityestate functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cityestate
 * @since Cityestate 1.0
 * @author Vishal Patel
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Define constants
define( 'CITYESTATE_THEME_NAME', 'cityesate' );
define( 'CITYESTATE_THEME_SLUG', 'cityestate' );
define( 'CITYESTATE_THEME_VERSION', '1.0' );

// Set up theme default and register various supported features.
if( !function_exists( 'cityestate_setup' ) ){

	function cityestate_setup(){

		// Make the theme available for translation.
		load_theme_textdomain( 'cityestate', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Add support for post thumbnails.
		add_theme_support( 'post-thumbnails' );

		// Set port default thumbnails
		set_post_thumbnail_size( 150, 150 );
		
		// Author, Agents list, Agent detail
		add_image_size( 'cityestate_image_265_260', 265, 260, true );
		
		// Property list slider
		add_image_size( 'cityestate_property_thumb', 385, 260, true );
		
		// Latest Property Widget
		add_image_size( 'cityestate_property_small', 105, 85, true );
		
		// Latest property in widget
		add_image_size( 'cityestate_widget_property', 150, 110, true );
		
		// Popup window in map
		add_image_size( 'cityestate_property_thumb_view', 305, 190, true );
		
		// Property Detail
		add_image_size( 'cityestate_property_slider_image', 1440, 610, true );
		
		// Register nav menus
		register_nav_menus(
			array(
				'main-menu' 	=> esc_html__( 'Main Menu', 'cityestate' ),
				'top-menu' 		=> esc_html__( 'Top Menu', 'cityestate' ),
				'footer-menu' 	=> esc_html__( 'Footer Menu', 'cityestate' )
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Enable support for Post Formats.
		// See https://developer.wordpress.org/themes/functionality/post-formats/
		add_theme_support('post-formats', array( 'aside', 'gallery', 'link', 'quote', 'image', 'video', 'audio' ) );

		// Remove gallery style css
		add_filter( 'use_default_gallery_style', '__return_false' );		
	}
	add_action( 'after_setup_theme', 'cityestate_setup' );
}

// Set up the content width value based on the theme's design.
if( !function_exists('cityestate_content_width') ){
	
	function cityestate_content_width(){
		$GLOBALS['content_width'] = apply_filters( 'cityestate_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'cityestate_content_width', 0 );

}

// Enqueue scripts, styles and fonts.
require_once( get_template_directory() . '/inc/cityestate/includes/register_style_script_font.php' );

// TMG plugin activation
require_once( get_template_directory() . '/inc/cityestate/frame-work/tgm/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/inc/cityestate/frame-work/tgm/register_plugins.php' );

// Visual composer
if( is_plugin_active( 'js_composer/js_composer.php' ) && is_plugin_active( 'cityestate/cityestate_theme_functionality.php' ) ){
	// Check visual composer is exits
	if( !function_exists('cityestate_include_composer') ){
		function cityestate_include_composer(){
			// Include visual composer custom elements
			require_once( get_template_directory() . '/inc/cityestate/frame-work/visualcomposer/init.php' );
		}
		add_action( 'init', 'cityestate_include_composer', 9999 );
	}
}

// Login or register user
require_once( get_template_directory() . '/inc/cityestate/frame-work/login-register/login_register.php' );


require_once( get_template_directory() . '/inc/cityestate/frame-work/theme-options/get_option.php' );

// Check redux framework is available
if( class_exists( 'ReduxFramework' ) ){
	// Include theme option
	require_once( get_template_directory() . '/inc/cityestate/frame-work/theme-options/option_set.php' );
	// Include inline style
	require_once( get_template_directory() . '/inc/style_options.php' );
	// Include demo data
	require_once( get_template_directory() . '/inc/cityestate/frame-work/theme-options/import-demo-data/import_demo_data.php' );
	require_once get_template_directory() . '/inc/cityestate/frame-work/theme-options/import-demo-data/extensions/cityestate-extend-demo.php';
}

// Cityestate include function files
require_once( get_template_directory() . '/inc/cityestate/functions/cityestate_label.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/helper_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/price_helper_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/taxonomy_helper_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/headers/add_favicon.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/property/search_property_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/property/property_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/agent/email_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/profile_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/email_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/property/submit_property_function.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/schedule_function.php' );

// Cityestate widget files include
require_once( get_template_directory() . '/inc/cityestate/functions/widgets/latest_posts.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/widgets/property_category.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/widgets/advance_search_filter.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/widgets/contact_agent_of_property.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/widgets/featured_property.php' );
require_once( get_template_directory() . '/inc/cityestate/functions/widgets/latest_property.php' );

// Register blog sidebar, footer and custom sidebar
if( !function_exists('cityestate_widgets_init') ){

	add_action( 'widgets_init', 'cityestate_widgets_init' );

	function cityestate_widgets_init(){
		// Register right sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Right Sidebar', 'cityestate' ),
			'id' 			=> 'right-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in the right sidebar.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register left sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Left Sidebar', 'cityestate' ),
			'id' 			=> 'left-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in the left sidebar.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register property listing sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Property Listings', 'cityestate' ),
			'id' 			=> 'property-listing',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in property listings sidebar.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register single property sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Single Property', 'cityestate' ),
			'id' 			=> 'single-property',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in single property sidebar.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register agent sidenar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Agent Sidebar', 'cityestate' ),
			'id' 			=> 'agent-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in agents template and angent detail page.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register search sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Search Sidebar', 'cityestate' ),
			'id' 			=> 'search-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in search result page.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Regsiter page sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Page Sidebar', 'cityestate' ),
			'id' 			=> 'page-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in page sidebar.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register IDX sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'IDX Sidebar', 'cityestate' ),
			'id' 			=> 'idx-sidebar',
			'description' 	=> esc_html__( 'Widgets in this area will be shown in idx template sidebar.', 'cityestate' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-top"><h3 class="widget-title">',
			'after_title' 	=> '</h3></div>',
		) );

		// Register footer section 1 sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Section 1', 'cityestate' ),
			'id'            => 'footer-section-1',
			'description'   => esc_html__( 'Appears in footer section 1', 'cityestate' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
		) );
		
		// Register footer section 2 sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Section 2', 'cityestate' ),
			'id'            => 'footer-section-2',
			'description'   => esc_html__( 'Appears in footer section 2', 'cityestate' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
		) );
		
		// Register footer section 3 sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Section 3', 'cityestate' ),
			'id'            => 'footer-section-3',
			'description'   => esc_html__( 'Appears in footer section 3', 'cityestate' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
		) );
		
		// Register footer section 4 sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Section 4', 'cityestate' ),
			'id'            => 'footer-section-4',
			'description'   => esc_html__( 'Appears in footer section 4', 'cityestate' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="footer-title">',
			'after_title'   => '</h2>',
		) );
	}
}

// Admin bar in another user
if( !current_user_can( 'manage_options' ) ){
	show_admin_bar( false );
}

// visual composer set as theme
if( !function_exists('cityestate_VCSetAsTheme') ){	
	function cityestate_VCSetAsTheme(){
		vc_set_as_theme($disable_updater = false);
	}
	add_action('vc_before_init', 'cityestate_VCSetAsTheme');	
}

?>