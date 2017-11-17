<?php
/*
    Template Name: Packages 
*/
get_header();

// Check user is login
if( !is_user_logged_in() ){
    wp_redirect( home_url() );
}

// Declare global variable
global $theme_labels, $current_user;

// Get current user info
wp_get_current_user();
$user_id = $current_user->ID;

// Get user package status
$package_list           = get_the_author_meta( 'package_list' , $user_id );
$submit_property_type   = cityestate_option( 'submit_property_type' );

// Check property submit is membership
if( $submit_property_type != 'membership' ){
    // Redirect to home page
    wp_redirect( home_url() );
}

// Check user membership status
if( cityestate_user_active_membership($user_id) && $package_list > 0 ){
    // Redirect to home page
    wp_redirect( home_url() );
} ?>
<div class="membership-page-top">
    <div class="container">
        <!-- Show submit property progress -->
        <?php get_template_part( 'template-parts/create_listing_top' ); ?>
    </div>
</div>

<div class="membership-content-area">
    <div class="cityestate-module package-table-module">
        <div class="container">
            <div class="row"><?php
                // Collect package args and run query
                $args = array( 'post_type' => 'citystate_packages', 
                               'posts_per_page' => -1, 
                               'meta_query' =>  
                                array( array( 'key' => 'package_show', 
                                              'value' => 'yes', 
                                              'compare' => '=' ) ) 
                            );
                $package_query = new WP_Query($args);

                // Check how many package found
                $total_packages = $package_query->found_posts;

                // Set package column
                if( $total_packages == 3 ){
                    // Set 3 package column class
                    $package_classes = 'col-md-4 col-sm-4 col-xs-12';
                } else if( $total_packages == 4 ){
                    // Set 4 package column class
                    $package_classes = 'col-md-3 col-sm-6';
                } else if( $total_packages == 2 ){
                    // Set 2 package column class
                    $package_classes = 'col-md-4 col-sm-6';
                } else if( $total_packages == 1 ){
                    // Set 1 package column class
                    $package_classes = 'col-md-4 col-sm-12';
                } else {
                    // Set other package column class
                    $package_classes = 'col-md-3 col-sm-6';
                }

                $i = 0;
                while( $package_query->have_posts() ): $package_query->the_post(); 
                    
                    $i++;

                    // Get package detail
                    $package_unlimited  = get_post_meta( get_the_ID(), 'package_unlimited_list', true );
                    $package_price      = get_post_meta( get_the_ID(), 'package_price', true );
                    $package_list       = get_post_meta( get_the_ID(), 'package_list', true );
                    $package_popular    = get_post_meta( get_the_ID(), 'package_popular', true );
                    $package_featured   = get_post_meta( get_the_ID(), 'package_featured', true );
                    $package_bill       = get_post_meta( get_the_ID(), 'package_time', true );
                    $package_frquency   = get_post_meta( get_the_ID(), 'package_unit', true );
                    
                    // Set bill plural label
                    if( $package_frquency > 1 ) {
                        $package_bill .='s';
                    }
                    
                    // Get price symbol and currency symbol position
                    $price_symbol       = cityestate_option( 'property_price_symbol' );
                    $currency_position  = cityestate_option( 'property_price_position' );
                    
                    // Get payment page link
                    $payment_page_link = cityestate_find_template_url('templates/template_payment.php');
                    // Set payment proccess libk
                    $payment_process_link = add_query_arg( 'selected_package', get_the_ID(), $payment_page_link );

                    // Set property currency position
                    if( $currency_position == 'before' ) {
                        $package_price = '<span class="price-before">'.esc_html($price_symbol).'</span><span class="price-number">'.esc_html($package_price).'</span>';
                    } else {
                        $package_price = '<span class="price-number">'.esc_html($package_price).'</span><span class="price-before">'.esc_html($price_symbol).'</span>';
                    }

                    // Check package is popular
                    if( $package_popular == "yes" ) {
                        $is_popular = 'active';
                    } else {
                        $is_popular = '';
                    }                    

                    // Set package column
                    $column = '';
                    if( $i == 1 && $total_packages == 2 ) {
                        $column = 'col-md-offset-2 col-sm-offset-0';
                    } else if (  $i == 1 && $total_packages == 1  ) {
                        $column = 'col-md-offset-4 col-sm-offset-0';
                    } else {
                        $column = '';
                    } ?>

                    <div class="<?php echo esc_attr( $package_classes.' '.$column ); ?>">
                        <div class="package-block <?php esc_attr( $is_popular, 'cityestate' ); ?>">
                            <!-- Show package title -->
                            <h3 class="package-title"><?php the_title(); ?></h3>
                            <h1 class="package-price">
                                <!-- Show package price -->
                                <?php echo $package_price; ?>
                            </h1>
                            <ul class="package-list">
                                <!-- Package time period -->
                                <li><i class="fa fa-check"></i> <?php esc_html_e( 'Time Period:', 'cityestate' ); ?> <strong><?php echo esc_attr( $package_frquency ).' '.esc_attr( $package_bill ); ?></strong></li>
                                <!-- Package property list -->
                                <li><i class="fa fa-check"></i> <?php esc_html_e( 'Properties:', 'cityestate' ); ?>
                                    <?php if( $package_unlimited == 1 ) { ?>
                                        <!-- Package unlimited listing -->
                                        <strong><?php esc_html_e( 'Unlimited Listings', 'cityestate' ); ?></strong>
                                    <?php } else { ?>
                                        <!-- Package limited listing -->
                                        <strong><?php echo esc_attr( $package_list ); ?></strong>
                                    <?php } ?>
                                </li>
                                <!-- Package featured listing -->
                                <li><i class="fa fa-check"></i> <?php esc_html_e( 'Featured Listings:', 'cityestate' ); ?> <strong><?php echo esc_attr( $package_featured ); ?></strong></li>
                            </ul>
                            <div class="package-link">
                                <!-- Choose package link -->
                                <a href="<?php echo esc_url($payment_process_link); ?>" class="btn btn-primary btn-lg"><?php esc_html_e( 'Get Started', 'cityestate' ); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                // Reset wp query
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <div class="vertical-space-60"></div>
</div>

<?php get_footer(); ?>