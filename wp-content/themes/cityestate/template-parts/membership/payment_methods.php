<?php

// Get current user info
global $current_user;
$current_user   = wp_get_current_user();
$user_id        = $current_user->ID;

// Get detail from backend
$terms_conditions       = cityestate_option( 'payment_page_term_condition' );
$active_paypal          = cityestate_option( 'active_paypal_payment' );
$active_stripe          = cityestate_option( 'active_stripe_payment' );
$active_bank_transfer   = cityestate_option( 'active_wire_transfer_payment' );

// Get current package info
$package_id     = isset( $_GET['selected_package'] ) ? $_GET['selected_package'] : '';
$package_price  = get_post_meta( $package_id, 'package_price', true );
$package_title  = get_the_title( $package_id );

// Declare html array
$allowe_html = array( 'a' => array( 'href' => array(), 'title' => array() ) );

// Check package price is set
if( $package_price > 0 ){ ?>
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
                <!-- Set stripe payment form -->
                <?php cityestate_stripe_payment_membership( $package_id, $package_price, $package_title ); ?>
            </div>
        </div>    
        <div class="method-type"><img src="<?php echo get_template_directory_uri(); ?>/images/stripe-icon.jpg" alt="stripe"></div>
    </div>    
    <?php } ?>
    <!-- Check direct bank transfer payment is active -->
    <?php if( $active_bank_transfer != 0 ){ ?>
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
<?php } ?>
<!-- Store package id and cost -->
<input type="hidden" name="cityestate_package_id" value="<?php echo esc_attr($package_id); ?>">
<input type="hidden" name="cityestate_package_price" value="<?php echo esc_attr($package_price); ?>">
<?php if( $package_price > 0 ){ ?>
    <!-- Complete membership payment link and agree document -->
    <button id="cityestate_complete_membership" type="submit" class="btn btn-success btn-submit"> <?php esc_html_e( 'Complete Membership', 'cityestate' ); ?> </button>
    <span class="help-block"><?php echo sprintf( wp_kses(__( 'By clicking "Complete Membership" you agree to our <a href="%s">Terms & Conditions</a>', 'cityestate' ), $allowe_html ), get_permalink($terms_conditions) ); ?></span>
<?php } else {
    // Check user is logged
    if( is_user_logged_in() ){
        // Check user free package status
        $free_package_status = get_the_author_meta( 'user_free_package_status' , $user_id );
        if( empty($free_package_status) || $free_package_status != 'yes' ){ ?>        
            <button id="cityestate_complete_membership" type="submit" class="btn btn-success btn-submit"> <?php esc_html_e( 'Complete Membership', 'cityestate' ); ?></button>
            <span class="help-block"><?php echo sprintf( wp_kses(__( 'By clicking "Complete Membership" you agree to our <a href="%s">Terms & Conditions</a>', 'cityestate' ), $allowe_html ), get_permalink($terms_conditions) ); ?></span>
        <?php } else { ?>
            <span class="help-block free-membership-used"><?php esc_html_e( 'You have already used your free package, please choose different package.', 'cityestate' ); ?></span><?php
        }
    } else { ?>
        <button id="cityestate_complete_membership" type="submit" class="btn btn-success btn-submit"> 
            <?php esc_html_e('Complete Membership', 'cityestate' ); ?>
        </button>
        <span class="help-block"><?php echo sprintf (wp_kses(__( 'By clicking "Complete Membership" you agree to our <a href="%s">Terms & Conditions</a>', 'cityestate' ), $allowe_html ), get_permalink($terms_conditions) ); ?></span><?php
    }

} ?>