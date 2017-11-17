<?php

// Get property listing price and term and condition page
$terms_conditions   = cityestate_option( 'payment_page_term_condition' );
$price_per_listing  = cityestate_option( 'price_per_listing' );
$property_id        = isset( $_GET['property_id'] ) ? $_GET['property_id'] : '';

// Declare html array
$allowe_html = array( 'a' => array( 'href' => array(), 'title' => array() ) );

// Get payment methods
$active_paypal      = cityestate_option( 'active_paypal_payment' );
$active_stripe      = cityestate_option( 'active_stripe_payment' );
$active_direct_bank = cityestate_option( 'active_wire_transfer_payment' ); ?>

<div class="choose_payment_method">
    <!-- Check paypal payment method is active -->
    <?php if( $active_paypal != 0 ){ ?>
    <div class="choose_payment_section">
        <div class="choose_payment_type">
            <div class="radio">
                <label>
                    <input type="radio" class="payment_paypal" name="cityestate_payment_type" value="paypal" checked>
                    <?php esc_html_e( 'Paypal', 'cityestate'); ?>
                </label>
            </div>
        </div>
        <div class="method-type"><img src="<?php echo get_template_directory_uri(); ?>/images/paypal-icon.jpg" alt="paypal"></div>
    </div>    
    <?php } 
    // Check stripe payment method is active
    if( $active_stripe != 0 ){ ?>
    <div class="choose_payment_section">
        <div class="choose_payment_type">
            <div class="radio">
                <label>
                    <input type="radio" class="payment_stripe" name="cityestate_payment_type" value="stripe">
                    <?php esc_html_e( 'Stripe', 'cityestate'); ?>
                </label>
                <?php cityestate_stripe_per_listing( $property_id, $price_per_listing ); ?>
            </div>
        </div>    
        <div class="method-type"><img src="<?php echo get_template_directory_uri(); ?>/images/stripe-icon.jpg" alt="stripe"></div>
    </div>    
    <?php } ?>
    <!-- Check direct bank transfer payment is active -->
    <?php if( $active_direct_bank != 0 ){ ?>
    <div class="choose_payment_section">
        <div class="choose_payment_type">
            <div class="radio">
                <label>
                    <input type="radio" name="cityestate_payment_type" value="direct_pay">
                    <?php esc_html_e( 'Direct Transfer To Bank ', 'cityestate' ); ?>
                </label>
            </div>
        </div>
        <div class="method-type method-description">
            <p><?php esc_html_e( 'Make your payment direct into your bank account. Please use order ID as the payment reference', 'cityestate' ); ?></p>
        </div>
    </div>
    <?php } ?>
</div>
<!-- Store the property id and price -->
<input type="hidden" id="property_id" name="property_id" value="<?php echo intval( $property_id ); ?>">
<input type="hidden" id="listing_price" name="listing_price" value="<?php echo esc_attr($price_per_listing); ?>">
<button id="cityestate_property_order" type="button" class="btn btn-success btn-submit"> <?php esc_html_e( 'Complete Payment', 'cityestate' ); ?> </button>
