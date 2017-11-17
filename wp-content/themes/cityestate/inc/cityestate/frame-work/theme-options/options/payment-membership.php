<?php

// Payment And Membership
Redux::setSection( $opt_name, array(
    
    'title'  => esc_html__( 'Payment & Membership', 'cityestate' ),
    'id'     => 'payment-membership',
    'icon'   => 'el-icon-cog el-icon-small',
    'fields' => array(

        array(
            'id'       => 'admin_approve_submit_property',
            'type'     => 'select',
            'title'    => esc_html__( 'Submitted Property Must be Approved by Admin ?', 'cityestate' ),
            'options'  => array(
				                'yes'   => esc_html__( 'Yes', 'cityestate' ),
				                'no'   	=> esc_html__( 'No', 'cityestate' )
				            ),
            'default'  => 'yes'
        ),

        array(
            'id'       => 'submit_property_type',
            'type'     => 'select',
            'title'    => esc_html__( 'Paid Submission Plan', 'cityestate' ),
            'options'  => array(
				                'no'   			=> esc_html__( 'Free', 'cityestate' ),
				                'per_listing'   => esc_html__( 'Per Listing', 'cityestate' ),
				                'membership'   	=> esc_html__( 'Membership', 'cityestate' )
				            ),
            'default'  => 'no'
        ),

        array(
            'id'       => 'per_listing_is_expired',
            'type'     => 'switch',
            'required' => array( 'submit_property_type', '=', 'per_listing' ),
            'title'    => esc_html__( 'Expire Days Enable', 'cityestate' ),
            'subtitle' => esc_html__( 'Want to enable single listing expire days ?', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' )
        ),

        array(
            'id'       => 'per_listing_expired_time',
            'type'     => 'text',
            'required' => array( 'per_listing_is_expired', '=', '1' ),
            'title'    => esc_html__( 'Number of Expire Days', 'cityestate'),
            'subtitle' => esc_html__( 'Number of days after listings will expire. This will starts when the property will be published on the website', 'cityestate' ),
            'default'  => '30'
        ),

        array(
            'id'       => 'paid_currency_type',
            'type'     => 'select',
            'required' => array( 'submit_property_type', '!=', 'no' ),
            'title'    => esc_html__( 'Currency Of Paid Submission', 'cityestate' ),
            'options'  => array(
				                'USD'  => 'USD',
				                'EUR'  => 'EUR',
				                'AUD'  => 'AUD',
				                'BRL'  => 'BRL',
				                'CAD'  => 'CAD',
				                'CHF'  => 'CHF',
				                'CZK'  => 'CZK',
				                'DKK'  => 'DKK',
				                'HKD'  => 'HKD',
				                'HUF'  => 'HUF',
				                'ILS'  => 'ILS',
				                'INR'  => 'INR',
				                'JPY'  => 'JPY',
				                'MYR'  => 'MYR',
				                'MXN'  => 'MXN',
				                'NOK'  => 'NOK',
				                'NZD'  => 'NZD',
				                'PHP'  => 'PHP',
				                'PLN'  => 'PLN',
				                'GBP'  => 'GBP',
				                'SGD'  => 'SGD',
				                'SEK'  => 'SEK',
				                'TWD'  => 'TWD',
				                'THB'  => 'THB',
				                'TRY'  => 'TRY'
				            ),
            'default'  => 'USD'
        ),

        array(
            'id'       => 'price_per_listing',
            'type'     => 'text',
            'required' => array( 'submit_property_type', '=', 'per_listing' ),
            'title'    => esc_html__( 'Rate Per Submission', 'cityestate' )            
        ),

        array(
            'id'       => 'price_per_featured_listing',
            'type'     => 'text',
            'required' => array( 'submit_property_type', '=', 'per_listing' ),
            'title'    => esc_html__( 'Rate To Make Property Featured', 'cityestate' )            
        ),

        array(
            'id'       => 'paid_payment_type',
            'type'     => 'select',
            'required' => array( 'submit_property_type', '!=', 'no' ),
            'title'    => esc_html__( 'Paypal & Stripe Api', 'cityestate' ),
            'subtitle' => esc_html__( 'Sandbox = test API. LIVE = real payments API', 'cityestate' ),
            'desc'     => esc_html__( 'Update PayPal and Stripe settings according to API type selection', 'cityestate' ),
            'options'  => array(
				                'sandbox'	=> 'Sandbox',
				                'live'   	=> 'Live',
				            ),
            'default'  => 'sandbox'
        ),

        array(
            'id'       => 'payment_page_term_condition',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => esc_html__( 'Terms & Conditions', 'cityestate' ),
            'subtitle' => esc_html__( 'Select terms & conditions page', 'cityestate' ),            
        ),      

    )

));

Redux::setSection( $opt_name, array(
    
    'title'  		=> esc_html__( 'Paypal Settings', 'cityestate' ),
    'id'     		=> 'paypal-settings',    
    'subsection' 	=> true,
    'fields' 		=> array(
        
        array(
            'id'       => 'active_paypal_payment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Paypal Payment', 'cityestate' ),
            'required' => array( 'submit_property_type', '!=', 'no' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),

        array(
            'id'       => 'paypal_client_id',
            'type'     => 'text',
            'required' => array( 'active_paypal_payment', '=', '1' ),
            'title'    => esc_html__( 'Paypal Client ID', 'cityestate' )
        ),

        array(
            'id'       => 'paypal_client_secret_key',
            'type'     => 'text',
            'required' => array( 'active_paypal_payment', '=', '1' ),
            'title'    => esc_html__( 'Paypal Client Secret Key', 'cityestate' )
        ),

        array(
            'id'       => 'paypal_api_username',
            'type'     => 'text',
            'required' => array( 'active_paypal_payment', '=', '1' ),
            'title'    => esc_html__( 'Paypal API Username', 'cityestate' )            
        ),

        array(
            'id'       => 'paypal_api_password',
            'type'     => 'text',
            'required' => array( 'active_paypal_payment', '=', '1' ),
            'title'    => esc_html__( 'Paypal API Password', 'cityestate' )
        ),

        array(
            'id'       => 'paypal_api_signature',
            'type'     => 'text',
            'required' => array( 'active_paypal_payment', '=', '1' ),
            'title'    => esc_html__( 'Paypal API Signature', 'cityestate' )            
        ),       

    )

));

Redux::setSection( $opt_name, array(
    
    'title'  		=> esc_html__( 'Stripe Settings', 'cityestate' ),
    'id'     		=> 'stripe-settings',
    'subsection' 	=> true,
    'fields' 		=> array(
        
        array(
            'id'       => 'active_stripe_payment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Stripe', 'cityestate' ),
            'required' => array( 'submit_property_type', '!=', 'no' ),
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),

        array(
            'id'       => 'stripe_secret_key',
            'type'     => 'text',
            'required' => array( 'active_stripe_payment', '=', '1' ),
            'title'    => esc_html__( 'Stripe Secret Key', 'cityestate' ),
            'subtitle' => esc_html__( 'Info is taken from your account at https://dashboard.stripe.com/login', 'cityestate' )
        ),

        array(
            'id'       => 'stripe_public_key',
            'type'     => 'text',
            'required' => array( 'active_stripe_payment', '=', '1' ),
            'title'    => esc_html__( 'Stripe Publishable Key', 'cityestate' ),
            'subtitle' => esc_html__( 'Info is taken from your account at https://dashboard.stripe.com/login', 'cityestate' )
        )

    )

));

Redux::setSection( $opt_name, array(
    
    'title'  		=> esc_html__( 'Direct Payment / Wire Payment', 'cityestate' ),
    'id'     		=> 'wire-payment',
    'subsection' 	=> true,
    'fields' 		=> array(
        
        array(
            'id'       => 'active_wire_transfer_payment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Wire Transfer', 'cityestate' ),
            'required' => array( 'submit_property_type', '!=', 'no' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' )
        ),

        array(
            'id'       => 'wire_transfer_info',
            'type'     => 'editor',
            'required' => array( 'active_wire_transfer_payment', '=', '1' ),
            'title'    => esc_html__( 'Wire instructions for direct payment', 'cityestate' ),
            'args'     => array( 'teeny' => true, 'textarea_rows' => 10 )
        )

    )
    
));

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Thank You Page', 'cityestate' ),
    'id'            => 'payment-thankyou',
    'desc'          => '',
    'subsection'    => true,
    'fields'        => array(
        
        array(
            'id'       => 'payment_thank_you_page_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'cityestate' ),
            'default'  => 'Thank you for your payment',
        ),

        array(
            'id'       => 'payment_thank_you_page_info',
            'type'     => 'editor',
            'title'    => esc_html__( 'Message', 'cityestate' ),
            'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in augue rhoncus, congue neque eu, consequat quam. Maecenas in cursus dui, sed tempor est. Duis varius nibh in lorem venenatis, in tincidunt nunc scelerisque.',
            'args'   => array( 'teeny' => true, 'textarea_rows' => 10 )
        ),

        array(
            'id'     => 'direct-pay-info',
            'type'   => 'info',
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Direct pay / Wire Transfer</span>', 'cityestate' ), $allowed_html_array),
        ),

        array(
            'id'       => 'wire_payment_thank_you_page_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'cityestate' ),
            'default'  => 'Thank you. Your property has been submitted.',
        ),
        array(
            'id'       => 'wire_payment_thank_you_page_info',
            'type'     => 'editor',
            'title'    => esc_html__( 'Message', 'cityestate' ),
            'default'  => 'Directly pay into our bank aoccount using Order Id as payment reference.',
            'args'   => array( 'teeny' => true, 'textarea_rows' => 10 )
        ),

    )

));

?>