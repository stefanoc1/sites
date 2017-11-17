<?php

// Register testimonials custom post type
if( !function_exists( 'cityestate_testimonial_custom_post' ) ){

    function cityestate_testimonial_custom_post(){
        // Set testimonials post type labels
        $labels = array(
            'name'                  => esc_html__( 'Testimonial', 'cityestate' ),
            'singular_name'         => esc_html__( 'Testimonial', 'cityestate' ),
            'add_new'               => esc_html__( 'Add New', 'cityestate' ),
            'add_new_item'          => esc_html__( 'Add New Testimonial', 'cityestate' ),
            'edit_item'             => esc_html__( 'Edit Testimonial', 'cityestate' ),
            'new_item'              => esc_html__( 'New Testimonial', 'cityestate' ),
            'view_item'             => esc_html__( 'View Testimonial', 'cityestate' ),
            'search_items'          => esc_html__( 'Search Testimonial', 'cityestate' ),
            'not_found'             => esc_html__( 'No Testimonial found', 'cityestate' ),
            'not_found_in_trash'    => esc_html__( 'No Testimonial found in Trash', 'cityestate' ),
            'parent_item_colon'     => ''
        );

        // Set testimonials post type compatibility
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'hierarchical'          => false,
            'menu_icon'             => 'dashicons-businessman',
            'menu_position'         => 14,
            'supports'              => array( 'title', 'page-attributes', 'revisions' ),
            'rewrite'               => array( 'slug' => esc_html__( 'testimonials', 'cityestate' ) ),
            'show_in_nav_menus' => true,
        );
        // Register testimonials custom post type
        register_post_type( 'ce_testimonials', $args );
    }

}
add_action( 'init', 'cityestate_testimonial_custom_post' );

// Add or show column in testimonial list page
require_once( CITYESTATE_PATH . 'custom-post/columns/cityestate_testi_column.php' );

?>