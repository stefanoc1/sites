<?php

// Register invoice custom post type
if( !function_exists( 'cityestate_invoice_custom_post' ) ){

    function cityestate_invoice_custom_post(){
        // Set invoice custom post type label
        $labels = array(
            'name'                  => esc_html__( 'Invoices', 'cityestate' ),
            'singular_name'         => esc_html__( 'Invoice', 'cityestate' ),
            'add_new'               => esc_html__( 'Add New', 'cityestate' ),
            'add_new_item'          => esc_html__( 'Add New Invoice', 'cityestate' ),
            'edit_item'             => esc_html__( 'Edit Invoice', 'cityestate' ),
            'new_item'              => esc_html__( 'New Invoice', 'cityestate' ),
            'view_item'             => esc_html__( 'View Invoice', 'cityestate' ),
            'search_items'          => esc_html__( 'Search Invoice', 'cityestate' ),
            'not_found'             => esc_html__( 'No Invoice found', 'cityestate' ),
            'not_found_in_trash'    => esc_html__( 'No Invoice found in Trash', 'cityestate' ),
            'parent_item_colon'     => ''
        );

        // Set invoice post type compatibility
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'hierarchical'          => false,
            'menu_icon'             => 'dashicons-book',
            'supports'              => array('title'),
            'exclude_from_search'   => true,
            'can_export'            => true,
            'rewrite'               => array( 'slug' => esc_html__( 'invoice', 'cityestate' ) )
        );
        // Register agent custom post type
        register_post_type( 'cityestate_invoice', $args );
    }
    
}
add_action( 'init', 'cityestate_invoice_custom_post' );

// Add or show column in invoice list page
require_once( CITYESTATE_PATH . 'custom-post/columns/cityestate_invoice_column.php' );

?>