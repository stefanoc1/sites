<?php

// Check user membership status
if( !function_exists('cityestate_user_active_membership') ){

    function cityestate_user_active_membership( $user_id ){
        // Get user package detail
        $active_package = get_the_author_meta( 'package_id', $user_id );
        $active_listing = get_the_author_meta( 'package_list', $user_id );

        // Check user package condition
        if( !empty( $active_package ) && ( $active_listing != 0 || $active_listing != '' ) ){
            return true;
        }        
        return false;
    }
}

// Get paypal payment method access token
if( !function_exists('cityestate_paypal_access_token') ){

    function cityestate_paypal_access_token( $url, $post_args ){
        // Get paypal id and secret ket
        $client_id   = cityestate_option( 'paypal_client_id' );
        $secret_id   = cityestate_option( 'paypal_client_secret_key' );

        // Set paypal curl
        $curl = curl_init( $url );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $client_id . ":" . $secret_id);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_args );
        $paypal_response = curl_exec( $curl );

        // Check paypal responce
        if( empty($paypal_response) ){
            die(curl_error($curl));
            curl_close($curl);
        } else {
            // Get paypal connection info
            $paypal_info = curl_getinfo($curl);
            curl_close($curl);

            // Checl paypal http code
            if( $paypal_info['http_code'] != 200 && $paypal_info['http_code'] != 201 ){
                // Show paypal connection error
                printf( 'Received Error: %s', 'cityestate', $paypal_info['http_code'] );
                printf( 'Raw Response: %s', 'cityestate', $paypal_response );
                die();
            }
        }
        // Return paypal response
        $paypal_response = json_decode( $paypal_response );
        return $paypal_response->access_token;
    }
}

// Paypal execute the payment
if( !function_exists('cityestate_execute_paypal_request') ){

    function cityestate_execute_paypal_request( $url, $jsonData, $access_token ){
        // Set curl
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '.$access_token, 'Accept: application/json', 'Content-Type: application/json' ));
    
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        $paypal_response = curl_exec( $curl );

        // Check paypal response is return
        if( empty($paypal_response) ){
            die(curl_error($curl));
            curl_close($curl);
        } else {
            // Get paypal info
            $paypal_info = curl_getinfo($curl);
            curl_close($curl);

            // Check paypal http code status
            if( $paypal_info['http_code'] != 200 && $paypal_info['http_code'] != 201 ){
                // Show paypal response
                printf( 'Received Error: %s', 'cityestate', $paypal_info['http_code'] );
                printf( 'Raw Response: %s', 'cityestate', $paypal_response );
                die();
            }
        }
        // Return paypal response
        $paypal_response = json_decode($paypal_response, TRUE);
        return $paypal_response;
    }
}

// Stripe payment method for package payment
if( !function_exists('cityestate_stripe_payment_membership') ){
    
    function cityestate_stripe_payment_membership( $package_id, $package_price, $package_title ) {
        // Include stripe library
        require_once( get_template_directory() . '/inc/cityestate/frame-work/stripe-php/init.php' );
        
        // Get current user info
        $current_user = wp_get_current_user();
        $user_id    = $current_user->ID;
        $user_login = $current_user->user_login;
        $user_email = get_the_author_meta( 'user_email', $user_id );
        
        // Get stripe secret and public key
        $secret_key = cityestate_option( 'stripe_secret_key' );
        $public_key = cityestate_option( 'stripe_public_key' );

        // Get payment currency and set package price
        $submission_currency        = cityestate_option('paid_currency_type');
        $package_price_for_stripe   = $package_price * 100;

        // Create array with stripe keys
        $stripe = array( 'secret_key' => $secret_key, 'publishable_key' => $public_key );

        // Call stripe payment library
        \Stripe\Stripe::setApiKey($stripe['secret_key']);        

        // Load stripe payment modal
        print '
            <div class="cityestate_stripe_membership " id="'.sanitize_title($package_title).'">
                <script src="https://checkout.stripe.com/checkout.js" id="stripe_script"
                class="stripe-button"
                data-key="'. $public_key.'"
                data-amount="'.$package_price_for_stripe.'"
                data-email="'.$user_email.'"
                data-currency="'.$submission_currency.'"
                data-zip-code="true"
                data-billing-address="true"
                data-label="'.esc_html__( 'Pay with Credit Card', 'cityestate' ).'"
                data-description="'.$package_title.' '.esc_html__( 'Package Payment','cityestate' ).'">
                </script>
            </div>
            <input type="hidden" id="pack_id" name="pack_id" value="'.esc_attr($package_id).'">
            <input type="hidden" name="userID" value="'.esc_attr($user_id).'">
            <input type="hidden" id="pay_ammout" name="pay_ammout" value="'.esc_attr($package_price_for_stripe).'">';
    }
}


// Package payment using paypal payment method
if( !function_exists('cityestate_package_paypal_payment') ){

    function cityestate_package_paypal_payment(){
        // Get current user id
        global $current_user;
        wp_get_current_user();
        $user_id = $current_user->ID;

        // Get home page url
        $allowed_html   = array();
        $home_url       = esc_url( home_url() );

        // Get package detail
        $package_name    = wp_kses($_POST['package_name'],$allowed_html);
        $package_price   = $_POST['package_price'];
        $package_id      = $_POST['package_id'];

        // Check is package price and package id is available
        if( empty($package_price) && empty( $package_id ) ){
            exit();
        }

        // Get crrency and membership info
        $price_currency            = cityestate_option('paid_currency_type');
        $payment_info = $package_name.' '.esc_html__('Membership payment on ','cityestate').$home_url;

        // Get paypal detail
        $paypal_live = cityestate_option( 'paid_payment_type' );
        $paypal_host = 'https://api.sandbox.paypal.com';

        if( $paypal_live =='live' ){
            $paypal_host = 'https://api.paypal.com';
        }

        // Set paypal arguments
        $url           = $paypal_host.'/v1/oauth2/token';
        $post_args     = 'grant_type=client_credentials';
        $access_token  = cityestate_paypal_access_token( $url, $post_args );
        $url           = $paypal_host.'/v1/payments/payment';
        $return_url    = cityestate_find_template_url( 'templates/payment_thankyou.php' );
        $profile_link  = cityestate_user_profile_page();

        // Get paypal info
        $payment = array( 'intent' => 'sale', 'redirect_urls' => array( 'return_url' => $return_url, 'cancel_url' => $profile_link ), 'payer' => array( 'payment_method' => 'paypal' ), );
        $payment['transactions'][0] = array( 'amount' => array( 'total' => $package_price, 'currency' => $price_currency, 'details' => array( 'subtotal' => $package_price, 'tax' => '0.00', 'shipping' => '0.00' ) ), 'description' => $payment_info );
        $payment['transactions'][0]['item_list']['items'][] = array( 'quantity' => '1', 'name' => esc_html__(' Membership Payment', 'cityestate' ), 'price' => $package_price, 'currency' => $price_currency, 'sku' => $package_name.' '.esc_html__( 'Membership Payment', 'cityestate' ), );

        // Paypal execute the payment request
        $paypal_json        = json_encode($payment);
        $payment_response   = cityestate_execute_paypal_request( $url, $paypal_json, $access_token );

        // Check paypal payment status
        foreach( $payment_response['links'] as $link ){
            // Paypal execute url
            if( $link['rel'] == 'execute' ){
                $payment_execute_url = $link['href'];                
            } else if( $link['rel'] == 'approval_url' ){                
                // Paypal approval url
                $approval_url = $link['href'];
            }
        }

        // Save paypal payment info
        $paypal_output['payment_execute_url'] = $payment_execute_url;
        $paypal_output['access_token']        = $access_token;
        $paypal_output['package_id']          = $package_id;

        $paypal_save_output[$user_id]   = $paypal_output;

        // Save paypal payment info in user metabox
        update_option( 'user_paypal_package_transfer', $paypal_save_output );
        update_user_meta( $user_id, 'user_paypal_package', $paypal_output );
        
        print $approval_url;
        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_package_paypal_payment', 'cityestate_package_paypal_payment' );


// Create payment invoice
if( !function_exists('cityestate_create_payment_invoice') ){

    function cityestate_create_payment_invoice( $bill_for, $package_id, $invoice_info, $user_id, $is_featured, $is_upgrade, $paypal_trans_id, $payment_method ){
        // Get per listing price
        $price_per_listing  = cityestate_option( 'price_per_listing' );
        $price_per_listing  = floatval( $price_per_listing );
        $feature_price      = cityestate_option( 'price_per_featured_listing' );
        $feature_price      = floatval( $feature_price );

        $args = array( 'post_title' => 'Invoice ', 'post_status' => 'publish', 'post_type' => 'cityestate_invoice' );
        $invoice_id = wp_insert_post( $args );

        // Check payment for package or listing
        if( $bill_for != 'package' ){
            // Payment is for upgrade property
            if( $is_upgrade == 1 ){
                $total_price = $feature_price;
            } else {
                // Payment is for featuref property
                if( $is_featured == 1 ){
                    $total_price = $price_per_listing + $feature_price;
                } else {
                    $total_price = $price_per_listing;
                }
            }
        } else {
            // Save package price
            $total_price = get_post_meta( $package_id, 'package_price', true);
        }

        // Update invoice title
        $update_post = array( 'ID' => $invoice_id, 'post_title' => 'Invoice '.$invoice_id, );
        wp_update_post( $update_post );

        // Save invoice data into invoice post type
        $invoice_data = array();
        $invoice_data['inv_billing_for']    = $bill_for;
        $invoice_data['inv_number']         = $package_id;
        $invoice_data['inv_price']          = $total_price;
        $invoice_data['inv_date']           = $invoice_info;
        $invoice_data['inv_buyer_number']   = $user_id;
        $invoice_data['paypal_txn_id']      = $paypal_trans_id;
        $invoice_data['inv_payment']        = $payment_method;
        
        // Update invoice detail
        update_post_meta( $invoice_id, 'cityestate_inv_detail', $invoice_data );
        update_post_meta( $invoice_id, 'cityestate_inv_buyer', $user_id );
        update_post_meta( $invoice_id, 'cityestate_inv_for', $bill_for );
        update_post_meta( $invoice_id, 'cityestate_inv_number', $package_id );
        update_post_meta( $invoice_id, 'cityestate_invoice_price', $total_price );
        update_post_meta( $invoice_id, 'cityestate_invoice_date', $invoice_info );
        update_post_meta( $invoice_id, 'cityestate_paypal_txn_id', $paypal_trans_id );
        update_post_meta( $invoice_id, 'cityestate_inv_payment', $payment_method );

        return $invoice_id;
    }
}

// Change membership package status
if( ! function_exists( 'cityestate_change_membership_package' ) ){

    function cityestate_change_membership_package( $user_id, $package_id ){

        // Get current package info
        $package_list           = get_post_meta( $package_id, 'package_list', true );
        $package_featured       = get_post_meta( $package_id, 'package_featured', true );
        $package_unlimited_list = get_post_meta( $package_id, 'package_unlimited_list', true );

        // Check package is unlimited listing
        if( $package_unlimited_list == 1 ){
            $package_list = -1;
        }

        // Update user detail
        update_user_meta( $user_id, 'package_list', $package_list ) ;
        update_user_meta( $user_id, 'package_featured', $package_featured );

        // Get date and time
        $time = time();
        $date = date('Y-m-d H:i:s',$time);
        
        // Update the user package
        update_user_meta( $user_id, 'package_activation', $date );
        update_user_meta( $user_id, 'package_id', $package_id );

        // Send message to user for package is activated
        $headers  = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        $message  = esc_html__( 'Hi there,','cityestate' ) . "\r\n\r\n";
        $message .= sprintf( esc_html__( 'Your new membership on  %s is activated! You should go check it out.', 'cityestate' ), get_option('blogname') ) . "\r\n\r\n";

        $user_data  = get_user_by( 'id', $user_id );
        $user_email = $user_data->user_email;
        wp_mail( $user_email, sprintf( esc_html__( '[%s] Membership Activated','cityestate' ), get_option('blogname') ), $message, $headers );
    }
}

// Update user package status
if( !function_exists('cityestate_update_user_package_listing') ){
    
    function cityestate_update_user_package_listing( $user_id ){
        // Get user current package list
        $package_list = get_the_author_meta( 'package_list' , $user_id );
        // Check the user current package status
        if( $package_list-1 >= 0 ){
            // Update the package listing
            update_user_meta( $user_id, 'package_list', $package_list - 1 );
        } else if( $package_list == 0 ){
            // Update the package listing
            update_user_meta( $user_id, 'package_list', 0 ) ;
        }
    }
}

// Direct pay in bank transfer for package payment
if( !function_exists('cityestate_direct_bank_package') ){

    function cityestate_direct_bank_package(){
        // Get current user info
        global $current_user;
        $current_user   = wp_get_current_user();
        $user_id        = $current_user->ID;
        $user_email     = $current_user->user_email;
        
        // Get package info
        $choosed_package    = intval($_POST['choosed_package']);
        $total_price        = get_post_meta( $choosed_package, 'package_price', true );
        $price_currency     = cityestate_option( 'property_price_symbol' );
        $where_currency     = cityestate_option( 'property_price_position' );
        $wire_transfer      = cityestate_option( 'wire_transfer_info' );
        
        // Declare variable
        $is_featured        = 0;
        $is_upgrade         = 0;
        $paypal_trans_id    = '';
        $payment_method     = esc_html__( 'Direct Transfer To Bank ', 'cityestate' );
        
        // Get current date and time
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        // Check package price is okay
        if( $total_price != 0 ){
            // Set currency symbol position
            if( $where_currency == 'before' ){
                $total_price = $price_currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $price_currency;
            }
        }

        // Save invoice
        $invoice_id = cityestate_create_payment_invoice( 'package', $choosed_package, $date, $user_id, $is_featured, $is_upgrade, $paypal_trans_id, $payment_method );

        // Translate wire transfer info
        if( function_exists('icl_translate') ){
            $mes_wire = strip_tags( $wire_transfer );
            $payment_details = icl_translate( 'cityestate', 'cityestate_wire_transfer_info_text', $mes_wire );
        } else {
            $payment_details = strip_tags( $wire_transfer );
        }

        // Update payment status
        update_post_meta( $invoice_id, 'inv_payment_status', 0);

        // Get admin info
        $admin_email = get_bloginfo('admin_email');
        $args = array( 'invoice_no' => $invoice_id, 'total_price' => $total_price, 'payment_details' => $payment_details );

        // Send new wire tranfer email to admin and user
        cityestate_send_mail( $admin_email, 'admin_new_wire_transfer_request_subject', 'admin_new_wire_transfer_request_message', $args);
        cityestate_send_mail( $user_email, 'new_wire_transfer_request_subject', 'new_wire_transfer_request_message', $args);        
        
        // Get thank you page link
        $thankyou_page_link = cityestate_find_template_url('templates/payment_thankyou.php');

        if( !empty($thankyou_page_link) ){            
            // Show detail into thank you page
            $thk_sep    = ( parse_url( $thankyou_page_link, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
            $thk_args   = 'directy_pay='.$invoice_id;
            print $thankyou_page_link . $thk_sep . $thk_args;
        }
        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_direct_bank_package', 'cityestate_direct_bank_package' );

// Cityestate Free Membership package
if( !function_exists('cityestate_free_membership_package') ){

    function cityestate_free_membership_package(){
        // Get current user info
        global $current_user;
        $current_user   = wp_get_current_user();
        $user_id        = $current_user->ID;
        $user_email     = $current_user->user_email;
        
        $choosed_package    = intval($_POST['choosed_package']);
        $total_price        = get_post_meta($choosed_package, 'package_price', true);
        $price_currency     = esc_html(cityestate_option('property_price_symbol'));
        $where_currency     = esc_html(cityestate_option('property_price_position'));        
        
        // Declare variable
        $is_featured        = 0;
        $is_upgrade         = 0;
        $paypal_trans_id    = '';
        $payment_method     = '';

        // Get current date and time
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        // Check total price is not zero
        if( $total_price != 0 ){
            // Set currency position
            if( $where_currency == 'before' ){
                $total_price = $price_currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $price_currency;
            }
        }

        // Create package invoice
        $invoice_id = cityestate_create_payment_invoice( 'package', $choosed_package, $date, $user_id, $is_featured, $is_upgrade, $paypal_trans_id, $payment_method );

        // User change the package
        cityestate_change_membership_package( $user_id, $choosed_package );
        
        // Update invoice status
        update_post_meta( $invoice_id, 'inv_payment_status', 1 );
        
        // Update user free package status
        update_user_meta( $user_id, 'user_free_package_status', 'yes' );

        // Get admin email
        $admin_email = get_bloginfo('admin_email');

        // Collect invoice info
        $args = array( 'invoice_no' => $invoice_id, 'total_price' => $total_price );

        // Send email to user and admin
        cityestate_send_mail( $admin_email, 'admin_new_wire_transfer_request_subject', 'admin_new_wire_transfer_request_message', $args );
        cityestate_send_mail( $user_email, 'new_wire_transfer_request_subject', 'new_wire_transfer_request_message', $args );        

        // Get the thank you page link
        $thankyou_page_link = cityestate_find_template_url('templates/payment_thankyou.php');

        // Redirect to user thank you page
        if( !empty($thankyou_page_link) ){            
            $thk_sep = ( parse_url( $thankyou_page_link, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
            $thk_args = 'free_package='.$invoice_id;
            print $thankyou_page_link . $thk_sep . $thk_args;
        }
        wp_die();        
    }
}
add_action( 'wp_ajax_cityestate_free_membership_package', 'cityestate_free_membership_package' );

// Stripe payment for property per listing
if( !function_exists('cityestate_stripe_per_listing') ){

    function cityestate_stripe_per_listing( $property_id, $price_submission ){
        // Get current user info
        $current_user = wp_get_current_user();
        $user_id      = $current_user->ID;
        $user_email   = $current_user->user_email;

        // Include stripe payment library
        require_once( get_template_directory() . '/inc/cityestate/frame-work/stripe-php/init.php' );
        
        // Get stripe secret and public key
        $secret_key = cityestate_option('stripe_secret_key');
        $public_key = cityestate_option('stripe_public_key');

        // Collect the stripe key
        $stripe = array( 'secret_key' => $secret_key, 'publishable_key' => $public_key );

        // Call stripe payment class
        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        // Set price and currency
        $paid_currency = cityestate_option('paid_currency_type');        
        $paid_price    = $price * 100;

        print '<div class="cityestate_stripe_listing">
            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="'.esc_attr($public_key).'"
            dpaid_ata-amount="'.esc_attr($price).'"
            data-email="'.esc_attr($user_email).'"
            data-zip-code="true"
            data-currency="'.esc_attr($paid_currency).'"
            data-label="'.esc_html__( 'Pay with Credit Card', 'cityestate' ).'"
            data-description="'.esc_html__( 'Submission Payment', 'cityestate' ).'">
            </script>
        </div>
        <input type="hidden" id="property_id" name="property_id" value="'.esc_attr($property_id).'">
        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
        <input type="hidden" name="userID" value="'.esc_attr($user_id).'">
        <paid_input type="hidden" id="pay_ammout" name="pay_ammout" value="'.esc_attr($price).'">';
    }    
}

// Change user package status
if( !function_exists('cityestate_old_package_status') ){
    
    function cityestate_old_package_status( $user_id, $package_id ){
        // Get current package info
        $package_list           = get_post_meta( $package_id, 'package_list', true );
        $package_featured       = get_post_meta( $package_id, 'package_featured', true );
        $package_unlimited_list = get_post_meta( $package_id, 'package_unlimited_list', true );

        // Get nunber of property user posted
        $args = array( 'post_type' => 'property', 'post_status' => 'any', 'author' => $user_id );
        $property = new WP_Query( $args );
        $used_property = $property->found_posts;
        wp_reset_postdata();

        // Get number of featured propert user posted
        $args = array( 'post_type' => 'property', 'post_status' => 'any', 'author' => $user_id, 'meta_query' => array( array( 'key' => 'featured', 'value' => 1, 'meta_compare '=>'=' ) ) );
        $property = new WP_Query( $args );
        $used_featured_property = $property->found_posts;
        wp_reset_postdata();

        // Get current list info
        $active_list = get_user_meta( $user_id, 'package_list', true );

        // Check package has unlimited listing
        if( $package_unlimited_list == 1 ){
            return false;
        }

        // Check package has unlimited listing then check active list status
        if( $active_list == -1 && $package_unlimited_list != 1 ){
            return true;
        }

        // Check user current package status
        if( ( $used_property > $package_list ) || ( $used_featured_property > $package_featured ) ){
            return true;
        } else {
            return false;
        }
    }
}

// Change user package
if( !function_exists('cityestate_user_change_package') ){

    function cityestate_user_change_package( $user_id, $package_id ){
        
        // Get current package info
        $package_list      = get_post_meta( $package_id, 'package_list', true );
        $package_featured  = get_post_meta( $package_id, 'package_featured', true );

        // Update package info to user data
        update_user_meta( $user_id, 'package_list', $package_list );
        update_user_meta( $user_id, 'package_featured', $package_featured );

        // Get number of featured propert user posted
        $args = array( 'post_type' => 'property', 'author' => $user_id, 'post_status' => 'any' );
        $property = new WP_Query( $args );
        
        global $post;

        // Downgrade the property
        while( $property->have_posts() ){
            $property->the_post();
            // Update the property status
            $property_info = array( 'ID' => $post->ID, 'post_type' => 'property', 'post_status' => 'expired' );
            wp_update_post( $property_info );
            // Remove featured property status
            update_post_meta( $post->ID, 'featured', 0 );
        }
        wp_reset_postdata();

        // Get user detail
        $user_data  = get_user_by( 'id', $user_id );
        $user_email = $user_data->user_email;

        // Send mail to user for account is downdraded
        $headers  = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        $message  = esc_html__( 'Account Downgraded,', 'cityestate' ) . "\r\n\r\n";
        $message .= sprintf( esc_html__( "Hello, You downgraded your subscription on  %s. Because your listings number was greater than what the actual package offers, we set the status of all your listings to \"expired\". You will need to choose which listings you want live and send them again for approval. Thank you!", 'cityestate' ), get_option('blogname')) . "\r\n\r\n";
        wp_mail( $user_email, sprintf( esc_html__('[%s] Account Downgraded', 'cityestate' ), get_option('blogname')), $message, $headers );
    }
}

// Get invoice fields
if( !function_exists( 'cityestate_filter_invoice_data' ) ){

    function cityestate_filter_invoice_data( $invoice_id, $field = false ){

        // Declare invoice array
        $invoice_array = array( 'inv_billing_for' => '', 'inv_number' => '', 'inv_price' => '', 'inv_payment' => '', 'inv_date' => '', 'inv_buyer_number' => '' );

        // Get invoice meta
        $invoice_meta = get_post_meta( $invoice_id, 'cityestate_inv_detail', true );
        $invoice_meta = wp_parse_args( (array) $invoice_meta, $invoice_array );

        // Check if field is available
        if( $field ){            
            if( isset( $invoice_meta[$field] ) ){
                return $invoice_meta[$field];
            } else {
                return false;
            }
        }
        return $invoice_meta;
    }
}

// Get invoice price
if( !function_exists('cityestate_get_invoice_price') ){
    
    function cityestate_get_invoice_price( $invoice_price ){
        // Validate the invoice price
        $invoice_price = doubleval( $invoice_price );

        // Check invoice price is okay
        if( $invoice_price ){
            $position_currency = cityestate_option( 'property_price_symbol' );

            if( !empty($position_currency) ){
                $currency = $position_currency;                
            } else {
                $currency = esc_html__( '$' , 'cityestate' );
            }

            // Set the different value of invoice price            
            $price_decimal      = 2;
            $decimal_point      = cityestate_option( 'property_price_decimal_sep' );
            $decimal_thou_sep   = cityestate_option( 'property_price_decimal_tho_sep' );
            $price_position     = cityestate_option( 'property_price_position' );
            $format_price    = number_format( $invoice_price , $price_decimal , $decimal_point , $decimal_thou_sep );

            // Check currency position
            if( $price_position == 'before' ){
                return $currency . $format_price;
            } else {
                return $format_price . $currency;
            }
        } else {
            $currency = '';
        }
        // Return final invoice price
        return $currency;
    }
}

// Admin approve package list
if( !function_exists('cityestate_admin_approve_package') ){    
    
    function cityestate_admin_approve_package(){
        // Check user is admin or user is login
        if( !is_user_logged_in() || !is_admin() ){
            exit( 'are you kidding?' );
        }
        // Get package and invoice id
        $package_id = intval($_POST['item_id']);
        $invoice_id = intval($_POST['invoice_id']);        
        
        // Get user id and buyer id
        $user_id    = get_post_meta( $invoice_id, 'cityestate_inv_buyer', true );
        $buyer_id   = get_post_meta( $invoice_id, 'inv_buyer_number', true );
        
        // Collect the user detail
        $user_data  = get_user_by( 'id', $buyer_id );
        $user_email = $user_data->user_email;

        // Check user current package status
        $package_status = cityestate_old_package_status( $user_id, $package_id);
        if( $package_status ){
            // Downgrade the user account
            cityestate_user_change_package( $user_id, $package_id );
            // Change the user package status
            cityestate_change_membership_package( $user_id, $package_id );
        } else {
            // Change the user package status
            cityestate_change_membership_package( $user_id, $package_id );
        }

        // Update invoice payment status
        update_post_meta( $invoice_id, 'inv_payment_status', 1 );

        // Send mail to user
        cityestate_send_mail( $user_email, 'purchase_is_active_subject', 'purchase_is_active_message', array() );
        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_admin_approve_package', 'cityestate_admin_approve_package' );

// Admin approve user list
if( !function_exists('cityestate_admin_approve_list') ){
    
    function cityestate_admin_approve_list(){
        // Check user id login or is admin
        if( !is_user_logged_in() || !is_admin() ){
            exit( 'are you kidding?' );
        }
        // Fetch data from ajax
        $item_id        = intval($_POST['item_id']);
        $invoice_id     = intval($_POST['invoice_id']);
        $purchase_type  = intval($_POST['purchase_type']);
        $buyer_id       = get_post_meta( $invoice_id, 'inv_buyer_number', true );

        // Get user info
        $user_data  = get_user_by('id', $buyer_id );
        $user_email = $user_data->user_email;

        if( $purchase_type == 1 ){
            // Update payment status
            update_post_meta( $item_id, 'payment_status', 'paid' );
            $post_args = array( 'ID' => $item_id, 'post_status' => 'publish' );
            wp_update_post( $post_args );

        } else if( $purchase_type == 2 ){
            // Update property featured type
            update_post_meta( $item_id, 'featured', 1 );

        } else if( $purchase_type == 3 ){            
            // Update payment status
            update_post_meta( $item_id, 'payment_status', 'paid' );
            // Update property featured type
            update_post_meta( $item_id, 'featured', 1 );
            $post_args  = array( 'ID' => $item_id, 'post_status' => 'publish' );
            wp_update_post( $post_args );
        }
        // Update payment stauts
        update_post_meta( $invoice_id, 'inv_payment_status', 1 );
        $args = array();

        // Send mail to user list is approved
        cityestate_send_mail( $user_email, 'wire_purchase_is_active_subject', 'wire_purchase_is_active_message', $args );
        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_admin_approve_list', 'cityestate_admin_approve_list' );

// Paypal payment method for single property listing or upgrade or featured property
if( !function_exists('cityestate_paypal_payment_method') ){
    
    function cityestate_paypal_payment_method(){
        
        // Get current user info
        global $current_user;
        wp_get_current_user();
        $user_id = $current_user->ID;

        // Get property detail
        $property_id   = intval($_POST['property_id']);
        $is_featured   = intval($_POST['is_featured']);
        $is_upgrade    = intval($_POST['is_upgrade']);

        // get per listing and featured listing cost 
        $price_per_listing  = cityestate_option( 'price_per_listing' );
        $price_per_listing  =  floatval( $price_per_listing );
        $feature_price     = cityestate_option( 'price_per_featured_listing' );
        $feature_price     =  floatval( $feature_price );
        $price_currency     = cityestate_option( 'paid_currency_type' );
        $submission_curency =  esc_html( $price_currency );

        // Get home page urk
        $home_url       = esc_url( home_url() );
        $payment_info   =  esc_html__( 'Listing payment on ', 'cityestate' ).$home_url;

        // Get property object and check security
        $property_post = get_post($property_id);
        if( $property_post->post_author != $user_id ){
            wp_die( 'Are you kidding?' );
        }

        // Get paypal info
        $paypal_live        =  cityestate_option( 'paid_payment_type' );
        $paypal_host        =  'https://api.sandbox.paypal.com';
        
        // Check is property featured
        if( $is_featured == 0 ){
            $total_price = number_format( $price_per_listing, 2, '.','' );
        } else {
            $total_price = $price_per_listing + $feature_price;
            $total_price = number_format( $total_price, 2, '.','' );
        }

        // Check is property upgrade
        if( $is_upgrade == 1 ){
            $total_price     = number_format($feature_price, 2, '.','');
            $payment_info =  esc_html__( 'Upgrade to featured listing on ', 'cityestate' ).$home_url;
        }

        // Check paypal is live
        if( $paypal_live =='live' ){
            $paypal_host='https://api.paypal.com';
        }

        $paypal_url =  $paypal_host.'/v1/oauth2/token';
        $post_args  =  'grant_type=client_credentials';

        // Get paypal access token
        $paypal_token    =  cityestate_paypal_access_token( $paypal_url, $post_args );
        $paypal_url      =  $paypal_host.'/v1/payments/payment';
            
        // Set success and cancle link
        $dashboard_link  =  cityestate_user_property_list();
        $return_link     =  cityestate_find_template_url('templates/payment_thankyou.php');

        // Paypal payment basic detail
        $payment = array( 'intent' => 'sale',  'redirect_urls' => array(  'return_url' => $return_link,  'cancel_url' => $dashboard_link  ), 'payer' => array(  'payment_method' => 'paypal'  ) );
        $payment['transactions'][0] = array( 'amount' => array( 'total' => $total_price, 'currency' => $submission_curency, 'details' => array( 'subtotal' => $total_price, 'tax' => '0.00', 'shipping' => '0.00' ) ), 'description' => $payment_info );


        // Check is property upgrade
        if( $is_upgrade == 1 ){
            $payment['transactions'][0]['item_list']['items'][] = array( 'quantity'=> '1', 'name' => esc_html__( 'Upgrade to Featured Listing', 'cityestate' ), 'price' => $total_price, 'currency' => $submission_curency, 'sku' => 'Upgrade Listing' );
        } else {
            // Check is property featured
            if( $is_featured == 1 ){
                $payment['transactions'][0]['item_list']['items'][] = array( 'quantity' => '1', 'name' => esc_html__( 'Listing with Featured Payment option' , 'cityestate' ), 'price' => $total_price, 'currency' => $submission_curency, 'sku' => 'Featured Paid Listing' );
            } else {
                $payment['transactions'][0]['item_list']['items'][] = array( 'quantity' => '1', 'name' => esc_html__( 'Listing Payment', 'cityestate' ), 'price' => $total_price, 'currency' => $submission_curency, 'sku' => 'Paid Listing' );
            }
        }

        // Payment in json
        $payment_json     = json_encode($payment);
        $payment_response  = cityestate_execute_paypal_request( $paypal_url, $payment_json, $paypal_token );

        foreach( $payment_response['links'] as $link ){

            if( $link['rel'] == 'execute' ){
                $payment_execute_url = $link['href'];
            } else if( $link['rel'] == 'approval_url' ){
                $approval_url = $link['href'];
            }

        }

        // Save data in database for further use on processor page
        $output['payment_execute_url'] = $payment_execute_url;
        $output['paypal_token']        = $paypal_token;
        $output['property_id']         = $property_id;
        $output['is_prop_featured']    = $is_featured;
        $output['is_prop_upgrade']     = $is_upgrade;

        $save_output[$current_user->ID] = $output;

        update_option( 'cityestate_paypal_transfer',$save_output );

        print $approval_url;

        wp_die();
    }
}
add_action('wp_ajax_cityestate_paypal_payment_method', 'cityestate_paypal_payment_method');

// Direct bank transfer payment for property listing
if( !function_exists('cityestate_direct_bank_per_listing') ){
    
    function cityestate_direct_bank_per_listing(){
        // Get current user info
        $current_user   = wp_get_current_user();
        $user_id        = $current_user->ID;
        $user_email     = $current_user->user_email ;

        // Get price per listing and featured listing
        $price_submi    = cityestate_option( 'price_per_listing' );
        $price_submi    = floatval( $price_submi );
        
        // Get proerty id and property status
        $property_id    = intval($_POST['property_id']);
        $payment_status = get_post_meta( $property_id, 'payment_status', true );
            
        // Get priperty price and info
        $price_currency     = cityestate_option( 'property_price_symbol' );
        $where_currency     = cityestate_option( 'property_price_position' );
        $wire_info          = cityestate_option( 'wire_transfer_info' );            
        $payment_method     = esc_html__( 'Direct Transfer To Bank', 'cityestate' );

        // Get current time and date
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        // Create direct bank transfer invoice
        $invoice_id = cityestate_create_payment_invoice( 'Listing', $property_id, $date, $user_id, 0, 0, '', $payment_method );
        
        // Get total price
        $total_price = $price_submission;
        if( $total_price != 0 ){
            // Set currency position
            if( $where_currency == 'before'){
                $total_price = $price_currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $price_currency;
            }
        }

        // Translate language
        if( function_exists('icl_translate') ){
            $mes_wire         = strip_tags( $wire_info );
            $payment_details  = icl_translate( 'cityestate', 'cityestate_wire_payment_instruction_text', $mes_wire );
        } else {
            $payment_details = strip_tags( $wire_info );
        }        

        // Set Payment status Not Paid
        update_post_meta( $invoice_id, 'inv_payment_status', 0 );

        // Get admin email id
        $admin_email = get_bloginfo('admin_email');

        // Send email t admin and user
        $args = array( 'invoice_no' => $invoice_id, 'total_price' => $total_price, 'payment_details' => $payment_details );
        cityestate_send_mail( $admin_email, 'admin_new_wire_transfer_request_subject', 'admin_new_wire_transfer_request_message', $args );
        cityestate_send_mail( $user_email, 'new_wire_transfer_request_subject', 'new_wire_transfer_request_message', $args );
        
        // Get thank you page link
        $thankyou_page_link = cityestate_find_template_url('templates/payment_thankyou.php');

        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_direct_bank_per_listing', 'cityestate_direct_bank_per_listing' );

// Stripe Form Per Listing
if( !function_exists('cityestate_payment_stripe_per_listing') ){
    
    function cityestate_payment_stripe_per_listing( $property_id, $property_price, $feature_price ){
        // Get stripe secret and public key
        $secret_key  = cityestate_option( 'stripe_secret_key' );
        $public_key  = cityestate_option( 'stripe_public_key' );

        // Include stripe library
        require_once( get_template_directory() . '/inc/cityestate/frame-work/stripe-php/init.php' );        

        // Create array with stripe keys
        $stripe = array( 'secret_key' => $secret_key, 'publishable_key' => $public_key );

        // Call stripe payment library
        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        
        $processor_link         = cityestate_find_template_url( 'templates/template_stripe_charge.php' );
        $submission_currency    = cityestate_option( 'paid_currency_type' );
        
        // Get current user info
        $current_user   = wp_get_current_user();
        $user_id        = $current_user->ID;
        $user_email     = $current_user->user_email;

        // Calculate property price
        $property_price_total = $property_price + $feature_price;
        $property_price_total = $property_price_total * 100;
        $property_price       = $property_price * 100;
        
        // Load stripe payment modal
        print
        '<form action="' . $processor_link . '" method="post" id="stripe_form_simple_listing">
            <div class="cityestate_stripe_listing">
                <script src="https://checkout.stripe.com/checkout.js"
                    class="stripe-button"
                    data-key="' . $public_key . '"
                    data-amount="' . $property_price . '"
                    data-email="' . $user_email . '"
                    data-zip-code="true"
                    data-currency="' . $submission_currency . '"
                    data-label="' . esc_html__( 'Pay with Credit Card', 'cityestate' ) . '"
                    data-description="' . esc_html__( 'Submission Payment', 'cityestate' ) . '">
                </script>
            </div>
            <input type="hidden" id="property_id" name="property_id" value="' . $property_id . '">
            <input type="hidden" id="submission_pay" name="submission_pay" value="1">
            <input type="hidden" name="userID" value="' . $user_id . '">
            <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $property_price . '">
        </form>

        <form action="' . $processor_link . '" method="post" id="stripe_form_featured_list" style="display:none;">
            <div class="cityestate_stripe_listing">
                <script src="https://checkout.stripe.com/checkout.js"
                    class="stripe-button"
                    data-key="' . $public_key . '"
                    data-amount="' . $property_price_total . '"
                    data-email="' . $user_email . '"
                    data-zip-code="true"
                    data-currency="' . $submission_currency . '"
                    data-label="' . esc_html__( 'Pay with Credit Card', 'cityestate' ) . '"
                    data-description="' . esc_html__( 'Submission & Featured Payment', 'cityestate' ) . '">
                </script>
            </div>
            <input type="hidden" id="property_id" name="property_id" value="' . $property_id . '">
            <input type="hidden" id="submission_pay" name="submission_pay" value="1">
            <input type="hidden" id="featured_pay" name="featured_pay" value="1">
            <input type="hidden" name="userID" value="' . $user_id . '">
            <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $property_price_total . '">
        </form>';

    }

}

// Stripe Form Per Listing Upgrade
if( !function_exists('cityestate_payment_stripe_for_upgrade') ){

    function cityestate_payment_stripe_for_upgrade( $property_id, $feature_price ){
        // Include stripe library
        require_once( get_template_directory() . '/inc/cityestate/frame-work/stripe-php/init.php' );

        // Get stripe secret and public key
        $secret_key     = cityestate_option( 'stripe_secret_key' );
        $public_key     = cityestate_option( 'stripe_public_key' );

        // Create array with stripe keys
        $stripe = array( 'secret_key' => $secret_key, 'publishable_key' => $public_key );        

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        $processor_link = cityestate_find_template_url( 'templates/template-stripe-charge.php' );

        // Get current user info
        $current_user   = wp_get_current_user();
        $user_id        = $current_user->ID;
        $user_email     = $current_user->user_email;
        
        // Get payment currency and set package price
        $submission_currency = cityestate_option( 'paid_currency_type' );
        $feature_price       = $feature_price * 100;

        // Load stripe payment modal
        print '
        <form action="' . $processor_link . '" method="post" >
        <div class="cityestate_upgrade_stripe">
            <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="' . $public_key . '"
            data-amount="' . $feature_price . '"
            data-zip-code="true"
            data-email="' . $user_email . '"
            data-currency="' . $submission_currency . '"
            data-panel-label="' . esc_html__( 'Upgrade to Featured', 'cityestate' ) . '"
            data-label="' . esc_html__( 'Pay with Credit Card', 'cityestate' ) . '"
            data-description="' . esc_html__( 'Featured Payment', 'cityestate' ) . '">
            </script>
        </div>
        <input type="hidden" id="property_id" name="property_id" value="' . $property_id . '">
        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
        <input type="hidden" id="is_upgrade" name="is_upgrade" value="1">
        <input type="hidden" name="userID" value="' . $user_id . '">
        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $feature_price . '">
        </form>';
    }

}

// Direct bank transfer per listing
if( !function_exists('cityestate_direct_bank_per_listing') ){
    
    function cityestate_direct_bank_per_listing(){
        // Get current user info
        $current_user   = wp_get_current_user();
        $user_id        = $current_user->ID;
        $user_email     = $current_user->user_email ;

        // Get property price and featured property price
        $price_submission   = cityestate_option( 'price_per_listing' );
        $price_submission   = floatval( $price_submission );
        $feature_price     = cityestate_option( 'price_per_featured_listing' );
        $feature_price     = floatval( $feature_price );

        // Get propert id and featured property status
        $property_id = intval($_POST['property_id']);
        $is_featured = intval($_POST['is_featured']);
        
        // Get property payment status
        $payment_status = get_post_meta( $property_id, 'payment_status', true );        
        
        // Get price and currency symbol
        $price_currency     = esc_html( cityestate_option( 'property_price_symbol' ) );
        $where_currency     = esc_html( cityestate_option( 'property_price_position' ) );
        $wire_info          = cityestate_option( 'wire_transfer_info' );
        $payment_method     = esc_html__( 'Direct Transfer To Bank', 'cityestate' );

        // Get current date and time
        $time = time();
        $date = date('Y-m-d H:i:s', $time);

        // Get total price
        $total_price = 0;
        if( $is_featured == 1 ){
            // Check property status
            if( $payment_status == 'paid' ){
                // Create payment invoice
                $invoice_id     = cityestate_create_payment_invoice( 'Upgrade to Featured', $property_id, $date, $user_id, 0, 1, '', $payment_method );
                $total_price    = $feature_price;
            } else {
                // Create payment invoice
                $invoice_id     = cityestate_create_payment_invoice( 'Publish Listing with Featured', $property_id, $date, $user_id, 1, 0, '', $payment_method );
                $total_price    = $price_submission + $feature_price;                
            }
        } else {
            // Create payment invoice
            $invoice_id     = cityestate_create_payment_invoice( 'Listing', $property_id, $date, $user_id, 0, 0, '', $payment_method );
            $total_price    = $price_submission;
        }

        // Check total price is not zero
        if( $total_price != 0 ){
            // Set currency position
            if( $where_currency == 'before' ){
                $total_price = $price_currency . ' ' . $total_price;
            } else {
                $total_price = $total_price . ' ' . $price_currency;
            }
        }

        // Translate direct bank transfer instruction
        if( function_exists('icl_translate') ){
            $mes_wire         = strip_tags( $wire_info );
            $payment_details  = icl_translate( 'cityestate','cityestate_wire_payment_instruction_text', $mes_wire );
        }else{
            $payment_details = strip_tags( $wire_info );
        }

        // Update invoice status
        update_post_meta( $invoice_id, 'inv_payment_status', 0 );

        // Send email to admin and user
        $admin_email = get_bloginfo('admin_email');
        $args = array( 'invoice_no' => $invoice_id, 'total_price' => $total_price, 'payment_details' => $payment_details );
        cityestate_send_mail( $admin_email, 'admin_new_wire_transfer_request_subject', 'admin_new_wire_transfer_request_subject', $args );
        cityestate_send_mail( $user_email, 'new_wire_transfer_request_subject', 'new_wire_transfer_request_subject', $args );
        
        wp_die();
    }
}
add_action( 'wp_ajax_cityestate_direct_bank_per_listing', 'cityestate_direct_bank_per_listing' );

// Make featured property status
if( !function_exists('cityestate_make_featured_property') ){
    
    function cityestate_make_featured_property(){
        // Get current user info
        global $current_user;
        wp_get_current_user();
        $user_id  =  $current_user->ID;
        
        // Get property id anc check security
        $property_id    = intval( $_POST['property_id'] );
        $property_post  = get_post( $property_id );

        // Get remaining featured listing
        $remaining = get_the_author_meta( 'package_featured' , $user_id );
        if( $remaining > 0 ){
            // Get featured remaining
            $package_featured = get_the_author_meta( 'package_featured' , $user_id );
            
            // Check featured remaining is left
            if( $package_featured-1 >= 0 ){
                // Update featured remaining
                update_user_meta( $user_id, 'package_featured', $package_featured - 1 );
            } else if( $package_featured == 0 ){
                // featured remaining
                update_user_meta( $user_id, 'package_featured', 0 );
            }
            
            // Update property status
            update_post_meta( $property_id, 'featured', 1 );
            
            // Return success message
            echo json_encode( array( 'success' => true ) );
            wp_die();
        } else {
            // Return error message
            echo json_encode( array( 'success' => false ) );
            wp_die();
        }
    }
}
add_action( 'wp_ajax_cityestate_make_featured_property', 'cityestate_make_featured_property' );


// Resend property for approval
if( !function_exists('cityestate_property_resend_for_approval') ){

    function cityestate_property_resend_for_approval(){
        // Get current user info
        global $current_user;
        wp_get_current_user();
        $user_id = $current_user->ID;
        
        // Get property id and check security
        $property_id    = intval($_POST['property_id']);
        $property_post  = get_post($property_id);        
        
        if( $property_post->post_author != $user_id ){
            wp_die( 'Are you kidding?' );
        } else {

            // Update property status
            $args = array( 'ID' => $property_id, 'post_type' => 'property', 'post_status' => 'pending', 'post_date' => current_time( 'mysql' ), 'post_date_gmt' => current_time( 'mysql' ) );
            wp_update_post( $args );

            // Update property featured status and payment status
            update_post_meta( $property_id, 'featured', 0 );
            update_post_meta( $property_id, 'payment_status', 'not_paid' );

            // Get property title
            $submit_title = get_the_title( $property_id) ;
            $args = array( 'submission_title' => $submit_title, 'submission_url'   => get_permalink( $property_id ) );

            // Send email to agent
            cityestate_send_mail( get_option('admin_email'), 'admin_expired_listing_subject', 'admin_expired_listing_mesaage', $args );

            // Return message
            echo json_encode( array( 'success' => true, 'msg' => esc_html__( 'Sent for approval', 'cityestate' ) ) );
            wp_die();
        }
    }
}
add_action( 'wp_ajax_cityestate_property_resend_for_approval', 'cityestate_property_resend_for_approval' );


// Resend property for approval
if( !function_exists('cityestate_resend_for_approval') ){

    function cityestate_resend_for_approval(){

        // Get current user info
        global $current_user;
        wp_get_current_user();
        $user_id = $current_user->ID;

        // Get property id and check security
        $property_id    = intval($_POST['property_id']);
        $property_post  = get_post($property_id);        

        if( $property_post->post_author != $user_id ){
            wp_die( 'Are you kidding?' );
        }

        // Get left listing
        $left_listings = get_user_meta( $user_id, 'package_list', true );

        if( $left_listings > 0 || $left_listings == -1 ){
            // Update property status
            $args = array( 'ID' => $property_id, 'post_type' => 'property', 'post_status' => 'publish' );
            wp_update_post($prop);
            
            // Update property featured status
            update_post_meta( $property_id, 'featured', 0 );

            // Check listing is left
            if( $left_listings != -1 ){
                update_user_meta( $user_id, 'package_list', $left_listings - 1 );
            }
            
            // Return success message
            echo json_encode( array(' success' => true, 'msg' => esc_html__( 'Reactivated', 'cityestate') ) );
            wp_die();
        } else {
            // Return error message
            echo json_encode( array( 'success' => false, 'msg' => esc_html__( 'No listings available', 'cityestate' ) ) );
            wp_die();
        }
    }
}
add_action( 'wp_ajax_cityestate_resend_for_approval', 'cityestate_resend_for_approval' );

?>