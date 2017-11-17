<?php
/*
    Template Name: Dashboard Saved Search
*/

// Check user is login
if( !is_user_logged_in() ){
    wp_redirect(home_url());
}

// Get current user info
global $current_user;
wp_get_current_user();
$user_id    = $current_user->ID;
$user_login = $current_user->user_login;

get_header(); ?>

<section>
    <!-- Add user dashboard menu -->
    <?php get_template_part( 'template-parts/dashboard_menu'); ?>
    <div class="vertical-space-60"></div>
    <div class="container">        
        <div class="user-dashboard-full invoice-container">
            <div class="profile-top">
                <div class="profile-top-left">
                    <!-- Show dashboard page titme -->
                    <h3 class="title"><?php the_title(); ?></h3>
                </div>
            </div>
            <div class="profile-area-content">
                <div class="account-block">
                    <div class="saved-search-list"><?php
                        // Declare global variable
                        global $wpdb;

                        // Set seach table name
                        $table_name = $wpdb->prefix . 'cityestate_search';
                        
                        // Fetch search result
                        $results = $wpdb->get_results( 'SELECT * FROM ' . $table_name . ' WHERE auther_id = ' . $user_id, OBJECT );

                        // Check any result is found
                        if( sizeof($results) !== 0 ){
                            // Run the search result loop
                            foreach( $results as $cityestate_search_data ){ 
                                    $search_query = "";
                                    // Resend property for approval
                                    if( function_exists('cityestate_decode') ){
                                        // Decode search query
                                        $search_query = cityestate_decode( $cityestate_search_data->query );
                                    }

                                 ?>
                                <div class="save_search_area">
                                    <!-- Show user search result -->
                                    <p><strong><?php esc_html_e( 'Search Parameters:', 'cityestate' ); ?></strong></p>
                                    <p><?php
                                        // Check is taxonomy query in search result
                                        if( isset( $search_query['tax_query'] ) ){                                          
                                            // Run the loop of taxonomy query
                                            foreach( $search_query['tax_query'] as $key => $val ){
                                                // Check property type taxonomy
                                                if( isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_type' ){
                                                    $page = get_term_by('slug', $val['terms'], 'property_type');
                                                    if( !empty($page) ){
                                                        echo '<strong>' . esc_html__( 'Type', 'cityestate' ) . ':</strong> ' . esc_attr( $page->name ). ', ';
                                                    }
                                                }
                                                // Check property stauts taxonomy
                                                if( isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_status' ){
                                                    $page = get_term_by('slug', $val['terms'], 'property_status');
                                                    if( !empty($page) ){
                                                        echo '<strong>' . esc_html__( 'Status', 'cityestate' ) . ':</strong> ' . esc_attr( $page->name ). ', ';
                                                    }
                                                }
                                                // Check property location taxonomy
                                                if( isset($val['taxonomy']) && isset($val['terms']) && $val['taxonomy'] == 'property_location' ){
                                                    $page = get_term_by('slug', $val['terms'], 'property_location');
                                                    if( !empty($page) ){
                                                        echo '<strong>' . esc_html__( 'Location', 'cityestate' ) . ':</strong> ' . esc_attr( $page->name ). ', ';
                                                    }
                                                }
                                            }
                                        }

                                        // Declare meta query variable
                                        $meta_query = array();

                                        // Check meta query is set
                                        if( isset($search_query['meta_query']) ){
                                            foreach( $search_query['meta_query'] as $key => $value ){
                                                // Check is array
                                                if( is_array( $value ) ){
                                                    if( isset( $value['key'] ) ){
                                                        $meta_query[] = $value;
                                                    } else {
                                                        // Run the value loop
                                                        foreach( $value as $key => $value ){
                                                            // Check is array
                                                            if( is_array( $value ) ){
                                                                // Run the value loop
                                                                foreach( $value as $key => $value ){
                                                                    if( isset( $value['key'] ) ){
                                                                        $meta_query[] = $value;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }                                            
                                        }

                                        // Check the meta query size
                                        if( isset($meta_query) && sizeof( $meta_query ) !== 0 ){
                                            // Run the value loop
                                            foreach( $meta_query as $key => $val ){
                                                // Check property price value
                                                if( isset($val['key']) && $val['key'] == 'property_price' && !empty($val['value'][0]) && !empty($val['value'][1]) ){
                                                    echo '<strong>' . esc_html__( 'Price', 'cityestate' ) . ':</strong> ' . esc_attr( $val['value'][0] ).' - '.esc_attr( $val['value'][1] ). ', ';
                                                }
                                                // Check property bedroom value
                                                if( isset($val['key']) && $val['key'] == 'property_bedrooms' ){
                                                    echo '<strong>' . esc_html__( 'Bedrooms', 'cityestate' ) . ':</strong> ' . esc_attr( $val['value'] ). ', ';
                                                }
                                                // Check property bathroom value
                                                if( isset($val['key']) && $val['key'] == 'property_bathrooms' ){
                                                    echo '<strong>' . esc_html__( 'Bathrooms', 'cityestate' ) . ':</strong> ' . esc_attr( $val['value'] ). ', ';
                                                }
                                                // Check property garage value
                                                if( isset($val['key']) && $val['key'] == 'property_garages' ){
                                                    echo '<strong>' . esc_html__( 'Garages', 'cityestate' ) . ':</strong> ' . esc_attr( $val['value'] ). ', ';
                                                }
                                            }
                                        } ?>
                                    </p>
                                    <!-- Add remove search button -->
                                    <button class="remove_save_search" data-propertyid='<?php echo intval($cityestate_search_data->id); ?>'><i class="fa fa-remove"></i></button>
                                    <a class="btn btn-primary" href="<?php echo esc_url($cityestate_search_data->url); ?>"><?php esc_html_e( 'Search', 'cityestate' ); ?></a>
                                </div><?php
                            }
                        } else {
                            // Show no search result found message
                            echo '<div class="saved-search-message">'.esc_html__( "You don't have any saved search", "cityestate" ).'</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vertical-space-100"></div>
    <div class="vertical-space-100"></div>
</section>
<?php get_footer(); ?>