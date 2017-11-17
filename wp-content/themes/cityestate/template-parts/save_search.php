<?php
// Get search query
global $search_query;

// Declare variable
$search_parameters = $min_price = $max_price = '';

// Check search property keyword
if( isset($_GET['keyword']) && !empty($_GET['keyword']) ){
    $search_parameters = $_GET['keyword'].', ';
}

// Check search property type
if( isset($_GET['type']) && !empty($_GET['type']) ){
    $search_parameters .= $_GET['type'].', ';
}

// Check search property status
if( isset($_GET['status']) && !empty($_GET['status']) ){
    $search_parameters .= $_GET['status'].', ';
}

// Check search property location
if( isset($_GET['location']) && !empty($_GET['location']) ){
    $search_parameters .= esc_html__('In', 'cityestate').' '.$_GET['location'].', ';
}

// Check search property bedroom
if( isset($_GET['bedrooms']) && !empty($_GET['bedrooms']) && $_GET['bedrooms'] != 'all' ){
    $search_parameters .= $_GET['bedrooms'].' '.esc_html__('Bedrooms', 'cityestate').', ';
}

// Check search property bathroom
if( isset($_GET['bathrooms']) && !empty($_GET['bathrooms']) && $_GET['bathrooms'] != 'all') {
    $search_parameters .= $_GET['bathrooms'].' '.esc_html__('Bathrooms', 'cityestate').', ';
}

// Check search property garages
if( isset($_GET['garages']) && !empty($_GET['garages']) && $_GET['garages'] != 'all') {
    $search_parameters .= $_GET['garages'].' '.esc_html__('Garages', 'cityestate').', ';
}

// Check search property min price
if( isset($_GET['min_price']) && !empty($_GET['min_price'] ) ){
    $min_price = $_GET['min_price'];
}

// Check search property max price
if( isset($_GET['max_price']) && !empty($_GET['max_price']) ){
    $max_price = $_GET['max_price'];
}

// Check search property min and max price
if( !empty($min_price) && !empty($max_price) ){
    $search_parameters .= esc_html__( 'From', 'cityestate' ).' '.esc_attr( $min_price ).' '.esc_html__( 'to', 'cityestate' ).' '.esc_attr( $max_price );
} else {
    // Check min price is set
    if( !isset($_GET['min_price']) ){
        $min_price              = cityestate_option('adv_sea_min_price');
        $search_parameters     .= esc_html__('From', 'cityestate').' '.esc_attr( $min_price ).' '.esc_html__( 'to', 'cityestate' ).' '.esc_attr( $max_price );
    }
    // Check min and max price is empty
    if( empty($min_price) && empty($max_price) ){
        $min_price              = cityestate_option('adv_sea_min_price');
        $max_price              = cityestate_option('adv_sea_max_price');
        $search_parameters     .= esc_html__('From', 'cityestate').' '.esc_attr( $min_price ).' '.esc_html__( 'to', 'cityestate' ).' '.esc_attr( $max_price );
    }
} ?>
<div class="list-search">
    <form method="post" id="save_search_form">
        <div class="input-level-down input-icon">
            <?php    
                $search_para = "";
                if( function_exists('cityestate_encode') ){
                    $search_para = cityestate_encode( $search_query );
                }
            ?>
            <!-- Property search parameter -->
            <input placeholder="<?php esc_html__( 'Search Listing', 'cityestate' ); ?>" value="<?php echo esc_attr( $search_parameters ); ?>">
            <!-- Encode query -->
            <input type="hidden" name="search_para" value='<?php print $search_para; ?>'>
            <input type="hidden" name="search_link" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="action" value='cityestate_save_search'>
            <!-- Search query security -->
            <input type="hidden" name="cityestate_save_search_ajax" value="<?php echo wp_create_nonce('cityestate_save_search_nonce'); ?>">
        </div>
        <span id="result_save_search" class="save-btn"><?php esc_html_e( 'Save', 'cityestate' ); ?></span>
    </form>
</div>
