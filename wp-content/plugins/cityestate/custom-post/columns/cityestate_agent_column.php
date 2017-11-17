<?php

// Add column in agent list page
if( !function_exists( 'cityestate_add_agent_column' ) ){
    
    function cityestate_add_agent_column($columns){
        // Set column name
        $columns = array(
            'cb'            => '<input type=\'checkbox\' />',
            'title'         => esc_html__( 'Name', 'cityestate' ),
            'photo'         => esc_html__( 'Photo', 'cityestate' ),
            'position'      => esc_html__( 'Position', 'cityestate' ),
            'company_name'  => esc_html__( 'Company', 'cityestate' ),
            'email_address' => esc_html__( 'Email ID', 'cityestate' ),
            'date'          => esc_html__( 'Publish Time', 'cityestate' )
        );
        return $columns;
    }
}
add_filter( 'manage_edit-cityestate_agent_columns', 'cityestate_add_agent_column' );

// Show column in agent list page
if( !function_exists( 'cityestate_show_agent_column' ) ){

    function cityestate_show_agent_column($column){

        global $post;
        
        // Get agent details
        $agent_company  = get_post_meta( $post->ID, 'agent_company', true );
        $agent_position = get_post_meta( $post->ID, 'agent_position', true );
        $agent_email    = get_post_meta( $post->ID, 'agent_email', true );

        // Check column and add in agent list page
        switch ($column){
            case 'photo':
                if( has_post_thumbnail($post->ID) ){ ?>
                    <a href="<?php the_permalink(); ?>" target="_blank" ><?php the_post_thumbnail( array( 100, 100 ) ); ?></a><?php
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'position':
                if( !empty($agent_position) ){
                    echo esc_attr( $agent_position );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'company_name':                
                if( !empty($agent_company) ){
                    echo esc_attr( $agent_company );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'email_address':
                if( !empty($agent_email) ){
                    echo esc_attr( $agent_email );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;            
        }
    }
}
add_action( 'manage_cityestate_agent_posts_custom_column', 'cityestate_show_agent_column' );

?>