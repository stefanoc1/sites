<?php
/*
    Template Name: Dashboard Properties
*/
// Check user is login
if( !is_user_logged_in() ){
    wp_redirect(  home_url() );
}

get_header();



// Define global variables
global $theme_labels, $current_user, $post, $dashboard_list;

// Get current user info
wp_get_current_user();
$user_id = $current_user->ID;

// Get dashboard properties page link
$dashboard_list = cityestate_user_property_list();

$property_approve = add_query_arg( 'property_status', 'property_approve', $dashboard_list );
$property_pending = add_query_arg( 'property_status', 'property_pending', $dashboard_list );
$property_expired = add_query_arg( 'property_status', 'property_expired', $dashboard_list );

// Reset action variable
$action_approved = $action_pending = $action_expired = '';

// Check property status is approve
if( isset( $_GET['property_status'] ) && $_GET['property_status'] == 'property_approve' ){
    $action_approved    = 'class=active';
    $query_status       = 'publish';    

// Check property status is pending
} elseif( isset( $_GET['property_status'] ) && $_GET['property_status'] == 'property_pending' ){
    $action_pending     = 'class=active';
    $query_status       = 'pending';    

// Check property status is expired
} elseif( isset( $_GET['property_status'] ) && $_GET['property_status'] == 'property_expired' ){
    $action_expired     = 'class=active';
    $query_status       = 'expired';    
} else {
    $action_approved    = 'class=active';
    $query_status       = 'publish';    
}

// Get paged query for pagination
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

// Prepare property query
$args = array( 'post_type' => 'property', 'author' => $user_id, 'paged' => $paged, 'posts_per_page' => 10, 'post_status' => array( $query_status ) );

// Call get property query
$property_query = new WP_Query($args);

// Get package list page link
$packages_page_link = cityestate_find_template_url( 'templates/template_package.php' ); ?>

<section>
    <!-- Get user dashboard menu -->
    <?php get_template_part( 'template-parts/dashboard_menu'); ?>
    <div class="vertical-space-60"></div>
    <div class="container">
        <div class="user-dashboard-full invoice-container">
            <div class="profile-area-content">
                <div class="profile-top">
                    <div class="profile-top-left">
                        <!-- Get dashboard page title -->
                        <h3 class="title"><?php the_title(); ?></h3>
                    </div>
                    <div class="profile-top-right">
                        <div class="property_list_keyword_search">
                            <!-- Search property form -->
                            <form id="dashboard_property_autofill" method="POST">
                                <div class="table-list">
                                    <!-- Add property name -->
                                    <div class="form-group table-cell">
                                        <input name="property_name" id="property_name" placeholder="<?php echo esc_attr($theme_labels['search_listing']); ?>">
                                    </div>
                                    <!-- Show search property button -->
                                    <div class="table-cell">
                                        <button type="submit" class="agent_detail_contact"><?php echo esc_html($theme_labels['search']); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="account-block">
                    <div class="property_list_keyword">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="my-list-sidebar">
                                    <div class="my-property-menu">
                                        <!-- List property status tab -->
                                        <ul>
                                            <li><a href="<?php echo esc_url($property_approve); ?>" <?php echo esc_attr($action_approved); ?>><?php echo esc_html($theme_labels['published']); ?></a></li>
                                            <li><a href="<?php echo esc_url($property_pending); ?>" <?php echo esc_attr($action_pending); ?>><?php echo esc_html($theme_labels['pending']); ?></a></li>
                                            <li><a href="<?php echo esc_url($property_expired); ?>" <?php echo esc_attr($action_expired); ?>><?php echo esc_html($theme_labels['expired']); ?></a></li>
                                        </ul>
                                    </div>
                                    <?php 
                                    // Get property submit type
                                    $submit_property_type = cityestate_option( 'submit_property_type' );
                                    // Check is submit is membership type
                                    if( $submit_property_type == 'membership' ){ ?>
                                        <div class="my-property-menu menu-status"><?php
                                            // Get user package status
                                            $package_id             = get_the_author_meta( 'package_id', $user_id );
                                            $left_property          = get_the_author_meta( 'package_list' , $user_id );
                                            $left_featured_property = get_the_author_meta( 'package_featured' , $user_id );                                            

                                            // Check how many property submission is left
                                            if( $left_property == -1 ){
                                                $left_property = esc_html__( 'Unlimited', 'cityestate' );
                                            }

                                            // Check package id is available
                                            if( !empty( $package_id ) ){ 
                                                // Get package bill period
                                                $package_bill_period = get_post_meta( $package_id, 'cityestate_package_time', true );
                                                    
                                                // Set time in second
                                                $time_second = 0;
                                                switch( $package_bill_period ){
                                                    // Check package in day
                                                    case 'Day':
                                                        $time_second = 60*60*24;
                                                    break;
                                                    
                                                    // Check package in week
                                                    case 'Week':
                                                        $time_second = 60*60*24*7;
                                                    break;
                                                    
                                                    // Check package in month
                                                    case 'Month':
                                                        $time_second = 60*60*24*30;
                                                    break;
                                                    
                                                    // Check package in year
                                                    case 'Year':
                                                        $time_second = 60*60*24*365;
                                                    break;
                                                }

                                                
                                                // Get package bill time
                                                $package_bill_time  = get_post_meta( $package_id, 'cityestate_package_unit', true );
                                                
                                                // Get package activation date
                                                $package_date       = strtotime( get_user_meta( $user_id, 'package_activation', true ) );
                                                
                                                // Calculate package expired date
                                                $expired_date       = $package_date + ( $time_second * $package_bill_time );
                                                $expired_date       = date( 'Y-m-d', $expired_date );

                                                // Show package info
                                                echo '<div class="my-widget widget-current">';
                                                echo '<div class="my-title">'.esc_html__( 'Your Current Package', 'cityestate' ).'</div>';
                                                echo '<div class="my-widget-body">';
                                                echo '<div class="body-inner">';
                                                echo '<ul>';
                                                
                                                // Show package name
                                                $package_title = get_the_title( $package_id );
                                                echo '<li><strong>'.esc_attr( $package_title ).'</strong></li>';

                                                // Show package listing status
                                                $package_unmilited_list = get_post_meta( $package_id, 'package_unlimited_list', true );
                                                if( $package_unmilited_list == 1 ){
                                                    echo '<li><span>'.esc_html__( 'Listings Included: ','cityestate' ).'</span>'.esc_html__( 'unlimited listings ','cityestate' ).'</li>';
                                                    echo '<li><span>'.esc_html__( 'Listings Remaining: ','cityestate' ).'</span>'.esc_html__( 'unlimited listings ','cityestate' ).'</li>';
                                                } else {
                                                    $package_list = get_post_meta( $package_id, 'package_list', true );
                                                    echo '<li><span>'.esc_html__( 'Listings Included: ','cityestate' ).'</span>'.esc_attr( $package_list ).'</li>';
                                                    echo '<li><span>'.esc_html__( 'Listings Remaining: ','cityestate' ).'</span><span class="listings_remainings">'.esc_attr( $left_property ).'</span></li>';
                                                }

                                                // Show package featured listing status
                                                $package_featured = get_post_meta( $package_id, 'package_featured', true );                                                
                                                echo '<li><span>'.esc_html__( 'Featured Included: ','cityestate' ).'</span>'.esc_attr( $package_featured ).'</li>';
                                                echo '<li><span>'.esc_html__( 'Featured Remaining: ','cityestate' ).'</span><span class="featured_lists_remaining">'.esc_attr( $left_featured_property ).'</span></li>';
                                                
                                                // Show package expired date
                                                echo '<li><span>'.esc_html__( 'Ends On','cityestate' ).'</span>';
                                                echo ' '.esc_attr( $expired_date );
                                                echo '</li>';
                                                
                                                echo '</ul>';                                                
                                                echo '</div>';                                                
                                                echo '</div>';
                                                echo '</div>';
                                            } ?>
                                        </div>
                                        <div class="my-property-menu">
                                            <!-- Set package page link -->
                                            <a href="<?php echo esc_url($packages_page_link); ?>" class="btn btn-primary btn-block"> <?php echo esc_html__( 'Change Membership Plan', 'cityestate' ); ?></a>
                                        </div>
                                     <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <!-- Check have property found -->
                                <?php if( $property_query->have_posts() ) { ?>
                                    <div class="grid-row"><?php
                                        // Start property loop
                                        while( $property_query->have_posts()): $property_query->the_post();
                                            
                                            // Get property status
                                            $property_status = get_post_status( get_the_ID() );
                                            $status_label    = $property_status;
                                            
                                            // Get paymenr status
                                            $payment_status = get_post_meta( get_the_ID(), 'payment_status', true );

                                            // Check property submit type
                                            $submission_type      = cityestate_option( 'submit_property_type' );
                                            // Get price per listing
                                            $per_submission       = cityestate_option( 'price_per_listing' );
                                            $per_submission       = floatval( $per_submission );
                                            // Get price per featured listing
                                            $featured_submission  = cityestate_option( 'price_per_featured_listing' );
                                            $featured_submission  = floatval( $featured_submission );

                                            // Check property status
                                            if( $property_status == 'publish' ){
                                                // Approve property
                                                $property_status = '<span class="label label-success">'.esc_html__( 'Approved', 'cityestate' ).'</span>';
                                            } else if( $property_status == 'pending' ){
                                                // Pending property
                                                $property_status = '<span class="label label-warning">'.esc_html__( 'Under Approved', 'cityestate' ).'</span>';
                                            }  else if( $property_status == 'expired' ){
                                                // Expired property
                                                $property_status = '<span class="label label-danger">'.esc_html__( 'Expired', 'cityestate' ).'</span>';
                                                $payment_status = '<span class="label label-danger">'.esc_html__( 'Expired', 'cityestate' ).'</span>';
                                            } else {
                                                $property_status = '';
                                            }

                                            // Check property is expired or not
                                            if( $status_label != 'expired' ){
                                                // Check submission type
                                                if( $submission_type != 'no' && $submission_type != 'membership' ){
                                                    if( $payment_status == 'paid' ){
                                                        // Payment paid status
                                                        $payment_status = '<span class="label label-success">' . esc_html__( 'PAID', 'cityestate' ) . '</span>';
                                                    } else if( $payment_status == 'not_paid' ){
                                                        // Payment not paid status
                                                        $payment_status = '<span class="label label-warning">' . esc_html__( 'NOT PAID', 'cityestate' ) . '</span>';
                                                    } else {
                                                        $payment_status = '';
                                                    }
                                                } else {
                                                    $payment_status = '';
                                                }
                                            } ?>

                                            <div class="item-wrap">
                                                <div class="media my-property">
                                                    <div class="media-left">
                                                        <div class="figure-block">
                                                            <figure class="item-thumb"><?php 
                                                                // Get property featured label
                                                                $property_featured  = get_post_meta( get_the_ID(), 'featured', true );
                                                                if( $property_featured != 0 ){ ?>
                                                                    <span class="label-featured label"><?php esc_html_e( 'Featured', 'cityestate' ); ?></span>
                                                                <?php } ?>
                                                                <a href="<?php the_permalink() ?>"><?php
                                                                    // Show property image
                                                                    if( has_post_thumbnail( ) ){
                                                                        the_post_thumbnail( 'cityestate_property_thumb' );
                                                                    } else {
                                                                        // Show property default image
                                                                        cityestate_image_placeholder( 'cityestate_property_thumb' );
                                                                    } ?>
                                                                </a>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <div class="my-description">
                                                            <h4 class="my-heading">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <!-- Show property payment status and title -->
                                                                    <?php echo esc_html($payment_status); ?> <?php the_title(); ?>
                                                                </a>
                                                            </h4>
                                                            <p class="address"><?php 
                                                            // Get property address
                                                            $property_address = get_post_meta( get_the_ID(), 'property_map_address', true );
                                                            if( !empty( $property_address ) ){ 
                                                                // Show property address
                                                                echo esc_attr( $property_address ); 
                                                            } ?> </p>
                                                            <div class="status">
                                                                <!-- Show property status -->
                                                                <strong><?php esc_html_e( 'Status:', 'cityestate' ); ?></strong><?php 
                                                                $terms = wp_get_post_terms( get_the_ID(), 'property_status', array("fields" => "names") );
                                                                $trimed = '';
                                                                $temp_term = '';                                                                
                                                                if( !empty($terms) ){                                                                    
                                                                    foreach( $terms as $term ):
                                                                        $temp_term .= $term.', ';
                                                                    endforeach;

                                                                    $trimed = rtrim( $temp_term, ', ' );
                                                                } 
                                                                echo esc_html($trimed); ?> <br/>
                                                                <!-- Show property price -->
                                                                <strong><?php esc_html_e( 'Price:', 'cityestate' ); ?></strong> <?php echo cityestate_get_property_price(); ?> <br/>
                                                            </div>
                                                        </div>
                                                        <div class="payment_actions per_list_button">
                                                            <div class="btn-group"><?php 
                                                                // Get dashboard submit page link
                                                                $edit_link = cityestate_user_submit_property();
                                                                
                                                                // Create edit property link
                                                                $edit_link = add_query_arg( 'edit_property', get_the_ID(), $edit_link ) ; ?>
                                                                <a href="<?php echo esc_url($edit_link); ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Edit Property', 'cityestate' ); ?>"><i class="fa fa-edit"></i></a><?php 
                                                                
                                                                // Create and set delete property link
                                                                $delete_property = get_delete_post_link( get_the_ID(), '', true );
                                                                if( !empty($delete_property) ){ ?>
                                                                    <a onclick="return confirm('<?php esc_html_e( 'Are you sure you wish to delete?', 'cityestate' ); ?>')" href="<?php echo esc_url( $delete_property ); ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Delete Property', 'cityestate' ); ?>"><i class="fa fa-close"></i></a><?php
                                                                }

                                                                // Set property as featured
                                                                if( $submission_type == 'membership' && $property_featured != 1 && $status_label != 'expired' ){ ?>
                                                                    <a href="#" data-property_id="<?php echo intval( get_the_ID() ); ?>" class="make_featured_property action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Set as Featured', 'cityestate' ); ?>"><i class="fa fa-star"></i></a><?php 
                                                                }

                                                                // Set active the property
                                                                if( $status_label == 'expired' && $submission_type == 'membership' ){ ?>
                                                                    <a href="#" data-property_id="<?php echo intval( get_the_ID() ); ?>" class="cityestate_resend_for_approval action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Reactivate Listing', 'cityestate' ); ?>"><i class="fa fa-upload"></i></a><?php 
                                                                }

                                                                // Set property send for approve
                                                                if( $status_label == 'expired' && $submission_type == 'per_listing' ){ ?>
                                                                    <a href="#" data-property_id="<?php echo intval( get_the_ID() ); ?>" class="property_resend_for_approval action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Resend for Approval', 'cityestate' ); ?>"><i class="fa fa-upload"></i></a><?php 
                                                                } ?>
                                                            </div>
                                                            <?php 

                                                            // Add property payment button                                                            
                                                            if( $submission_type == 'per_listing' && $property_status != 'expired' ){
                                                                
                                                                // Get property currency type
                                                                $currency_type = cityestate_option( 'paid_currency_type' );

                                                                // Check property payment status
                                                                if( $payment_status != 'paid' ){
                                                                    echo '<div class="btn-group">';
                                                                        // Add pay now button
                                                                        echo '<button class="ce_payment_button action-btn">' . esc_html__( 'Pay Now', 'cityestate' ) . ' <i class="fa fa-angle-down"></i></button>';
                                                                        echo '<div class="dropdown-menu">';
                                                                            echo '<div class="pay-options">';
                                                                                echo '<table>';
                                                                                    echo '<tr>';
                                                                                        // Show submission price
                                                                                        echo '<td><div class="checkbox">' . esc_html__( 'Submission Fee:', 'cityestate' ) . '</div></td>';
                                                                                        echo '<td><span class="submission_price">' . floatval($per_submission) . '</span> ' . esc_html($currency_type) . '</td>';
                                                                                    echo '</tr>';
                                                                                    echo '<tr>';
                                                                                        echo '<td><div class="checkbox">';
                                                                                            echo '<label for="prop_featured">';
                                                                                            echo '<input type="checkbox" class="property_featured" id="property_featured" value="1">';
                                                                                            echo esc_html__( 'Featured Fee:', 'cityestate' ) . '</label>';
                                                                                        echo '</div>';
                                                                                    echo '</td>';
                                                                                    // Show featured submission price
                                                                                    echo '<td><span class="submission_featured_price">' . floatval($featured_submission) . '</span> ' . esc_html($currency_type) . '</td>';
                                                                                echo '</tr>';
                                                                            echo '<tfoot>';
                                                                                echo '<tr>';
                                                                                // Show total cost
                                                                                    echo '<td>' . esc_html__( 'Total Fee:', 'cityestate' ) . '</td>';
                                                                                    echo '<td><span class="submission_total_price">' . floatval($per_submission) . '</span> ' . esc_html($currency_type) . '</td>';
                                                                                echo '</tr>';
                                                                            echo '</tfoot>';
                                                                        echo '</table>';
                                                                    echo '</div>';

                                                                    // Get payment method status
                                                                    $active_bank    = cityestate_option( 'active_wire_transfer_payment' );
                                                                    $active_paypal  = cityestate_option( 'active_paypal_payment' );
                                                                    $active_stripe  = cityestate_option( 'active_stripe_payment' );

                                                                    // Check any payment method is active
                                                                    if( $active_paypal != 0 || $active_bank != 0 || $active_stripe != 0 ){
                                                                        echo '<ul>';
                                                                        // Check paypal payment method is active
                                                                        if( $active_paypal != 0 ){
                                                                            echo '<li><a href="#" class="paypal_single_property_listing" data-propertyid="' . intval(get_the_ID()) . '"><i class="fa fa-paypal"></i>' . esc_html__( 'Pay with PayPal', 'cityestate' ) . '</a></li>';
                                                                        }
                                                                        // Check stripe payment method is active
                                                                        if( $active_stripe != 0 ){
                                                                            echo '<li class="cityestate-stripe-btn">';
                                                                                cityestate_payment_stripe_per_listing( get_the_ID(), $per_submission, $featured_submission );
                                                                            echo '</li>';
                                                                        }
                                                                        // Check direct bank transfer is active
                                                                        if( $active_bank != 0 ){
                                                                            echo '<li><a href="#" class="direct_bank_per_property_listing" data-propertyid="' . intval(get_the_ID()) . '"><i class="fa fa-retweet"></i>' . esc_html__('Pay with Wire Transfer', 'cityestate') . '</a></li>';
                                                                        }            
                                                                        echo '</ul>';
                                                                    }
                                                                       echo '</div>';
                                                                    echo '</div>';
                                                                } else {
                                                                    // Check property is featured or not
                                                                    if( $property_featured != 1 ){

                                                                        echo '<div class="btn-group">';
                                                                            // Show upgrade to featured button
                                                                            echo '<button class="ce_payment_button action-btn">'.esc_html__( 'Upgrade to Featured', 'cityestate' ).'<i class="fa fa-angle-down"></i></button>';
                                                                            echo '<div class="dropdown-menu">';
                                                                                echo '<div class="pay-options">';
                                                                                echo '<table>';
                                                                                    echo '<tr>';
                                                                                        // Show featured submission price
                                                                                        echo '<td><div class="checkbox">'.esc_html__( 'Featured Fee:', 'cityestate' ).'</div></td>';
                                                                                        echo '<td><span>'.floatval($featured_submission).'</span> '.esc_html($currency_type).'</td>';
                                                                                    echo '</tr>';
                                                                                echo '<tfoot>';
                                                                                    echo '<tr>';
                                                                                        // Show total price
                                                                                        echo '<td>'.esc_html__( 'Total Fee:', 'cityestate' ).'</td>';
                                                                                        echo '<td><span class="submission_total_price">'.floatval($featured_submission).'</span> '.esc_html($currency_type).'</td>';
                                                                                    echo '</tr>';
                                                                                echo '</tfoot>';
                                                                                echo '</table>';
                                                                                echo '</div>';

                                                                                // Check any payment method is active
                                                                                if( $active_paypal != 0 || $active_bank != 0 || $active_stripe != 0 ){
                                                                                    echo '<ul>';
                                                                                    // Check paypal payment method is active
                                                                                    if( $active_paypal != 0 ){
                                                                                        echo '<li><a href="#" class="paypal_single_property_listing_upgrade" data-propertyid="' . intval(get_the_ID()) . '"><i class="fa fa-paypal"></i>' . esc_html__( 'Pay with PayPal', 'cityestate' ) . '</a></li>';
                                                                                    }
                                                                                    // Check stripe payment method is active
                                                                                    if( $active_stripe != 0 ){
                                                                                        echo '<li class="cityestate-stripe-btn">';
                                                                                        cityestate_payment_stripe_for_upgrade( get_the_ID(), $featured_submission );
                                                                                        echo '</li>';
                                                                                    }
                                                                                    // Check direct bank transfer is active
                                                                                    if ($active_bank != 0) {
                                                                                        echo '<li><a href="#" class="direct_bank_per_property_listing" data-isupgrade="1" data-propertyid="' . intval(get_the_ID()) . '"><i class="fa fa-retweet"></i>' . esc_html__( 'Pay with Wire Transfer', 'cityestate' ) . '</a></li>';
                                                                                    }
                                                                                    echo '</ul>';
                                                                                }
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    }
                                                               }
                                                            }

                                                            // Check listing is expire
                                                            $listing_expire  = cityestate_option( 'per_listing_is_expired' );

                                                            if( $submit_property_type == 'per_listing' && $listing_expire == 1 ):
                                                                // Get expire limit
                                                                $expire_limit = cityestate_option( 'per_listing_expired_time' );

                                                                // Get and set expire date
                                                                $date_temp      = explode( '-', get_the_date( 'Y-m-d' ) );
                                                                $expire_date    = date( 'Y-m-d h:i:sa', mktime( 0, 0, 0, $date_temp[1], $date_temp[2] + $expire_limit, $date_temp[0] ) );
                                                                $expire_date    = new DateTime( $expire_date );

                                                                // Get today date
                                                                $today      = new DateTime("now");
                                                                
                                                                // Set time remaining
                                                                $interval       = $expire_date->diff( $today );
                                                                $left_year      = $interval->format('%y');
                                                                $left_month     = $interval->format('%m');
                                                                $left_day       = $interval->format('%d');
                                                                $left_hour      = $interval->format('%h');
                                                                $left_minute    = $interval->format('%i');
                                                                $time_left      = '';

                                                                if( $left_year != 0 ) :
                                                                    // Year remaining
                                                                    $time_left = $left_year . esc_html__( ' years remaining', 'cityestate' );
                                                                elseif( $left_month != 0 ) :
                                                                    // Month remaining
                                                                    $time_left = $left_month . esc_html__( ' months remaining', 'cityestate' );
                                                                elseif( $left_day != 0 ) :
                                                                    // Day remaining
                                                                    $time_left = $left_day . esc_html__( ' days remaining', 'cityestate' );
                                                                elseif( $left_hour != 0 ) :
                                                                    // Hour remaining
                                                                    $time_left = $left_hour . esc_html__( ' hours remaining', 'cityestate' );
                                                                elseif( $left_minute != 0 ) :
                                                                    // Minute remaining
                                                                    $time_left = $left_minute . esc_html__( ' minutes remaining', 'cityestate' );
                                                                else:
                                                                    // Time is expired
                                                                    $time_left = esc_html__( 'expired', 'cityestate' );
                                                                endif;

                                                                // Show expire time
                                                                echo '<p class="expire-text"><strong>'.esc_html__( 'Expiration:', 'cityestate' ).'</strong> ' . $time_left . '</p>';
                                                            endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><?php
                                        endwhile; ?>
                                    </div> <?php
                                } else {
                                    // Show property not found message
                                    print '<h4>'.$theme_labels['properties_not_found'].'</h4>';
                                }?>
                            </div>
                        </div>
                    </div>
                    <!-- Show property list pagination -->
                    <?php echo cityestate_pagination( $property_query->max_num_pages, $range = 2 ); ?>                    
                </div>
            </div>
        </div>
    </div>
    <div class="vertical-space-100"></div>
    <div class="vertical-space-100"></div>
</section>

<?php get_footer(); ?>