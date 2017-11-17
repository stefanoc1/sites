<?php
// Get current user info
global $current_user;
wp_get_current_user();
$user_id = $current_user->ID;

$property_type = cityestate_option( 'submit_property_type' );

// Declare variable
$payment = $thankyou = $packages = $submit = '';

// Check is template payment page
if( is_page_template( 'templates/template_payment.php' ) ){
    $payment = 'active';
// Check is template thank you page
} else if( is_page_template( 'templates/payment_thankyou.php' ) ){
    $thankyou = 'active';
// Check is template package page
} else if( is_page_template( 'templates/template_package.php' ) ){
    $packages = 'active';
// Check is template submit property
} else if( is_page_template( 'templates/dashboard_submit_property.php' ) ){
    $submit = 'active';
} ?>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="membership-page-title">
            <!-- Page title -->
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
        <ol class="pay-step-bar">
            <!-- Pregress title -->
            <li class="pay-step-block <?php echo esc_attr( $submit ); ?>"><span><?php esc_html_e( "Create Listing", "cityestate" ); ?></span></li>
            <?php
            // Check property submission type
            if( $property_type == 'membership' ){
                // Check user has membership
                if( !cityestate_user_active_membership($user_id) ){ ?>
                    <li class="pay-step-block <?php echo esc_attr( $packages ); ?>"><span><?php esc_html_e( "Select a Package", "cityestate" ); ?></span></li>
                    <li class="pay-step-block <?php echo esc_attr( $payment ); ?>"><span><?php esc_html_e( "Payment", "cityestate" ); ?></span></li><?php 
                }
            // Check user has per listing plan
            } else if( $property_type == 'per_listing' ){
                echo '<li class="pay-step-block '.$payment.'"><span>'.esc_html__( "Payment", "cityestate" ).'</span></li>';
            } ?>
            <!-- Done button -->
            <li class="pay-step-block <?php echo esc_attr( $thankyou ); ?>"><span><?php esc_html_e( "Done", "cityestate" ); ?></span></li>
        </ol>
    </div>
</div>
