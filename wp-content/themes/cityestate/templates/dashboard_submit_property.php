<?php
/*
    Template Name: Dashboard Submit Property
*/

// Check user is login
if( !is_user_logged_in() ){
    wp_redirect( home_url() );
}

global $current_user;
wp_get_current_user();
$user_id = $current_user->ID;
$user_email = $current_user->user_email;

// Get submit property type
$submit_property_type = cityestate_option( 'submit_property_type' );
// Get payment page link
$payment_page_link = cityestate_find_template_url( 'templates/template_payment.php' );
// Get thank you page link
$thankyou_page_link = cityestate_find_template_url( 'templates/payment_thankyou.php' );

// Check property action
if( isset( $_POST['action'] ) ){

    // Get property action
    $action = $_POST['action'];

    // Verify nonce 
    if( wp_verify_nonce($_POST['submit_property_nonce'], 'submit_property_security') ){
        // Check property submission type is per listing
        if( $submit_property_type == 'per_listing' ){
            // Call property submit filters
            $property_id = apply_filters( 'cityestate_submit_property', array( 'post_type' => 'property' ) );

            // Check payment page link is set and action is submit property
            if( !empty($payment_page_link) && $action != 'update_property' ){
                // Set property submit url
                $url_sep = ( parse_url( $payment_page_link, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
                // Add property id
                $url_par = 'property_id=' . $property_id;
                // Redirect to payment page
                wp_redirect( $payment_page_link . $url_sep . $url_par );
            } else {
                // Get property listing page link
                $args = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_properties.php' );
                $listings_page = get_pages($args);                
                // Check is page link found
                if( $listings_page ){
                    $dashboard_listings = get_permalink( $listings_page[0]->ID );
                } else {
                    $dashboard_listings = home_url('/');
                }
                if( !empty($dashboard_listings) ){
                    // Set property submit url
                    $url_sep = ( parse_url( $dashboard_listings, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
                    // Add property id
                    $url_par = 'updated=1';
                    // Redirect to update page
                    wp_redirect( $dashboard_listings . $url_sep . $url_par );
                }
            }
        } else if( $submit_property_type == 'membership' ){
            // Get new property id
            $property_id = apply_filters( 'cityestate_submit_property', array( 'post_type' => 'property' )  );

            // Check user has membership
            if( cityestate_user_active_membership($user_id) ){
                // Redirect to thank you page
                wp_redirect($thankyou_page_link);
            }        
        } else {
            // Get new property id
            $property_id = apply_filters( 'cityestate_submit_property', array( 'post_type' => 'property' ) );            
            // Redirect to thank you page
            wp_redirect($thankyou_page_link);
        }
    }
}

get_header(); ?>

<section>
    <!-- Add user dashboard menu -->
    <?php get_template_part( 'template-parts/dashboard_menu'); ?>
    <div class="container">
        <div class="vertical-space-60"></div>
        <div class="invoice-container">
            <div class="membership-page-top">
                <div class="container">
                    <!-- Show submit property progress -->
                    <?php get_template_part('template-parts/create_listing_top'); ?>
                </div>
            </div>

            <div class="membership-content-area">
                <div class="container"><?php
                    // Check property submit or edit
                    if( isset($_GET['edit_property']) && !empty($_GET['edit_property']) ){
                        // Add property edit form
                        get_template_part( 'template-parts/property_edit' );            
                    } else {
                        // Add property submit form
                        get_template_part( 'template-parts/property_submit' );
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="vertical-space-100"></div>
    <div class="vertical-space-100"></div>
</section>

<?php get_footer();?>
