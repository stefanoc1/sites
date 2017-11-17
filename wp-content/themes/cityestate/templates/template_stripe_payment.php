<?php
/*
    Template Name: Stripe Charge Page
*/

// Load stripe payment library

require_once(  CITYESTATE_PATH . 'framework/stripe-php/init.php' );

// Get current user info
$current_user   = wp_get_current_user();
$user_id        = $current_user->ID;
$user_email     = $current_user->user_email;

// Get price currency
$currency           = cityestate_option( 'paid_currency_type' );

// Get thank you page link
$thankyou_page_url  = cityestate_find_template_url( 'templates/payment_thankyou.php' );

// Set payment method name
$payment_method = esc_html__( 'Stripe', 'cityestate' );

// Get current time and date
$time = time();
$date = date('Y-m-d H:i:s',$time);

// Get stripe payment method key
$secret_key = cityestate_option('stripe_secret_key');
$public_key = cityestate_option('stripe_public_key');

// Set stripe access in array
$stripe = array( 'secret_key' => $secret_key, 'publishable_key' => $public_key );

// Call stripe payment call
\Stripe\Stripe::setApiKey($stripe['secret_key']);

WP_Filesystem();
global $wp_filesystem;


// Get the url
$input = @$wp_filesystem->get_contents("php://input");

$allowed_html = array();

// Check stripe email is available
if( is_email($_POST['stripeEmail']) ){
    $stripe_email =  wp_kses ( esc_html($_POST['stripeEmail']) ,$allowed_html );
} else {
    wp_die( 'No Email Address Found!' );
}

// Check user id
if( isset($_POST['userID']) && !is_numeric( $_POST['userID'] ) ){
    die();
}

// Check payment amount
if( isset($_POST['pay_ammout']) && !is_numeric( $_POST['pay_ammout'] ) ){
    die();
}

// Check featured payment
if( isset($_POST['featured_pay']) && !is_numeric( $_POST['featured_pay'] ) ){
    die();
}

// Check upgrade payment
if( isset($_POST['is_upgrade']) && !is_numeric( $_POST['is_upgrade'] ) ){
    die();
}

// Check property id
if( isset($_POST['property_id']) && !is_numeric( $_POST['property_id'] ) ){
    die();
}

// Check submission price
if( isset($_POST['submission_pay']) && !is_numeric( $_POST['submission_pay'] ) ){
    die();
}

// Check package id
if( isset($_POST['pack_id']) && !is_numeric( $_POST['pack_id'] ) ){
    die();
}

// Check submission payment is okay
if( isset ($_POST['submission_pay'])  && $_POST['submission_pay'] == 1 ){
    try {
        // Get stripe token
        $token = wp_kses( $_POST['stripeToken'], $allowed_html );

        // Create customer class
        $customer = \Stripe\Customer::create( array( 'email' => $stripe_email, 'source' => $token ) );

        // Get user id
        $user_id = intval( $_POST['userID'] );
        
        // Get property id
        $property_id = intval( $_POST['property_id'] );
        
        // get pay price
        $pay_price = intval( $_POST['pay_ammout'] );
        
        // Declare variable
        $is_featured = 0;
        $is_upgrade  = 0;

        // Check property is featured price
        if( isset($_POST['featured_pay']) && $_POST['featured_pay'] == 1 ){
            $is_featured = intval($_POST['featured_pay']);
        }

        // Check property id upgrade price
        if( isset($_POST['is_upgrade']) && $_POST['is_upgrade'] == 1 ){
            $is_upgrade = intval($_POST['is_upgrade']);
        }

        // Stripe create payment
        $charge = \Stripe\Charge::create( array( 'amount' => $pay_price, 'customer' => $customer->id, 'currency' => $currency ) );

        // Get admin email
        $admin_email = get_bloginfo( 'admin_email' );
        
        // Check is upgrade payment
        if( $is_upgrade == 1 ){            
            // Update property status
            update_post_meta( $property_id, 'cityestate_featured', 1 );
            
            // Create invoice
            $invoice_id = cityestate_create_payment_invoice( 'Upgrade to Featured', $property_id, $date, $user_id, 0, 1, '', $payment_method );

            // Update invoice payment status
            update_post_meta( $invoice_id, 'inv_payment_status', 1 );

            // Send email to user and admin
            $args = array( 'listing_title' => get_the_title($property_id), 'listing_id'    => $property_id, 'invoice_no'    => $invoice_id );
            cityestate_send_mail( $user_email, 'paid_featured_submit_property_listing_subject', 'paid_featured_submit_property_listing_message', $args );
            cityestate_send_mail( $admin_email, 'admin_paid_featured_submit_property_listing_subject', 'admin_paid_featured_submit_property_listing_message', $args );
        } else {
            // Update property payment status
            update_post_meta( $property_id, 'cityestate_payment_status', 'paid' );

            // Get property submit type and approve by admin
            $submit_property_type   = cityestate_option( 'submit_property_type' );
            $admin_approve          = cityestate_option( 'admin_approve_submit_property' );

            // Check is per listing
            if( $admin_approve != 'yes'  && $submit_property_type == 'per_listing' ){
                // Publish property
                $property_args = array( 'ID' => $property_id, 'post_status' => 'publish' );
                wp_update_post($property_args );
            } else {
                // Pending property
                $property_args = array( 'ID' => $property_id, 'post_status' => 'pending' );
                wp_update_post($property_args );
            }

            // Check is featured property
            if( $is_featured == 1 ){
                // Update featured property status
                update_post_meta( $property_id, 'cityestate_featured', 1 );
                // Create invoice
                $invoice_id = cityestate_create_payment_invoice( 'Publish Listing with Featured', $property_id, $date, $user_id, 1, 0, '', $payment_method );
            } else {
                // Create invoice
                $invoice_id = cityestate_create_payment_invoice( 'Listing', $property_id, $date, $user_id, 0, 0, '', $payment_method );
            }
            // Update invoice payment status
            update_post_meta( $invoice_id, 'inv_payment_status', 1 );

            // Send email to user and admin
            $args = array( 'listing_title' => get_the_title($property_id), 'listing_id' => $property_id, 'invoice_no' => $invoice_id );
            cityestate_send_mail( $user_email, 'paid_submit_property_listing_subject', 'paid_submit_property_listing_message', $args );
            cityestate_send_mail( $admin_email, 'admin_paid_submit_property_listing_subject', 'admin_paid_submit_property_listing_message', $args );
        }

        wp_redirect( $thankyou_page_url ); exit;

    } catch( Exception $e ){
        // Show error report
        $error = '<div class="alert alert-danger"><strong>'.esc_html__( 'Error!', 'cityestate' ).'</strong> '.$e->getMessage().'</div>';
        print $error;
    }
} else {
    // Stripe payment for package
    try {
        // Get stripe token

        $token  = wp_kses( esc_html($_POST['stripeToken']), $allowed_html );

        // Stripe create payment
        $customer = \Stripe\Customer::create( array( 'email' => $stripe_email, 'source' => $token ) );

        // Get user id
        $user_id        = intval($_POST['userID']);
        
        // Get pay price
        $pay_price      = intval($_POST['pay_ammout']);
        
        // get package id
        $package_id     = intval($_POST['pack_id']);

        // Class stripe payment method
        $charge = \Stripe\Charge::create( array( 'amount' => $pay_price, 'customer' => $customer->id, 'currency' => $currency ) );
        
        // Update user package
        cityestate_update_user_package( $user_id );

        // Check user old package status
        if( cityestate_old_package_status( $current_user->ID, $package_id ) ){
            // User change membership
            cityestate_change_membership_package( $user_id, $package_id );
        } else {
            // User change membership
            cityestate_change_membership_package( $user_id, $package_id );
        }

        // Create invocie
        $invoice_id = cityestate_create_payment_invoice( 'package', $package_id, $date, $user_id, 0, 0, '', $payment_method );
        
        // update invoice payment status
        update_post_meta( $invoice_id, 'inv_payment_status', 1 );        

        // Send mail to user
        cityestate_send_mail( $user_email, 'purchase_is_active_subject', 'purchase_is_active_message', array() );

        // Redirect user to thank you page
        wp_redirect( $thankyou_page_url );
        exit;
    }
    catch( Exception $e ){
        // Show error report
        $error = '<div class="alert alert-danger"><strong>'.esc_html__( 'Error!', 'cityestate' ).'</strong> '.$e->getMessage().'</div>';
        print $error;
    }
}

?>