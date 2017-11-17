<?php 
// Show package title
esc_attr_e( 'Membership Package', 'cityestate' );

// Get price symbol
$price_symbol   = cityestate_option( 'property_price_symbol' );

// Get currency position
$currency       = cityestate_option( 'property_price_position' );

// Get package link
$package_page  = cityestate_find_template_url( 'templates/template_package.php' );

// Check is package is selected
if( isset( $_GET['selected_package'] ) ){
    // Get package detail
    $package_id         = isset( $_GET['selected_package'] ) ? $_GET['selected_package'] : '';
    $package_price      = get_post_meta( $package_id, 'package_price', true );
    $package_listings   = get_post_meta( $package_id, 'package_list', true );
    $featured_lists     = get_post_meta( $package_id, 'package_featured', true );
    $unlimited_list     = get_post_meta( $package_id, 'package_unlimited_list', true );
    $billing_period     = get_post_meta( $package_id, 'package_time', true );
    $billing_frquency   = get_post_meta( $package_id, 'package_unit', true );    
    
    // Check billing plural
    if( $billing_frquency > 1 ){
        $billing_period .='s';
    }
        
    // Set currency position
    if( $currency == 'before' ){
        $package_price = $price_symbol.' '.$package_price;
    } else {
        $package_price = $package_price.' '.$price_symbol;
    } ?>
    <ul class="pkg-total-list">
        <!-- Check user is login -->
        <?php if( is_user_logged_in() ){ ?>
        <li>
            <!-- Package change link -->
            <span id="cityestate_package_name" class="pull-left"><?php echo get_the_title( $package_id ); ?></span>
            <span class="pull-right"><a href="<?php echo esc_url( $package_page ); ?>"><?php esc_html_e( 'Change Package', 'cityestate' ); ?></a></span>
        </li>
        <?php } else { ?>
        <li>
            <!-- Package title -->
            <span id="cityestate_package_name" class="pull-left"><?php echo get_the_title( $package_id ); ?></span>
            <span class="pull-right"><a><?php echo get_the_title( $package_id ); ?></a></span>
        </li>
        <?php } ?>
        <!-- Package time -->
        <li>
            <span class="pull-left"><?php esc_html_e( 'Package Time:', 'cityestate' ); ?></span>
            <span class="pull-right"><strong><?php echo esc_attr( $billing_frquency ).' '.esc_attr( $billing_period ); ?></strong></span>
        </li>
        <!-- Package listing -->
        <li>
            <span class="pull-left"><?php esc_html_e( 'Listing Included:', 'cityestate' ); ?></span>
            <span class="pull-right">
                <?php if( $unlimited_list == 1 ) { ?>
                    <!-- Package unlimited listing -->
                    <strong><?php esc_html_e( 'Unlimited Listings', 'cityestate' ); ?></strong>
                <?php } else { ?>
                    <!-- Package listing -->
                    <strong><?php echo esc_attr( $package_listings ); ?></strong>
                <?php } ?>
            </span>
        </li>
        <!-- Package featured listing -->
        <li>
            <span class="pull-left"><?php esc_html_e( 'Featured Listing Included:', 'cityestate' ); ?></span>
            <span class="pull-right"><strong><?php echo esc_attr( $featured_lists ); ?></strong></span>
        </li>
        <!-- Package total price -->
        <li>
            <span class="pull-left"><?php esc_html_e( 'Total Price:', 'cityestate' ); ?></span>
            <span class="pull-right"><?php echo esc_attr( $package_price ); ?></span>
        </li>
    </ul><?php 
} ?>
