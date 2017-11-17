<?php

// Register agent custom post type
if( !function_exists( 'cityestate_agent_custom_post' ) ){

    function cityestate_agent_custom_post(){
        // Set agent post type labels
        $labels = array(
            'name'                  => esc_html__( 'Agents', 'cityestate' ),
            'singular_name'         => esc_html__( 'Agent', 'cityestate' ),
            'add_new'               => esc_html__( 'Add New', 'cityestate' ),
            'add_new_item'          => esc_html__( 'Add New Agent', 'cityestate' ),
            'edit_item'             => esc_html__( 'Edit Agent', 'cityestate' ),
            'new_item'              => esc_html__( 'New Agent', 'cityestate' ),
            'view_item'             => esc_html__( 'View Agent', 'cityestate' ),
            'search_items'          => esc_html__( 'Search Agent', 'cityestate' ),
            'not_found'             => esc_html__( 'No Agent found', 'cityestate' ),
            'not_found_in_trash'    => esc_html__( 'No Agent found in Trash', 'cityestate' ),
        );

        // Set agent post type compatibility
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
            'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
            'rewrite'               => array( 'slug' => esc_html__( 'agent', 'cityestate' ) ),
            'show_in_nav_menus' => true,
        );
        // Register agent custom post type
        register_post_type( 'cityestate_agent', $args );
    }

}
add_action( 'init', 'cityestate_agent_custom_post' );

// Add or show column in agent list page
require_once( CITYESTATE_PATH . 'custom-post/columns/cityestate_agent_column.php' );

?>