<?php
/*
    Template Name: Dashboard Favorite Properties
*/

// Check user is login
if( !is_user_logged_in() ){
    wp_redirect( home_url());
}

// Get current user info
global $current_user;
wp_get_current_user();
$user_id = $current_user->ID;

// Get user saved favorite property
$favorite_property = get_option( 'cityestate_favorites_'.$user_id );

get_header(); ?>

<section>
    <!-- Add user dashboard menu -->
    <?php get_template_part( 'template-parts/dashboard_menu' ); ?>
    <div class="vertical-space-60"></div>
    <div class="container">        
        <div class="user-dashboard-full invoice-container">
            <div class="profile-top">
                <div class="profile-top-left">
                    <!-- Show dashboard page title -->
                    <h3 class="title"><?php the_title(); ?></h3>
                </div>
            </div>

            <div class="profile-area-content">
                <div class="account-block">
                    <!-- List favorite property -->
                    <div class="property-listing property_list_view">
                        <div class="row"><?php
                            // Check favorite property is not empty
                            if( !empty( $favorite_property ) ){                                
                                // Collect the property info
                                $args = array( 'post_type' => 'property', 'posts_per_page' => -1, 'post__in' => $favorite_property );
                                // Get favorite property
                                $favorite_posts = get_posts($args);

                                foreach( $favorite_posts as $post) : setup_postdata($post); ?>

                                    <!-- Favorite property listing view -->
                                    <div class="property_list_list" >
                                        <div class="property_list_list property-listing-list-full">
                                            <div class="col-xs-12 col-sm-4 col-md-4 property_list_list-image">
                                                <div class="recent-proeprty-box1-img-box"><?php
                                                    // Show favorite property image
                                                    if( has_post_thumbnail() ){
                                                        the_post_thumbnail( 'cityestate_property_thumb' );                                
                                                    } else {
                                                        // Show property default image
                                                        cityestate_image_placeholder( 'cityestate_property_thumb' );
                                                    }                                                    
                                                    // Show property featured label
                                                    echo include( get_template_directory() . '/template-parts/property_featured_label.php' ); ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-8 col-md-8 property_list_list-info">
                                                <div class="col-xs-12 col-sm-9 col-md-9 property_list_list-right">
                                                    <div class="recent-proeprty-box1-inner">
                                                        <a href="<?php esc_url( get_the_permalink($post->ID) ); ?>">                                                    
                                                            <h3 class="property-box1-title">
                                                                <!-- Show property title -->
                                                                <?php the_title(); ?>
                                                            </h3>
                                                        </a>
                                                        <!-- Add property location info -->
                                                        <?php echo include( get_template_directory() . '/template-parts/property_location_info.php' ); ?>

                                                        <!-- Add property neighborhood label -->
                                                        <?php echo include( get_template_directory() . '/template-parts/property_neighborhood_label.php' ); ?>

                                                        <!-- Add property agent name -->
                                                        <?php echo include( get_template_directory() . '/template-parts/property_agent_name.php' ); ?>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-3 col-md-3 property_list_list-left">
                                                    <!-- Show property price -->
                                                    <?php echo cityestate_get_property_price(); ?>
                                                    <!-- Add property status label -->
                                                    <?php echo include( get_template_directory() . '/template-parts/property_status_label.php' ); ?>
                                                </div>
                                                <?php if( $have_sidebar ){ ?>
                                                    <div class="col-xs-12 col-sm-12 col-md-8 property_list_list-facility">
                                                <?php } else { ?>  
                                                    <div class="col-xs-12 col-sm-12 col-md-9 property_list_list-facility">
                                                <?php } ?>
                                                    <div class="pull-left">
                                                    <ul class="property-basic-info">
                                                        <!-- Show property basic detail -->
                                                        <?php echo cityestate_basic_info(); ?>
                                                    </ul>
                                                    </div>
                                                    <div class="pull-right property-link"><?php
                                                        // Check property submit by agent
                                                        $property_submit_by_user = cityestate_option( 'property_submit_by_user' );
                                                        if( isset( $property_submit_by_user ) && $property_submit_by_user != "no" ){
                                                            // Show property favorite option
                                                            echo include( get_template_directory() . '/template-parts/property_favorite.php');
                                                        } ?>
                                                    </div>
                                                </div>
                                                <?php if( $have_sidebar ){ ?>
                                                    <div class="col-xs-12 col-sm-12 col-md-4 property_list_list-link">
                                                <?php } else { ?>
                                                    <div class="col-xs-12 col-sm-12 col-md-3 property_list_list-link">
                                                <?php } ?>
                                                    <!-- Show about property more link -->
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="more-btn-link"><?php esc_html_e( 'MORE DETAILS >', 'cityestate' ); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><?php
                                endforeach;
                                
                                // Reset wp query
                                wp_reset_postdata();
                            } else {
                                // Show user have no any favorite property
                                echo '<div class="col-sm-12">';
                                    echo esc_html__( 'You don\'t have any favorite properties yet!', 'cityestate' );
                                echo '</div>';
                            } ?>
                        </div>
                    </div>                    
                </div>        
            </div>
        </div>
    </div>
    <div class="vertical-space-100"></div>
    <div class="vertical-space-100"></div>
</section>
<?php get_footer(); ?>