<?php
// Add column in invoice list page
if( !function_exists( 'cityestate_add_invoice_columns' ) ){

    function cityestate_add_invoice_columns($columns){

        $columns = array(
            'cb'                => '<input type=\'checkbox\' />',
            'title'             => esc_html__( 'Invoice Title', 'cityestate' ),
            'inv_price'         => esc_html__( 'Price', 'cityestate' ),
            'inv_payment'       => esc_html__( 'Payment Method', 'cityestate' ),
            'inv_buyer'         => esc_html__( 'Buyer', 'cityestate' ),
            'inv_billing_for'   => esc_html__( 'Billion For', 'cityestate' ),            
            'inv_status'        => esc_html__( 'Status', 'cityestate' ),
            'date'              => esc_html__( 'Date', 'cityestate' )
        );

        return $columns;
    }
}
add_filter( "manage_edit-cityestate_invoice_columns", "cityestate_add_invoice_columns" );

// Show column in invoice list page
if( !function_exists( 'cityestate_show_invoice_columns' ) ){

    function cityestate_show_invoice_columns($column){
        
        global $post;

        // Get invoice details
        $invoice_meta   = get_post_meta( $post->ID, 'cityestate_inv_detail', true );
        $inv_status     = get_post_meta( $post->ID, 'inv_payment_status', true );

        // Check column and add in invoice list page
        switch ($column){
            
            case 'inv_price':
                echo esc_attr( $invoice_meta['inv_price'] );
            break;

            case 'inv_payment':
                if( $invoice_meta['inv_payment'] == 'Direct Transfer To Bank ' ){
                    esc_html_e( 'Direct Transfer To Bank ', 'cityestate' );
                } else {
                    echo $invoice_meta['inv_payment'];
                }
            break;

            case 'inv_billing_for':
                echo esc_attr( $invoice_meta['inv_billing_for'] );
            break;

            case 'inv_buyer':
                $user_info = get_userdata( $invoice_meta['inv_buyer_number'] );
                echo esc_attr( $user_info->display_name );
            break;

            case 'inv_status':
                if( $inv_status == 0 ){
                    echo '<span class="status_not_dont">'.esc_html__( 'Not Paid', 'cityestate' ).'</span>';
                } else {
                    echo '<span class="status_done">'.esc_html__( 'Paid', 'cityestate' ).'</span>';
                }
            break;
        }
    }
}
add_action( 'manage_cityestate_invoice_posts_custom_column', 'cityestate_show_invoice_columns' );

?>