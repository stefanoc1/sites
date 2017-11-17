<?php 
// Get invoice field using invoice id
$invoice_meta = cityestate_filter_invoice_data( get_the_ID() ); ?>
<tr>	
	<!-- Invoice title -->
	<td><?php printf( esc_html__( '%s', 'cityestate' ), get_the_title() ); ?></td>
	<!-- Invoice date -->
	<td><?php echo get_the_date(); ?></td>
	<!-- Invoice billing method -->
	<td><?php 
		if( $invoice_meta['inv_billing_for'] != 'package' && $invoice_meta['inv_billing_for'] != 'Package' ){
			echo get_the_title( get_the_ID() );
		} else {
			echo get_the_title( $invoice_meta['inv_number'] );
		} ?>
	</td>
	<!-- Invoice billing status -->
	<td><?php
        $invoice_status = get_post_meta( get_the_ID(), 'inv_payment_status', true );
        if( $invoice_status == 0 ){
            echo esc_html__( 'Not Paid', 'cityestate' );
        } else {
            echo esc_html__( 'Paid', 'cityestate' );
        } ?>
    </td>
    <!-- Invoice price -->
	<td><?php echo cityestate_get_invoice_price( $invoice_meta['inv_price'] ); ?></td>
</tr>