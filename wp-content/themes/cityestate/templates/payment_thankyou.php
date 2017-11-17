<?php
/*

Template Name: Thank you page

*/

// Get current user info
global $current_user;
wp_get_current_user();
$user_id    = $current_user->ID;
$user_email = $current_user->user_email;

// Declare html allowed array
$allowe_html = array();

// Get need information
$submit_property_type = cityestate_option( 'submit_property_type' );

// Check payment is for membership
if( $submit_property_type == 'membership' ){
    
    // Check is token is set
    if( isset($_GET['token']) ){
        // Declare variable ang get values
        $allowe_html    = array();
        $token          = wp_kses( $_GET['token'], $allowe_html );
        $payment_method = esc_html__( 'Paypal', 'cityestate' );
        
        // Get current date and time
        $time = time();
        $date = date('Y-m-d H:i:s',$time);

        // get payment data
        $save_data      = get_option( 'user_paypal_package_transfer' );
        $payment_url    = $save_data[$user_id]['payment_execute_url'];
        $token          = $save_data[$user_id]['access_token'];
        $pack_id        = $save_data[$user_id]['package_id'];
            
        // Check is payer id is available
        if( isset($_GET['payer_id']) ){
            // Get payer id and payment execute id
            $payer_id        = wp_kses( $_GET['payer_id'], $allowe_html );
            $payment_execute = array( 'payer_id' => $payer_id );

            // Payment detail in json
            $payment_json       = json_encode($payment_execute);
            $payment_json_resp  = cityestate_execute_paypal_request( $payment_url, $payment_json, $token );

            // Update user info
            $save_data[$current_user->ID] = array();
            update_option( 'user_paypal_package_transfer', $save_data );
            update_user_meta( $user_id, 'user_paypal_package', $save_data );

            // Check payment is approved
            if( $payment_json_resp['state'] == 'approved' ){
                // Change the user package and package status
                if( cityestate_old_package_status( $current_user->ID, $pack_id ) ){
                    // Change the user package
                    cityestate_user_change_package( $current_user->ID, $pack_id );
                    // Change the package status
                    cityestate_change_membership_package( $user_id, $pack_id);
                } else {
                    // Change the package status
                    cityestate_change_membership_package($user_id, $pack_id);
                }
                // Create invoice
                $invoice_id = cityestate_create_payment_invoice( 'package', $pack_id, $date, $user_id, 0, 0, '', $payment_method );
                // Update invoice statua
                update_post_meta( $invoice_id, 'inv_payment_status', 1 );

                $args = array();
                // Send mail to user for package activation
                cityestate_send_mail( $user_email, 'purchase_is_active_subject', 'purchase_is_active_message', $args );
            }
        }        
    }    
} else if( $submit_property_type == 'per_listing' ){

    // Get paypal info
    $paypal_live  = cityestate_option( 'paid_payment_type' );
    $paypal_url   = 'https://api.sandbox.paypal.com';

    // Set paypal payment mothod
    if( $paypal_live == 'live' ){
        $paypal_url = 'https://api.paypal.com';
    }

    if( isset($_GET['token']) && isset($_GET['payer_id']) ){
        // Get paypal token and payer id
        $token    = wp_kses ( $_GET['token'], $allowe_html );
        $payer_id = wp_kses ( $_GET['payer_id'] ,$allowe_html);

        // Get save info
        $tran_data           = get_option('cityestate_paypal_transfer');
        $property_id         = $tran_data[ $user_id ]['property_id'];
        $payment_url = $tran_data[ $user_id ]['payment_execute_url'];
        $token               = $tran_data[ $user_id ]['paypal_token'];
        $is_featured         = $tran_data[ $user_id ]['is_prop_featured'];
        $is_upgrade          = $tran_data[ $user_id ]['is_prop_upgrade'];

        $payment_execute = array( 'payer_id' => $payer_id );

        $paypal_json     = json_encode( $payment_execute );
        $paypal_response = cityestate_execute_paypal_request( $payment_url, $paypal_json, $token );

        $tran_data[$current_user->ID ] = array();
        update_option( 'cityestate_paypal_transfer', $tran_data );
        
        // Paypal response
        if( $paypal_response['state']=='approved' ){
            // Set paypal method name
            $payment_method = 'Paypal';

            // Get current date and time
            $time = time();
            $date = date( 'Y-m-d H:i:s', $time );

            // Get admin email id
            $admin_email =  get_bloginfo('admin_email');

            // Check payment is for upgrade property
            if( $is_upgrade == 1 ){
                // Create payment invoice
                $invoice_id = cityestate_create_payment_invoice( 'Upgrade to Featured', $property_id, $date, $user_id, 0, 1, '', $payment_method );
                
                // Update invoice and propert meta
                update_post_meta( $invoice_id, 'inv_payment_status', 1 );
                update_post_meta( $property_id, 'cityestate_featured', 1 );
                
                // Create information array for pass in email
                $args = array( 'listing_title' => get_the_title($property_id), 'listing_id' => $property_id, 'invoice_no' => $invoice_id, );

                // Send mail to admin and user
                cityestate_send_mail( $user_email, 'paid_featured_submit_property_listing_subject', 'paid_featured_submit_property_listing_message', $args );
                cityestate_send_mail( $admin_email, 'admin_paid_featured_submit_property_listing_subject', 'admin_paid_featured_submit_property_listing_message', $args );

            } else {
                // Update property payment status
                update_post_meta( $property_id, 'cityestate_payment_status', 'paid' );

                // Property need to approved by user
                $admin_approve_property = cityestate_option( 'admin_approve_submit_property' );
                if( $admin_approve_property != 'yes'  && $paid_submission_status == 'per_listing' ){
                    $property_post = array( 'ID' => $property_id, 'post_status' => 'publish' );
                    wp_update_post($property_post);
                }  else {
                    $property_post = array( 'ID' => $property_id, 'post_status' => 'pending' );
                    wp_update_post($property_post);
                }

                // Check is payment for featured property
                if( $is_featured == 1 ){
                    // Update property normal to featured
                    update_post_meta( $property_id, 'cityestate_featured', 1 );
                    // Create payment invoice
                    $invoice_id = cityestate_create_payment_invoice( 'Listing with Featured', $property_id, $date, $user_id, 1, 0, '', $payment_method );
                } else {
                    // Create payment invoice
                    $invoice_id = cityestate_create_payment_invoice( 'Listing', $property_id, $date, $user_id, 0, 0, '', $payment_method );
                }

                // Update invoice status
                update_post_meta( $invoice_id, 'inv_payment_status', 1 );
                
                // Create information array for pass in email
                $args = array( 'listing_title' => get_the_title($property_id), 'listing_id' => $property_id, 'invoice_no' => $invoice_id, );

                // Send mail to admin and user
                cityestate_send_mail( $user_email, 'paid_submit_property_listing_subject', 'paid_submit_property_listing_message', $args);
                cityestate_send_mail( $admin_email, 'admin_paid_submit_property_listing_subject', 'admin_paid_submit_property_listing_message', $args);
            }
        }
    }
}

get_header();

?>

<div class="membership-page-top">
    <div class="container">
        <!-- Show submit property process -->
        <?php get_template_part( 'template-parts/create_listing_top' ); ?>
    </div>
</div>

<div class="membership-content-area">
    <div class="container">
        <div class="membership-done-block white-block">
            <div class="done-block-inner">
                <div class="done-icon"><i class="fa fa-check"></i></div><?php
                // Check is direct pay
                if( isset( $_GET['directy_pay'] ) && $_GET['directy_pay'] != '' ){
                    // Get invoice id
                    $order_id = $_GET['directy_pay'];
                    // Get filter invoice data
                    $invoice_array = cityestate_filter_invoice_data( $order_id ); ?>
                    <!-- Show direct bank transfer title -->
                    <h2><?php echo cityestate_option( 'wire_payment_thank_you_page_title' ); ?></h2>
                    <ul style="text-align: left;">
                        <!-- Show invoice order number -->
                        <li><?php esc_html_e( 'Order Number:', 'cityestate' ); ?> <strong><?php echo esc_attr($order_id); ?></strong> </li>
                        <!-- Show  invoice date -->
                        <li><?php esc_html_e( 'Date:', 'cityestate' ); ?> <strong><?php echo get_the_date('', $order_id); ?></strong> </li>
                        <!-- Show invoice total -->
                        <li><?php esc_html_e( 'Total:', 'cityestate' ); ?> <strong><?php echo cityestate_get_invoice_price( $invoice_array['inv_price'] ); ?></strong></li>
                        <!-- Show invoice payment method -->
                        <li><?php esc_html_e( 'Payment Method:', 'cityestate' ); ?>
                            <strong>
                                <!-- Check is direct pay to bank -->
                                <?php if( $invoice_array['inv_payment'] == 'Direct Transfer To Bank ' ) {
                                    esc_html_e( 'Direct Transfer To Bank ', 'cityestate' );
                                } else {
                                    echo esc_html($invoice_array['inv_payment']);
                                } ?>
                            </strong>
                        </li>
                    </ul>
                    <!-- Show direct pay next step information -->
                    <p><?php echo cityestate_option( 'wire_payment_thank_you_page_info' ); ?></p>
                <?php
                } else {
                    echo '<h2>';
                    // Show thank you page title
                    echo cityestate_option( 'payment_thank_you_page_title' );
                    echo '</h2>';
                    echo '<p>';
                    // Show thank you page information
                    echo cityestate_option( 'payment_thank_you_page_info' );
                    echo '</p>';
                }
                // Get user profile link and set profile page link
                $user_profile_page = cityestate_user_profile_page(); ?>
                <a href="<?php echo esc_url( $user_profile_page ); ?>" class="btn btn-primary btn-long"> <?php esc_html_e( 'Go to Dashboard', 'cityestate' ); ?> </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
