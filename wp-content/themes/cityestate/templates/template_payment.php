<?php
/*
    Template Name: Payment Page
*/
get_header();

// Define global variable
global $theme_labels, $current_user;

// Check user is login
if( !is_user_logged_in() ){
    wp_redirect( home_url());
}

// Get selected package id
$package_id = isset( $_GET['selected_package'] ) ? $_GET['selected_package'] : '';

// Get property id
$property_id = isset( $_GET['property_id'] ) ? $_GET['property_id'] : '';

// Check property id is set
if( empty( $package_id ) && empty( $property_id ) ){
    wp_redirect( home_url() );
} ?>
<div class="membership-page-top">
    <div class="container">
        <!-- Show property payment progress -->
        <?php get_template_part( 'template-parts/create_listing_top' ); ?>
    </div>
</div>
<div class="membership-content-area">
    <div class="container">
        <div class="row">
            <!-- Get property submit type -->
            <?php $submit_property_type = cityestate_option( 'submit_property_type' ); ?>
            <div class="col-lg-8 col-md-8 col-sm-12 container-contentbar">
                <div class="membership-content property_payment_area">
                    <!-- Get stripe payment page link -->
                    <?php $stripe_link = cityestate_find_template_url('templates/template_stripe_payment.php'); ?>
                    <form method="post" id="cityestate_payment_form" action="<?php echo esc_url($stripe_link); ?>"><?php 
                        // Get package price
                        $package_price = get_post_meta( $package_id, 'package_price', true );
                        
                        // Check package price is zoro or not
                        if( $package_price > 0 ){ ?>
                            <div class="info-title">
                                <h2 class="info-title-left"><?php echo esc_html($theme_labels['payment_method']); ?></h2>
                            </div><?php 
                        }
                        
                        // Check payment for property
                        if( $submit_property_type == 'membership' ){
                            // Add membership payment thod
                            get_template_part('template-parts/membership/payment_methods');
                        } else if ( $submit_property_type == 'per_listing' ) {
                            // Add listing payment thod
                            get_template_part('template-parts/per-listing/payment_methods');
                        } ?>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar">
                <aside id="sidebar">
                    <div class="payment-side-block">
                       <?php
                       // Check payment for membership or listing
                       if( $submit_property_type == 'membership' ){
                           // Show price for membership
                           get_template_part('template-parts/membership/price');
                       } else if( $submit_property_type == 'per_listing' ){
                           // Show price for listing
                            get_template_part('template-parts/per-listing/price');
                       } ?>
                    </div>                    
                </aside>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>