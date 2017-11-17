<?php

// Add column in testimonials list page
if( !function_exists( 'cityestate_add_customer_columns' ) ){
    
    function cityestate_add_customer_columns($columns){
        // Set column name
        $columns = array(
            'cb'                    => '<input type=\'checkbox\' />',
            'title'                 => esc_html__( 'Title', 'cityestate' ),
            'customer_name'         => esc_html__( 'Customer Name', 'cityestate' ),
            'customer_photo'        => esc_html__( 'Photo', 'cityestate' ),
            'customer_position'     => esc_html__( 'Position', 'cityestate' ),
            'customer_testimonial'  => esc_html__( 'Testimonial', 'cityestate' ),
            'date'                  => esc_html__( 'Publish Time', 'cityestate' )
        );
        return $columns;
    }
}
add_filter( 'manage_edit-ce_testimonials_columns', 'cityestate_add_customer_columns' );

// Show column in testimonials list page
if( !function_exists( 'cityestate_show_customer_data' ) ){

    function cityestate_show_customer_data($column){

        global $post;

        // Get testimonials details
        $customer_name          = get_post_meta( $post->ID, 'customer_name', true );
        $customer_photo         = get_post_meta( $post->ID, 'customer_photo', true );
        $customer_position      = get_post_meta( $post->ID, 'customer_position', true );
        $customer_testimonial   = get_post_meta( $post->ID, 'customer_text', true );

        // Check column and add in testimonials list page
        switch ($column){            
            case 'customer_name':                
                if( !empty($customer_name) ){
                    echo esc_attr( $customer_name );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'customer_photo':                
                if( !empty($customer_photo) ){
                    $customer_image = wp_get_attachment_image_src( $customer_photo );
                    if ( $customer_image ) : ?>
                        <img src="<?php echo $customer_image[0]; ?>" width="100px" height="100px" />
                    <?php endif;
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'customer_position':                
                if( !empty($customer_position) ){
                    echo esc_attr( $customer_position );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'customer_testimonial':                
                if( !empty($customer_testimonial) ){
                    echo esc_attr( wp_trim_words( $customer_testimonial, 15 ) );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;
        }
    }
}
add_action( 'manage_ce_testimonials_posts_custom_column', 'cityestate_show_customer_data' );

?>