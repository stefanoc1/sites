<?php

// Email Management
Redux::setSection( $opt_name, array(

    'title'  => esc_html__( 'Manage Emails', 'cityestate' ),
    'id'     => 'cityestate-email-management',
    'desc'   => esc_html__( 'Global variables: %website_url as website url,%website_name as website name, %user_email as user_email, %username as username', 'cityestate' ),
    'icon'   => 'el-icon-envelope',
    'fields' => array(

        array(
            'id'     => 'email-new-user-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">New Registered User</span>', 'cityestate' ), $allowed_html_array),
            'desc'   => esc_html__( '%user_login_register as username, %user_pass_register as user password, %user_email_register as new user email', 'cityestate' )
        ),

        array(
            'id'       => 'register_user_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for New User Registration', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for new user registration', 'cityestate' ),
            'default'  => esc_html__( 'Your username and password on %website_url', 'cityestate' ),
        ),

        array(
            'id'       => 'register_user_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for New User Registration', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for new user registration', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
Thank you for Register in our site.  
Your registration has been successfully done.
Welcome to %website_url! You can login now using the below credentials:
Username:%user_login_register
Password: %user_pass_register
If you have any problems, please contact us.
Thank you!', 'cityestate' ),
        ),

        array(
            'id'     => 'email-purchase-activated-package-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Purchase And Activated Packages</span>', 'cityestate' ), $allowed_html_array),
            'subtitle' => esc_html__( 'Packages wire transfer and other payments gateways purchase activate', 'cityestate' ),
        ),

        array(
            'id'       => 'purchase_is_active_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Purchase and Activated', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for purchase and activated', 'cityestate' ),
            'default'  => esc_html__( 'Your purchase was activated', 'cityestate' ),
        ),

        array(
            'id'       => 'purchase_is_active_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Purchase and Activated', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for Purchase and Activated', 'cityestate' ),
            'default'  => esc_html__( "Hi,
Thank you for purchasing a plan with us. We are excited you have chosen our site %website_name to list your property . %website_name is a great place to sale and search properties.

Your plan on  %website_url has been activated! You can now list your properties according to you plan.

Thank you.", 'cityestate' ),
        ),

        array(
            'id'     => 'email-purchase-activated-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Purchase and Activated</span>', 'cityestate' ), $allowed_html_array),
            'subtitle' => esc_html__( 'Per listing wire transfer purchase activate', 'cityestate' ),             
        ),

        array(
            'id'       => 'wire_purchase_is_active_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Purchase and Activated', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for purchase activated', 'cityestate' ),
            'default'  => esc_html__( 'Your purchase was activated', 'cityestate' ),
        ),

        array(
            'id'       => 'wire_purchase_is_active_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Purchase and Activated', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for Purchase and Activated', 'cityestate' ),
            'default'  => esc_html__( 'Hi,

Your purchase on %website_url is activated! You have to go and check it on our website.

Thank you.', 'cityestate' ),
        ),        

        array(
            'id'     => 'email-paid-perlisting-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Paid Submission Per Listing.</span>', 'cityestate' ), $allowed_html_array),
            'subtitle' => esc_html__( 'you can use %invoice_no as invoice number, %listing_title as listing title and %listing_id as listing id', 'cityestate' ),             
        ),

        array(
            'id'       => 'paid_submit_property_listing_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Paid Submission', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for paid submission per listing', 'cityestate' ),
            'default'  => esc_html__( 'Your new listing on %website_url', 'cityestate' ),
        ),

        array(
            'id'       => 'paid_submit_property_listing_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Paid Submission', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for paid submission per listing', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
You have submitted new property on  %website_url!
Property Title: %listing_title
Property ID:  %listing_id
The invoice number is: %invoice_no
Thank you.', 'cityestate' ),
        ),

        array(
            'id'     => 'email-featured-perlisting-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Featured Property Per Listing.</span>', 'cityestate' ), $allowed_html_array),
            'subtitle' => esc_html__( 'you can use %invoice_no as invoice number, %listing_title as listing title and %listing_id as listing id', 'cityestate' ),             
        ),

        array(
            'id'       => 'paid_featured_submit_property_listing_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Featured Property', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for featured property per listing', 'cityestate' ),
            'default'  => esc_html__( 'New featured upgrade on %website_url', 'cityestate' ),
        ),

        array(
            'id'       => 'paid_featured_submit_property_listing_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Featured Property', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for featured property per listing', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
You have a new featured property on  %website_url!
Property Title: %listing_title
Property ID:  %listing_id
The invoice number is: %invoice_no
Thank you.', 'cityestate' ),
        ),

        array(
            'id'     => 'email-membership-cancelled-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Membership Cancelled</span>', 'cityestate' ), $allowed_html_array),            
        ),

        array(
            'id'       => 'membership_expired',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Membership Cancellation', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for membership cancellation', 'cityestate' ),
            'default'  => esc_html__( 'Membership Cancellation on %website_url', 'cityestate' ),
        ),
        
        array(
            'id'       => 'membership_expired_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Membership Cancellation', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for membership cancellation', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
Your subscription on %website_url has been cancelled because it expired or the recurring payment from the merchant was not processed. All your properties are no longer visible for our visitors but remain in your account.
Thank you.', 'cityestate' ),
        ),

        array(
            'id'     => 'email-expired-listing-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Expired Listings Resubmit For Approval.</span>', 'cityestate' ), $allowed_html_array),
            'desc'   => esc_html__( '%submission_title as property title, %submission_url as property submission url', 'cityestate')
        ),

        array(
            'id'       => 'admin_expired_listing_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Admin - Expired Listing', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for admin expired listing', 'cityestate' ),
            'default'  => esc_html__( 'Expired Listing sent for approval on %website_url', 'cityestate' ),
        ),

        array(
            'id'       => 'admin_expired_listing_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Admin - Expired Listing', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for admin expired listing', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
A user has re-submited a new property on %website_url! You should go and check it out on our site.
The property title: %submission_title.
Thank you.', 'cityestate' ),
        ),

        array(
            'id'     => 'email-wire-transfer-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">New Wire Transfer.</span>', 'cityestate' ), $allowed_html_array),
            'desc'   => esc_html__( 'you can use %invoice_no as invoice number, %total_price as total price and %payment_details as payment details', 'cityestate' )
        ),

        array(
            'id'       => 'new_wire_transfer_request_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for New wire Transfer', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for New wire Transfer', 'cityestate' ),
            'default'  => esc_html__( 'You ordered a new Wire Transfer', 'cityestate' ),
        ),

        array(
            'id'       => 'new_wire_transfer_request_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for New wire Transfer', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for New wire Transfer', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
We received your Wire Transfer payment request on  %website_url  !
Please follow the instructions below in order to start submitting properties as soon as possible.
The invoice number is: %invoice_no, Amount: %total_price.
Instructions:  %payment_details.
Thank you.', 'cityestate' ),
        ),

        array(
            'id'       => 'admin_new_wire_transfer_request_subject',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject Notify to Admin - New wire Transfer', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for New wire Transfer', 'cityestate' ),
            'default'  => esc_html__( 'Somebody ordered a new Wire Transfer', 'cityestate' ),
        ),

        array(
            'id'       => 'admin_new_wire_transfer_request_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content Notify to Admin - New wire Transfer', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for New wire Transfer to admin', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
We received your Wire Transfered payment request on  %website_url  !
Please follow the instructions below in order to start submission of properties as soon as possible.
The invoice number is: %invoice_no, Amount: %total_price.
Instructions:  %payment_details.
Thank you.', 'cityestate' ),
        ),        

        array(
            'id'     => 'email-approved-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Approved Submitted Listing</span>', 'cityestate' ), $allowed_html_array),
            'subtitle' => esc_html__('You can use %listing_title as listing title, %listing_url as listing link', 'cityestate'),
            'desc'   => ''
        ),

        array(
            'id'       => 'listing_approved_by_admin_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Approved Submitted Listing', 'cityestate'),
            'subtitle' => esc_html__('Email subject for approved submitted listing', 'cityestate'),
            'desc'     => '',
            'default'  => esc_html__('Your listing approved', 'cityestate'),
        ),
        array(
            'id'       => 'listing_approved_by_admin_message',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Submitted Listing Approved', 'cityestate'),
            'subtitle' => esc_html__('Email content for submitted listing approved', 'cityestate'),
            'desc'     => '',
            'default'  => esc_html__("Hi,
Your submitted property on %website_url has been approved.
Listins Title:%listing_title
Listing Url: %listing_url
Thank you.", 'cityestate'),
        ),

        array(
            'id'     => 'email-expired-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Notify about Expired Listing</span>', 'cityestate' ), $allowed_html_array),
            'subtitle' => esc_html__('You can use %listing_title as listing title, %listing_url as listing link', 'cityestate'),
            'desc'   => ''
        ),

        array(
            'id'       => 'listing_expired_by_admin_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject for Notify about Expired Listing', 'cityestate'),
            'subtitle' => esc_html__('Email subject for expired listing', 'cityestate'),
            'desc'     => '',
            'default'  => esc_html__('Your listing expired', 'cityestate'),
        ),
        array(
            'id'       => 'listing_expired_by_admin_message',
            'type'     => 'textarea',
            'title'    => esc_html__('Content for Notify about Listing Expired', 'cityestate'),
            'subtitle' => esc_html__('Email content for listing expired', 'cityestate'),
            'desc'     => '',
            'default'  => esc_html__("Hi,
Your submitted property on %website_url has been expired.

Listins Title:%listing_title
Listing Url: %listing_url

Thank you.", 'cityestate'),
        ),

        array(
            'id'     => 'email-free-listing-expired-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Free Listing Expired</span>', 'cityestate' ), $allowed_html_array),
            'desc'   => esc_html__( 'Can use %expired_listing_url as expired listing url and %expired_listing_name as expired listing name', 'cityestate')
        ),

        array(
            'id'       => 'free_listing_expired_subjeact',
            'type'     => 'text',
            'title'    => esc_html__( 'Subject for Free Listing Expired', 'cityestate' ),
            'subtitle' => esc_html__( 'Email subject for free listing expired', 'cityestate' ),
            'default'  => esc_html__( 'Free Listing expired on %website_url', 'cityestate' ),
        ),

        array(
            'id'       => 'free_listing_expired_message',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Content for Free Listing Expired', 'cityestate' ),
            'subtitle' => esc_html__( 'Email content for free listing expired', 'cityestate' ),
            'default'  => esc_html__( 'Hi,
One of your free submitted property on  %website_url has &quot;expired&quot;. The listing is %expired_listing_url.
Thank you.', 'cityestate' ),
        ),
    )
));

?>