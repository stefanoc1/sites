<?php

// Register package custom post type
if( !function_exists( 'cityestate_package_custom_post' ) ){

    function cityestate_package_custom_post() {
        // Set package post type labels
        $labels = array(            
        	'name'          		=> esc_html__( 'Packages', 'cityestate' ),
            'singular_name' 		=> esc_html__( 'Packages', 'cityestate' ),
            'add_new'       		=> esc_html__( 'Add New Package', 'cityestate' ),
            'add_new_item'          => esc_html__( 'Add Packages', 'cityestate' ),
            'edit'                  => esc_html__( 'Edit Packages' , 'cityestate' ),
            'edit_item'             => esc_html__( 'Edit Package', 'cityestate' ),
            'new_item'              => esc_html__( 'New Packages', 'cityestate' ),
            'view'                  => esc_html__( 'View Packages', 'cityestate' ),
            'view_item'             => esc_html__( 'View Packages', 'cityestate' ),
            'search_items'          => esc_html__( 'Search Packages', 'cityestate' ),
            'not_found'             => esc_html__( 'No Packages found', 'cityestate' ),
            'not_found_in_trash'    => esc_html__( 'No Packages found', 'cityestate' ),
            'parent'                => esc_html__( 'Parent Package', 'cityestate' )
        );
        
        // Set package post type compatibility
        $args = array(
        	'labels'                => $labels,
            'public' 				=> true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
        	'query_var'             => true,
            'has_archive' 			=> true,
            'menu_icon'				=> 'dashicons-money',
            'supports' 				=> array( 'title' ),                
            'can_export' 			=> true,            
            'rewrite'               => array( 'slug' => esc_html__( 'package', 'cityestate' ) )
        );
        // Register package custom post type
        register_post_type( 'citystate_packages', $args );        
    }

}
add_action( 'init', 'cityestate_package_custom_post' );

// Add or show column in package list page
require_once( CITYESTATE_PATH . 'custom-post/columns/cityestate_package_column.php' );

?>