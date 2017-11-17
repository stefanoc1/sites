<?php

// Register property custom post type
if( !function_exists( 'cityestate_property_custom_post' ) ){

    function cityestate_property_custom_post(){
        // Set property post type labels
        $labels = array(
              'name'                  => esc_html__( 'Properties', 'cityestate' ),
              'singular_name'         => esc_html__( 'Property', 'cityestate'  ),
              'add_new'               => esc_html__( 'Add New', 'cityestate' ),
              'add_new_item'          => esc_html__( 'Add New Property', 'cityestate' ),
              'edit_item'             => esc_html__( 'Edit Property', 'cityestate' ),
              'new_item'              => esc_html__( 'New Property', 'cityestate' ),
              'view_item'             => esc_html__( 'View Property', 'cityestate' ),
              'search_items'          => esc_html__( 'Search Property', 'cityestate' ),
              'not_found'             => esc_html__( 'No Property found', 'cityestate' ),
              'not_found_in_trash'    => esc_html__( 'No Property found in Trash', 'cityestate' ),
              'parent_item_colon'     => ''
        );

        // Set property post type compatibility
        $args = array(
              'labels'                => $labels,
              'public'                => true,
              'publicly_queryable'    => true,
              'show_ui'               => true,
              'query_var'             => true,
              'has_archive'           => true,
              'capability_type'       => 'post',
              'hierarchical'          => true,
              'menu_icon'             => 'dashicons-building',
              'can_export'            => true,
              'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'author', 'page-attributes', 'excerpt' ),
              'rewrite'               => array( 'slug' => 'property' ),
              'show_in_nav_menus' => true,
        );
        // Register property custom post type
        register_post_type('property',$args);
      }

}
add_action( 'init', 'cityestate_property_custom_post' );

// Add or show column in property list page
require_once( CITYESTATE_PATH . 'custom-post/columns/cityestate_property_column.php' );

?>