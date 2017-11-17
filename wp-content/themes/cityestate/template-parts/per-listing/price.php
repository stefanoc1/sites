<!-- Pay listing price -->
<h3 class="side-block-title"><?php esc_attr_e( 'Pay Listing', 'cityestate' ); ?></h3><?php

// Get price symbol
$price_symbol   = cityestate_option( 'property_price_symbol' );

// Get price currency
$currency       = cityestate_option( 'property_price_position' );

// Get price per listing
$per_listing    = cityestate_option( 'price_per_listing' );

// Set currency position
if( $currency == 'before' ){
    $per_listing = $price_symbol.' '.$per_listing;
} else {
    $per_listing = $per_listing.' '.$price_symbol;
} ?>

<ul class="pkg-total-list">
    <!-- Show listing price -->
    <li>
        <span class="pull-left"><?php esc_html_e('Listing Price:', 'cityestate' ); ?></span>
        <span class="pull-right"><?php echo esc_attr( $per_listing ); ?></span>
    </li>
    <!-- Show total price -->
    <li>
        <span class="pull-left"><?php esc_html_e('Total Price:', 'cityestate' ); ?></span>
        <span class="pull-right"><?php echo esc_attr( $per_listing ); ?></span>
    </li>
</ul>
