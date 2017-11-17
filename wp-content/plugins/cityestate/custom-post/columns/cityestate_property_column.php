<?php

// Get property taxonomy name
if( ! function_exists ( 'cityestate_get_taxonomy' ) ){

    function cityestate_get_taxonomy( $property_id, $category, $post_type ){
        // Get the property taxonomy
        $terms = get_the_terms( $property_id, $category );
        if( ! empty ( $terms ) ){
            $result = array();            
            foreach( $terms as $term ){
                $result[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => $post_type, $category => $term->slug ), 'edit.php' ) ),
                    esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $category, 'display' ) )
                );
            }            
            return join( ', ', $result );
        }
        return false;
    }
}

// Register taxonomies for property custom post
if( !function_exists( 'ctiyestate_property_taxonomies' ) ){

    function ctiyestate_property_taxonomies(){
        // Register property label taxonomy for property
        register_taxonomy('property_label', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'Property Labels', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add New Label', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property Label', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_nav_menus' => true,
                    'rewrite'       => array( 'slug' => 'label' )
              )
        );
        // Register property type taxonomy for property
        register_taxonomy('property_type', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'Property Type', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add Property Type', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property Type', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_nav_menus' => true,
                    'rewrite'       => array( 'slug' => 'property-type' )
              )
        );     
        // Register property status taxonomy for property
        register_taxonomy('property_status', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'Property Status', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add Property Status', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property Status', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_nav_menus' => true,
                    'rewrite'       => array( 'slug' => 'status' )
              )
        );
        // Register property city taxonomy for property
        register_taxonomy('property_city', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'Property City', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add Property City', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property City', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'rewrite'       => array( 'slug' => 'city' ),
                    'show_in_nav_menus' => true,
              )
        );
        // Register property features taxonomy for property
        register_taxonomy('property_feature', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'Property Features', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add Property Feature', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property Feature', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_nav_menus' => true,
                    'rewrite'       => array( 'slug' => 'feature' )
              )
        );
        // Register property area taxonomy for property
        register_taxonomy('property_area', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'Neighborhood', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add Property Neighborhood', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property Neighborhood', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_nav_menus' => true,
                    'rewrite'       => array( 'slug' => 'area' )
              )
        );        
        // Register property location taxonomy for property
        register_taxonomy('property_location', 'property', 
              array(
                    'labels' => array(
                          'name'              => esc_html__( 'State / Country', 'cityestate' ),
                          'add_new_item'      => esc_html__( 'Add Property State / Country', 'cityestate' ),
                          'new_item_name'     => esc_html__( 'New Property State / Country', 'cityestate' )
                    ),
                    'hierarchical'  => true,
                    'query_var'     => true,
                    'show_in_nav_menus' => true,
                    'rewrite'       => array( 'slug' => 'location' )
              )
        );                        
    }
}
add_action( 'init', 'ctiyestate_property_taxonomies', 0 );

// Add column in property list page
if( !function_exists( 'cityestate_add_property_columns' ) ){
    
    function cityestate_add_property_columns($columns){
        // Set column name
        $columns = array(
            'cb'                  => '<input type=\'checkbox\' />',
            'title'               => esc_html__( 'Property Title', 'cityestate' ),
            'property_photo'      => esc_html__( 'Thumbnail', 'cityestate' ),
            'property_id'         => esc_html__( 'Property ID', 'cityestate' ),
            'property_type'       => esc_html__( 'Type', 'cityestate' ),
            'property_status'     => esc_html__( 'Status', 'cityestate' ),
            'property_price'      => esc_html__( 'Price', 'cityestate' ),
            'property_featured'   => esc_html__( 'Featured','cityestate' ),
            'property_city'       => esc_html__( 'City', 'cityestate' ),            
            'listing_posted'      => esc_html__( 'Posted', 'cityestate' ),
            'property_actions'    => esc_html__( 'Actions', 'cityestate' )
            
        );
        return $columns;
    }
}
add_filter( 'manage_edit-property_columns', 'cityestate_add_property_columns' );

// Show column in property list page
if( !function_exists( 'cityestate_show_property_columns' ) ){

    function cityestate_show_property_columns($column){

        global $post;        
        
        // Get property details
        $property_id  = get_post_meta( $post->ID, 'property_id', true );
        $is_featured  = get_post_meta( $post->ID, 'featured', true );

        // Check column and add in property list page
        switch ($column){            
            case 'property_photo':
                if( has_post_thumbnail($post->ID) ){ ?>
                    <a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail( array( 100, 100 ) ); ?></a><?php
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'property_id':                
                if(!empty($property_id)){
                    echo esc_attr( $property_id );
                } else {
                    esc_html_e( '-', 'cityestate' );
                }
            break;

            case 'property_type':
                echo cityestate_get_taxonomy( $post->ID, 'property_type', 'property' );
            break;

            case 'property_status':
                echo cityestate_get_taxonomy( $post->ID, 'property_status', 'property' );
            break;

            case 'property_price':
                cityestate_backend_listing_price();
            break;
            
            case 'property_featured':                
                if( $is_featured == 1 ){
                    esc_html_e( 'Yes', 'cityestate' );                    
                } else {
                    esc_html_e( 'No', 'cityestate' );
                }
            break;

            case 'property_city':
                echo cityestate_get_taxonomy( $post->ID, 'property_city', 'property' );
            break;

            case "listing_posted":
                echo date_i18n( esc_html__( 'M j, Y', 'cityestate' ), strtotime( $post->post_date ) );
                echo sprintf( esc_html__( ' By %s', 'cityestate' ), '<a href="' . esc_url( add_query_arg( 'author', $post->post_author ) ) . '">' . get_the_author() . '</a>' );
            break;

            case 'property_actions':
                
                echo '<div class="actions">';

                $property_actions = array();

                // Apprvoe property
                if( in_array( $post->post_status, array( 'pending' ) ) ){
                    $property_actions['approve'] = array(
                        'action'  => 'approve',
                        'name'    => esc_html__( 'Approve', 'cityestate' ),
                        'url'     => wp_nonce_url( add_query_arg( 'property_approve', $post->ID ), 'property_approve' )
                    );
                }

                // Expire property
                if( in_array( $post->post_status, array( 'publish', 'pending' ) ) && current_user_can( 'publish_post', $post->ID ) ){
                    $property_actions['expire'] = array(
                        'action'  => 'expire',
                        'name'    => esc_html__( 'Expire', 'cityestate' ),
                        'url'     => wp_nonce_url( add_query_arg( 'property_expire', $post->ID ), 'property_expire' )
                    );
                }

                // View or Edit or Delete property
                if( $post->post_status !== 'trash' ){
                    // View property
                    if( current_user_can( 'read_post', $post->ID ) ){
                        $property_actions['view'] = array(
                            'action'  => 'view',
                            'name'    => esc_html__( 'View', 'cityestate' ),
                            'url'     => get_permalink( $post->ID )
                        );
                    }
                    // Edit property
                    if( current_user_can( 'edit_post', $post->ID ) ){
                        $property_actions['edit'] = array(
                            'action'  => 'edit',
                            'name'    => esc_html__( 'Edit', 'cityestate' ),
                            'url'     => get_edit_post_link( $post->ID )
                        );
                    }
                    // Delete property
                    if( current_user_can( 'delete_post', $post->ID ) ){
                        $property_actions['delete'] = array(
                            'action'  => 'delete',
                            'name'    => esc_html__( 'Delete', 'cityestate' ),
                            'url'     => get_delete_post_link( $post->ID )
                        );
                    }
                }

                $property_actions = apply_filters( 'cityestate_property_actions', $property_actions, $post );

                foreach( $property_actions as $action ){
                    if( is_array( $action ) ){
                        printf( '<a class="button" href="%1$s">%2$s</a>', esc_url( $action['url'] ), esc_html( $action['name'] ) );
                    } else {
                        echo str_replace( 'class="', 'class="button ', $action );
                    }
                }
                echo '</div>';

            break;
        }
    }
}
add_action( 'manage_property_posts_custom_column', 'cityestate_show_property_columns' );

// Get property price
if( !function_exists('cityestate_backend_listing_price') ){

    function cityestate_backend_listing_price(){
        // Get property different price
        $property_price          = get_post_meta( get_the_ID(), 'property_price', true );
        $property_second_price   = get_post_meta( get_the_ID(), 'property_second_price', true );
        $property_price_postfix  = get_post_meta( get_the_ID(), 'property_price_postfix', true );

        // Check property first price
        if( !empty($property_price) ){
            if( !empty($property_price_postfix) ){
                $property_price_postfix = '&#47;' . $property_price_postfix;
            }
            // Check first price and second price is available
            if (!empty( $property_price ) && !empty( $property_second_price ) ) {
                echo cityestate_backend_property_price($property_price).'<br/>';
                if (!empty( $property_second_price )) {
                    echo cityestate_backend_property_price($property_second_price) . $property_price_postfix;
                }
            } else {
                // Again check the property price
                if( !empty( $property_price ) ){
                    echo cityestate_backend_property_price($property_price) . $property_price_postfix;                    
                }
            }
        }        
    }
}

// Property price
if( !function_exists('cityestate_backend_property_price') ){

    function cityestate_backend_property_price( $price_number ){

        $price_number = doubleval( $price_number );
        if( $price_number ){
            // Get currency type
            $currency = cityestate_option( 'property_price_symbol' );
            if( !empty($currency) ){
                $currency = $currency;
            } else {
                $currency = '$';
            }
            // Decimal format
            $property_price_decimal               = intval( cityestate_option( 'property_price_decimal' ) );
            $property_price_decimal_point         = cityestate_option( 'property_price_decimal_sep' );
            $property_price_decimal_tho_sep    = cityestate_option( 'property_price_decimal_tho_sep' );
            $property_price_position      = cityestate_option( 'property_price_position' );
            $formatted_price        = number_format( $price_number , $property_price_decimal , $property_price_decimal_point , $property_price_decimal_tho_sep );

            // Check price prifix after or before
            if( $property_price_position == 'before' ){
                return $currency . $formatted_price;
            } else {
                return $formatted_price . $currency;
            }
        } else {
            $currency = esc_html__( 'Invalid', 'cityestate' );
        }
        return $currency;
    }

}

// Approve property
if( !function_exists('cityestate_property_approve') ){
    
    function cityestate_property_approve(){
        
        if( !empty($_GET['property_approve']) && current_user_can('publish_post', $_GET['property_approve']) ){
            // Save property status
            $property_id    = $_GET['property_approve'];
            $property_data  = array( 'ID' => $property_id, 'post_status' => 'publish' );
            wp_update_post($property_data);

            // Send property approved mail
            $author_id      = get_post_field( 'post_author', $property_id );
            $user           = get_user_by( 'id', $author_id );
            $user_email     = $user->user_email;

            $args = array( 'listing_title' => get_the_title($property_id), 'listing_url' => get_permalink($property_id) );
            cityestate_send_mail( $user_email, 'listing_approved_by_admin_subject', 'listing_approved_by_admin_message', $args );
            
            // Redirect when property is approve
            wp_redirect( remove_query_arg( 'property_approve', add_query_arg( 'property_approve', $property_id, admin_url('edit.php?post_type=property') ) ) );
            exit;
        }
    }
    add_action('admin_init', 'cityestate_property_approve');    
}

// Expire property
if( !function_exists('cityestate_property_expire') ){
    
    function cityestate_property_expire(){
        
        if( !empty($_GET['property_expire']) && current_user_can('publish_post', $_GET['property_expire']) ){
            // Expire property status
            $property_id    = $_GET['property_expire'];
            $property_data  = array( 'ID' => $property_id, 'post_status' => 'expired' );
            wp_update_post($property_data);

            // Expire property approved mail
            $author_id  = get_post_field( 'post_author', $property_id );
            $user       = get_user_by( 'id', $author_id );
            $user_email = $user->user_email;

            $args = array( 'listing_title' => get_the_title($property_id), 'listing_url' => get_permalink($property_id) );
            cityestate_send_mail( $user_email, 'listing_expired_by_admin_subject', 'listing_expired_by_admin_message', $args );
            
            // Redirect when property is expire
            wp_redirect( remove_query_arg( 'property_expire', add_query_arg( 'property_expire', $property_id, admin_url('edit.php?post_type=property') ) ) );
            exit;
        }
    }

    add_action('admin_init', 'cityestate_property_expire');
}

if( ! function_exists('cityestate_exprire_property') ){
    
    function cityestate_exprire_property(){
        $args = array(
            'label'                     => _x( 'Expired', 'Status General Name', 'cityestate' ),
            'label_count'               => _n_noop( 'Expired (%s)',  'Expired (%s)', 'cityestate' ),
            'exclude_from_search'       => false,
            'show_in_admin_status_list' => true,
            'show_in_admin_all_list'    => true,
            'public'                    => true,
        );
        register_post_status( 'expired', $args );
    }
    add_action( 'init', 'cityestate_exprire_property', 1 );
}

// Save property id if option is auto
if( !function_exists('property_save_auto') ){        
    function property_save_auto($property_id, $post, $update){        
        // Get status from auto property id is active from backend
        $generate_property_id = cityestate_option( 'generate_property_id' );
        // Save random property id
        if( $generate_property_id != 0 ){
            update_post_meta( $property_id, 'property_id', $property_id );
        }
    }
    add_action('save_post', 'property_save_auto', 10, 3);    
}

?>