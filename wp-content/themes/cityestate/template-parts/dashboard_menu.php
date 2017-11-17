<?php

// Get user profile page link
$profile_link = cityestate_user_profile_page();
// Get user property list page
$property_list = cityestate_user_property_list();
// Get user submit property page
$submit_property = cityestate_user_submit_property();
// Get user favorite property page
$favorite_property = cityestate_user_favorite_property_page();
// Get user saved search page
$save_search = cityestate_user_save_search_link();
// Get user invoice page
$user_invoice = cityestate_user_invoice_page_link();
// Get home page link
$home_link = home_url('/');

// Declare variables
$page_profile = $page_property = $page_submit = $page_favorite = $page_search = $page_invoice = '';

// Check page is user profile page
if( is_page_template( 'templates/dashboard_profile.php' ) ){
    $page_profile = 'class=active';
// Check page is property list page
} elseif( is_page_template( 'templates/dashboard_properties.php' ) ){
    $page_property = 'class=active';
// Check page is submit property page
} elseif( is_page_template( 'templates/dashboard_submit_property.php' ) ){
    $page_submit = 'class=active';
// Check page is saved search page
} elseif( is_page_template( 'templates/dashboard_saved_search.php' ) ){
    $page_search = 'class=active';
// Check page is favorite property page
} elseif( is_page_template( 'templates/dashboard_favorites.php' ) ){
    $page_favorite = 'class=active';
// Check page is invoice
} elseif( is_page_template( 'templates/dashboard_invoices.php' ) ){
    $page_invoice = 'class=active';
} ?>

<div class="my-tabs">
    <div class="container">
        <ul class="nav nav-tabs"><?php
            // Set user profile page link
            if( $home_link != $profile_link ){
                echo '<li ' .esc_attr( $page_profile ). '> <a href="' . esc_url($profile_link) . '">' . esc_html__( 'My profile', 'cityestate' ) . '</a></li>';
            }
            // Set property list page link
            if( $home_link != $property_list ){
                echo '<li ' .esc_attr( $page_property ). '> <a href="' . esc_url($property_list) . '">' . esc_html__( 'My Property List', 'cityestate' ) . '</a></li>';
            }
            // Set user submit property page link
            if( $home_link != $submit_property ){
                echo '<li ' .esc_attr( $page_submit ). '> <a href="' . esc_url($submit_property) . '">' . esc_html__( 'Submit Property', 'cityestate' ) . '</a></li>';
            }
            // Set user favorite property page link
            if( $home_link != $favorite_property ){
                echo '<li ' .esc_attr( $page_favorite ). '> <a href="' . esc_url($favorite_property) . '">' . esc_html__( 'Favourite Properties', 'cityestate' ) . '</a></li>';
            }
            // Set user save search page link
            if( $home_link != $save_search ){
                echo '<li ' .esc_attr( $page_search ). '> <a href="' . esc_url($save_search) . '">' . esc_html__( 'Saved Searches', 'cityestate' ) . '</a></li>';
            }
            // Set user invoice page link
            if( $home_link != $user_invoice ){
                echo '<li ' .esc_attr(  $page_invoice ). '> <a href="' . esc_url($user_invoice) . '">' . esc_html__( 'Invoices', 'cityestate' ) . '</a></li>';
            } ?>
        </ul>
    </div>
</div>