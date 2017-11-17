<?php

// Add column in package list page
if( !function_exists( 'cityestate_add_package_column' ) ){
    
    function cityestate_add_package_column($columns){
        // Set column name
        $columns = array(
            'cb'               => '<input type=\'checkbox\' />',
            'title'            => esc_html__( 'Name', 'cityestate' ),
            'package_time'     => esc_html__( 'Package Time', 'cityestate' ),
            'package_list'     => esc_html__( 'Listings', 'cityestate' ),
            'package_featured' => esc_html__( 'Featured Listings', 'cityestate' ),
            'package_price'    => esc_html__( 'Price', 'cityestate' ),
            'package_show'     => esc_html__( 'Visible', 'cityestate' ),            
            'date'             => esc_html__( 'Publish Time', 'cityestate' )
        );
        return $columns;
    }
}
add_filter( 'manage_edit-citystate_packages_columns', 'cityestate_add_package_column' );

// Show column in package list page
if( !function_exists( 'cityestate_show_package_column' ) ){

    function cityestate_show_package_column($column){

        global $post;
        
        // Get package details
        $package_time      = get_post_meta( $post->ID, 'package_time', true );
        $package_list      = get_post_meta( $post->ID, 'package_list', true );
        $package_featured  = get_post_meta( $post->ID, 'package_featured', true );
        $package_price     = get_post_meta( $post->ID, 'package_price', true );
        $package_show      = get_post_meta( $post->ID, 'package_show', true );

        // Check column and add in package list page
        switch ($column){
            case 'package_time':
                if( !empty($package_time) ){
                    echo esc_attr( $package_time );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'package_list':
                if( !empty($package_list) ){
                    echo esc_attr( $package_list );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'package_featured':                
                if( !empty($package_featured) ){
                    echo esc_attr( $package_featured );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'package_price':
                if( !empty($package_price) ){
                    echo esc_attr( $package_price );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'package_show':
                if( !empty($package_show) ){
                    echo esc_attr( ucfirst( $package_show ) );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;                        
        }
    }
}
add_action( 'manage_citystate_packages_posts_custom_column', 'cityestate_show_package_column' );

?>