<?php

// Load invoice custom post metabox
add_action( 'load-post.php', 'cityestate_add_show_invoice_metabox' );
add_action( 'load-post-new.php', 'cityestate_add_show_invoice_metabox' );

// Add or show invoice metabox
if( !function_exists( 'cityestate_add_show_invoice_metabox' ) ){
	
	function cityestate_add_show_invoice_metabox(){		
		global $typenow;
		$paid_submission_type = cityestate_option( 'submit_property_type' );
		// Get submission type
		if( $typenow == 'cityestate_invoice' ){
			add_action( 'add_meta_boxes', 'cityestate_load_invoices_metaboxes' );
			add_action( 'save_post', 'cityestate_save_invoices_metaboxes', 10, 2 );
		}		
	}
}


// Add invoices metaboxes
if( !function_exists( 'cityestate_load_invoices_metaboxes' ) ){	
	function cityestate_load_invoices_metaboxes(){
		add_meta_box( 'cityestate_invoice_metaboxes', esc_html__( 'Invoice Info', 'cityestate' ), 'cityestate_invoice_metabox', array( 'cityestate_invoice' ), 'normal', 'default' );
		add_meta_box( 'cityestate_invoice_payment', esc_html__( 'Payment Status', 'cityestate' ), 'cityestate_invoice_payment_metabox', array( 'cityestate_invoice' ), 'side', 'high' );
	}

}

// Get invoice meta info using invoice id
function cityestate_invoice_meta( $invoice_id, $field = false ){
	// Set invoice columns
    $defaults = array(
        'inv_number' 		=> '',
        'inv_billing_for' 	=> '',
        'inv_payment' 		=> '',
        'inv_price' 		=> '',        
        'inv_date' 			=> '',
        'inv_buyer_number' 	=> ''
    );
    // Get current invoice column
    $invoice_meta = get_post_meta( $invoice_id, 'cityestate_inv_detail', true );
    $invoice_meta = wp_parse_args( (array) $invoice_meta, $defaults );

    // Check the field status
    if( $field ){        
        if( isset( $invoice_meta[$field] ) ){
            return $invoice_meta[$field];
        } else {
            return false;
        }
    }
    return $invoice_meta;
}

// Show invoice metabox
if( !function_exists( 'cityestate_invoice_metabox' ) ){

	function cityestate_invoice_metabox( $invoice ){
		// Get invoice detail
		$invoice_meta = cityestate_invoice_meta( $invoice->ID );
		
		// Get invoie billion detail
		$inv_billing_for = $invoice_meta['inv_billing_for'];
		
		$shop_type = 0;
		// Check the invoice type
		if( $inv_billing_for == 'Listing' ){
			$shop_type = 1;
		} else if( $inv_billing_for == 'Upgrade to Featured' ){
			$shop_type = 2;
		} else if( $inv_billing_for == 'Publish Listing with Featured' ){
			$shop_type = 3;
		} 

		// Get invoice status
		$invoice_status = get_post_meta( $invoice->ID, 'inv_payment_status', true );		

		// Check the invoice status
		if( $invoice_status == 0 ){ ?>
		<div class="cityestate_invoice_info"><?php
			if( $inv_billing_for == 'package' || $inv_billing_for == 'Package' ){
				print '<div id="cityestate_admin_approve_package" data-item="'.esc_attr($invoice_meta['inv_number']).'" data-id="'.$invoice->ID.'">'.esc_html__( 'Wire Payment Received - Activate the purchase', 'cityestate' ).'</div>';
			} else {
				print '<div id="cityestate_admin_approve_list" data-item="'.esc_attr($invoice_meta['inv_number']).'" data-id="'.$invoice->ID.'" data-type="'.$shop_type.'">'.esc_html__( 'Wire Payment Received - Activate the purchase', 'cityestate' ).'</div>';
			} ?>
		</div>
		<?php } ?>

		<!-- Invoice id -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Invoice ID :', 'cityestate' ); ?></p>
			<div><?php echo $invoice->ID; ?></div>
		</div>

		<!-- Invoice billing info -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Billing For :', 'cityestate' ); ?></p>
			<div>
				<?php echo esc_attr( $invoice_meta['inv_billing_for'] ); ?>
				<input type="hidden" name="cityestate_invoice[inv_billing_for]" value="<?php echo esc_attr($invoice_meta['inv_billing_for']); ?>" />
			</div>
		</div>

		<!-- Invoice payment method detail -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Payment Method:', 'cityestate' ); ?></span></p>
			<div><?php echo esc_attr( $invoice_meta['inv_payment'] ); ?></div>
		</div>

		<!-- Invoice package or list id info -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Item ID ( Listing or Package id ):', 'cityestate' ); ?></span></p>
			<div><input type="text" name="cityestate_invoice[inv_number]" value="<?php echo esc_attr($invoice_meta['inv_number']); ?>" /></div>
		</div>

		<!-- Invoice package or list price -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Item Price:', 'cityestate' ); ?></span></p>
			<div><input type="text" name="cityestate_invoice[inv_price]" value="<?php echo esc_attr($invoice_meta['inv_price']); ?>" /></div>
		</div>

		<!-- Invoice date -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Purchase Date:', 'cityestate' ); ?></span></p>
			<div><input type="text" name="cityestate_invoice[inv_date]" value="<?php echo esc_attr($invoice_meta['inv_date']); ?>" /></div>
		</div>

		<!-- Invoice email address -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Email Address:', 'cityestate' ); ?></span></p>
			<?php $customer_detail = get_userdata( $invoice_meta['inv_buyer_number'] ); ?>
			<div><?php echo esc_attr($customer_detail->user_email); ?></div>
		</div>

		<!-- Invoice customer or buyer name -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'Username ( Buyer Name ):', 'cityestate' ); ?></span></p>
			<div><?php echo esc_attr( $customer_detail->display_name ); ?></div>
		</div>

		<!-- Invoice userid -->
		<div class="cityestate_invoice_info">
			<p><?php esc_html_e( 'User ID ( Buyer ):', 'cityestate' ); ?></span></p>
			<div><input type="text" name="cityestate_invoice[inv_buyer_number]" value="<?php echo esc_attr($invoice_meta['inv_buyer_number']); ?>" /></div>
		</div><?php		
	}

}

// Show invoice payment metabox
if( !function_exists('cityestate_invoice_payment_metabox') ){

	function cityestate_invoice_payment_metabox( $invoice ){ ?>
		<div class="cityestate_invoice_meta"><?php
			// Get payment status
			$invoice_status = get_post_meta( $invoice->ID, 'inv_payment_status', true );
			if( $invoice_status != 0 ){
				echo '<span class="status_done">'.esc_html__( 'Paid','cityestate' ).'</span>';				
			} else {
				echo '<span class="status_not_dont">'.esc_html__( 'Not Paid','cityestate' ).'</span>';
			} ?>
		</div><?php
	}
}

// Save invoice metabox
if( !function_exists( 'cityestate_save_invoices_metaboxes' ) ){
	
	function cityestate_save_invoices_metaboxes( $invoice_id, $post ){

		// Return if have auto save mode
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
			return;
		}
		
		// Save invoice detail
		if( $post->post_type == 'cityestate_invoice' && isset( $_POST['cityestate_invoice'] ) ){
			// Get post type
			$post_type = get_post_type_object( $post->post_type );
			
			// Check invoice field status
			$invoice_meta 	  = array();
			$inv_buyer_number = isset( $_POST['cityestate_invoice']['inv_buyer_number'] ) ? $_POST['cityestate_invoice']['inv_buyer_number'] : '';
			$inv_billing_for  = isset( $_POST['cityestate_invoice']['inv_billing_for'] ) ? $_POST['cityestate_invoice']['inv_billing_for'] : '';
			
			// Update Invoice Data
			$invoice_meta['inv_number'] 		= isset( $_POST['cityestate_invoice']['inv_number'] ) ? $_POST['cityestate_invoice']['inv_number'] : '';
			$invoice_meta['inv_price'] 			= isset( $_POST['cityestate_invoice']['inv_price'] ) ? $_POST['cityestate_invoice']['inv_price'] : '';
			$invoice_meta['inv_date'] 			= isset( $_POST['cityestate_invoice']['inv_date'] ) ? $_POST['cityestate_invoice']['inv_date'] : '';
			$invoice_meta['inv_billing_for'] 	= isset( $_POST['cityestate_invoice']['inv_billing_for'] ) ? $_POST['cityestate_invoice']['inv_billing_for'] : '';			
			$invoice_meta['inv_buyer_number'] 	= isset( $_POST['cityestate_invoice']['inv_buyer_number'] ) ? $_POST['cityestate_invoice']['inv_buyer_number'] : '';

			// Update or save extra invoice detial for search invoice in user dashboard
			update_post_meta( $invoice_id, 'cityestate_inv_detail', $invoice_meta );
			update_post_meta( $invoice_id, 'cityestate_inv_buyer', $inv_buyer_number );			
			update_post_meta( $invoice_id, 'cityestate_inv_for', $inv_billing_for );
		}
	}
} 

?>