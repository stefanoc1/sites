<?php

// Search property
if( !function_exists('cityestate_property_search') ){

    function cityestate_property_search( $search_query ){
        // Define variable
        $category_query = $metadata_query = $allowe_html = array();
        $keyword =  '';

        // Property keyword search
        $keyword_search  = cityestate_option( 'adv_sea_keyword_search' );

        // Check property keyword
        if( isset($_GET['keyword']) && $_GET['keyword'] !='' ){
            // Property keyword is address
            if( $keyword_search == 'property_address' ){
                // Filter keyword
                $meta_keywork =  wp_kses($_GET['keyword'], $allowe_html);
                // Property map address
                $property_map_address = array( 'key' => 'property_map_address', 'value' => $meta_keywork, 'type' => 'CHAR', 'compare' => 'LIKE' );
                // Property address
                $property_address = array( 'key' => 'property_address', 'value' => $meta_keywork, 'type' => 'CHAR', 'compare' => 'LIKE', );
                // Property zip
                $property_zip = array( 'key' => 'property_zip', 'value' => $meta_keywork, 'type' => 'CHAR', 'compare' => '=', );                
                // Property keyword
                $keyword = array( 'relation' => 'OR', $property_map_address, $property_address, $property_zip );

            // Property city or state
            } else if( $keyword_search == 'property_city_state' ){
                // Propert area or city or location
                $taxlocation[] = sanitize_title( wp_kses($_GET['keyword'], $allowe_html) );
                $category_query[] = array( 'taxonomy' => 'property_area', 'field' => 'slug', 'terms' => $taxlocation );
                $category_query[] = array( 'taxonomy' => 'property_city', 'field' => 'slug', 'terms' => $taxlocation );
                $category_query[] = array( 'taxonomy' => 'property_location', 'field' => 'slug', 'terms' => $taxlocation );
            } else {                
                $keyword = trim( $_GET['keyword'] );                
                // Property keyword is set
                if( ! empty( $keyword ) ){
                    $search_query['s'] = $keyword;
                }
            }
        }

        // Property bedroom
        if( isset( $_GET['bedrooms'] ) && !empty( $_GET['bedrooms'] ) && $_GET['bedrooms'] != 'all' ){            
            $bedrooms = sanitize_text_field( $_GET['bedrooms'] );            
            $metadata_query[] = array( 'key' => 'property_bedrooms', 'value' => $bedrooms, 'type' => 'DECIMAL', 'compare' => '=' );
        }

        // Property bathroom
        if( isset( $_GET['bathrooms'] ) && !empty( $_GET['bathrooms'] ) && $_GET['bathrooms'] != 'all'  ){            
            $bathrooms = sanitize_text_field( $_GET['bathrooms'] );            
            $metadata_query[] = array( 'key' => 'property_bathrooms', 'value' => $bathrooms, 'type' => 'DECIMAL', 'compare' => '=' );
        }

        // Property garages
        if( isset( $_GET['garages'] ) && !empty( $_GET['garages'] ) && $_GET['garages'] != 'all'  ){            
            $garages = sanitize_text_field( $_GET['garages'] );            
            $metadata_query[] = array( 'key' => 'property_garages', 'value' => $garages, 'type' => 'DECIMAL', 'compare' => '=' );
        }

        // Property price
        if( isset( $_GET['min_price'] ) && !empty( $_GET['min_price'] ) && $_GET['min_price'] != 'any' && isset( $_GET['max_price'] ) && !empty( $_GET['max_price'] ) && $_GET['max_price'] != 'any' ){
            $min_price = doubleval( cityestate_string_filter( $_GET['min_price'] ) );
            $max_price = doubleval( cityestate_string_filter( $_GET['max_price'] ) );

            if( $min_price >= 0 && $max_price > $min_price ){
                $metadata_query[] = array( 'key' => 'property_price', 'value' => array( $min_price, $max_price ), 'type' => 'NUMERIC', 'compare' => 'BETWEEN' );
            }
        // Check property min price is set
        } else if( isset( $_GET['min_price'] ) && !empty( $_GET['min_price'] ) && $_GET['min_price'] != 'any'  ){
            $min_price = doubleval( cityestate_string_filter( $_GET['min_price'] ) );

            if( $min_price >= 0 ){
                $metadata_query[] = array( 'key' => 'property_price', 'value' => $min_price, 'type' => 'NUMERIC', 'compare' => '>=' );
            }
        // Check property max price is set
        } else if( isset( $_GET['max_price'] ) && !empty( $_GET['max_price'] ) && $_GET['max_price'] != 'any'  ){
            $max_price = doubleval( cityestate_string_filter( $_GET['max_price'] ) );
            
            if( $max_price >= 0 ){
                $metadata_query[] = array( 'key' => 'property_price', 'value' => $max_price, 'type'=> 'NUMERIC', 'compare' => '<=' );
            }
        }

        // Property status
        if( isset( $_GET['status'] ) && !empty( $_GET['status'] ) && $_GET['status'] != 'all' ){            
            $category_query[] = array( 'taxonomy' => 'property_status', 'field' => 'slug', 'terms' => $_GET['status'] );
        }

        // Property type
        if( isset( $_GET['type'] ) && !empty( $_GET['type'] ) && $_GET['type'] != 'all'  ){            
            $category_query[] = array( 'taxonomy' => 'property_type', 'field' => 'slug', 'terms' => $_GET['type'] );
        }

        // Property location
        if( isset( $_GET['location'] ) && !empty( $_GET['location'] ) && $_GET['location'] != 'all'  ){                
            $category_query[] = array( 'taxonomy' => 'property_location', 'field' => 'slug', 'terms' => $_GET['location'] );
        }

        // Property area
        if( isset( $_GET['area'] ) && !empty( $_GET['area'] ) && $_GET['area'] != 'all' ){            
            $category_query[] = array( 'taxonomy' => 'property_area', 'field' => 'slug', 'terms' => $_GET['area'] );
        }

        // Property features
        if( isset( $_GET['features'] ) && !empty( $_GET['features'] ) ){            
            if( is_array( $_GET['features'] ) ){                
                $features = $_GET['features'];
                foreach( $features as $feature ):
                    $category_query[] = array( 'taxonomy' => 'property_feature', 'field' => 'slug', 'terms' => $feature );
                endforeach;
            }
        }

        // Check meta query
        $meta_count = count($metadata_query);

        if( $meta_count > 0 || !empty($keyword) ){
            // Property meta query
            $search_query['meta_query'] = array( 'relation' => 'AND', $keyword, array( 'relation' => 'AND', $metadata_query ), );
        }

        // Cound category
        $category_count = count($category_query);
        // Property keyword is city or state
        if( $keyword_search != 'property_city_state' ){            
            // Relation
            if( $category_count > 1 ){
                $category_query['relation'] = 'AND';
            }
        } else {
            // Relation
            $category_query['relation'] = 'OR';
        }

        // category relation
        if( $category_count > 0 ){
            $search_query['tax_query'] = $category_query;
        }

        return $search_query;
    }
}
add_filter('cityestate_search_parameters', 'cityestate_property_search');

// Property sort
if( !function_exists('cityestate_property_sort') ){

    function cityestate_property_sort( $query_args ){
        // Define sort order
        $sort_by = '';

        // Property order
        if( isset( $_GET['sortby'] ) ){
            $sort_by = $_GET['sortby'];
        } else {
            // Check is page listing
            if( is_page_template( 'templates/property_listing.php' ) ){
                $sort_by = get_post_meta( get_the_ID(), 'property_order_type', true );
            // Check is page search
            } else if( is_page_template( array( 'templates/template_search.php' ) ) ){
                $sort_by = cityestate_option('adv_sea_result_order');
            // Check is property category page
            }  else if( is_tax( 'property_type') || is_tax( 'property_feature' ) || is_tax( 'property_status' ) || is_tax( 'property_city' ) || is_tax( 'property_area') || is_tax( 'property_location' ) ){
                $sort_by = cityestate_option('taxonomies_default_order');
            }
        }

        // Property order by featured
        if( $sort_by == 'featured' ){            
            $query_args['meta_key']     = 'featured';
            $query_args['meta_value']   = '1';
        // Property order by low to high price
        } else if( $sort_by == 'sort_lh' ){            
            $query_args['orderby']  = 'meta_value_num';
            $query_args['meta_key'] = 'property_price';
            $query_args['order']    = 'ASC';
        // Property order by high to low price
        } else if( $sort_by == 'sort_hl' ){            
            $query_args['orderby']  = 'meta_value_num';
            $query_args['meta_key'] = 'property_price';
            $query_args['order']    = 'DESC';
        // Property order by old to new date
        } else if( $sort_by == 'sort_on' ){            
            $query_args['orderby']  = 'date';
            $query_args['order']    = 'ASC';
        // Property order by new to old date
        } else if( $sort_by == 'sort_no' ){            
            $query_args['orderby']  = 'date';
            $query_args['order']    = 'DESC';
        }
        return $query_args;
    }
}

// Cityestate pagination
if( !function_exists( 'cityestate_pagination' ) ){

    function cityestate_pagination( $page = '', $range ){
        // Define global variable    
        global $paged;

        // Check paged is empty
        if( empty($paged) )
            $paged = 1;

        // Set variable values
        $previous_page  = $paged - 1;
        $next_page      = $paged + 1;
        $current_page   = ( $range * 2 ) + 1;
        $range          = 2;

        // Check page is set
        if( $page == '' ){
            global $wp_query;
            // Get paged max number
            $page = $wp_query->max_num_pages;
            if( !$page ){
                $page = 1;
            }
        }

        // Check page is set
        if( $page != 1 ){
            echo '<div class="pagination-main">';
                echo '<div class="container">';
                    echo '<ul class="pagination">';
                        // First page link
                        echo ( $paged > 2 && $paged > $range+1 && $current_page < $page ) ? '<li><a href="'.get_pagenum_link(1).'"><span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span></a></li>' : '';
                        echo ( $paged > 1 ) ? '<li>
                        <?php next_posts_link(); ?>
                        <a href="'.get_pagenum_link($previous_page).'"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>' : '<li class="disabled"><a aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>';
                        // Run the loop
                        for( $i = 1; $i <= $page; $i++ ){
                            if( 1 != $page &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $page <= $current_page ) ){
                                // Check condition
                                if( $paged == $i ){
                                    echo '<li class="active"><a href="'.get_pagenum_link($i).'">'.$i.' <span class="sr-only"></span></a></li>';
                                } else {
                                    echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                                }
                            }
                        }
                        // Previous page link
                        echo ( $paged < $page ) ? '<li> <a href="'.get_pagenum_link($next_page).'"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>' : '';
                        echo ( $paged < $page-1 &&  $paged+$range-1 < $page && $current_page < $page ) ? '<li><a href="'.get_pagenum_link( $page ).'"><span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span></a></li>' : '';                    
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }
    }    
}

// Simple property filter
if( !function_exists('cityestate_property_filter') ){

    function cityestate_property_filter( $property_args ){
        // Define global variable
        global $paged;

        // Get property detail
        $property_id     = get_the_ID();        
        $property_number = get_post_meta( $property_id, 'number_property_show', true );
        $list_tab        = get_post_meta( $property_id, 'list_tab', true );

        // Define variable
        $category_query  = array();
        $metadata_query = array();

        // Check is front page
        if( is_front_page() ){
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        // Check property number is set
        if( !$property_number ){
            $property_args[ 'posts_per_page' ] = 9;
        } else {
            $property_args[ 'posts_per_page' ] = $property_number;
        }

        // Check page is set
        if( !empty($paged) ){
            $property_args['paged'] = $paged;
        } else {
            $property_args['paged'] = 1;
        }

        // Property type
        $types = get_post_meta( $property_id, 'property_type', false );
        if( ! empty( $types ) && is_array( $types ) ){
            $category_query[] = array( 'taxonomy' => 'property_type', 'field' => 'slug', 'terms' => $types );
        }

        // Check property tab
        if( isset( $_GET['tab'] ) ){
            $category_query[] = array( 'taxonomy' => 'property_status', 'field' => 'slug', 'terms' => $_GET['tab'] );
        }        

        // Property feature
        $features = get_post_meta( $property_id, 'property_feature', false );
        if( ! empty( $features ) && is_array( $features ) ){
            $category_query[] = array( 'taxonomy' => 'property_feature', 'field' => 'slug', 'terms' => $features );
        }

        // Property area
        $area = get_post_meta( $property_id, 'property_area', false );
        if( ! empty( $area ) && is_array( $area ) ){
            $category_query[] = array( 'taxonomy' => 'property_area', 'field' => 'slug', 'terms' => $area );
        }

        // Property city
        $city = get_post_meta( $property_id, 'property_city', false );
        if( ! empty( $city ) && is_array( $city ) ){
            $category_query[] = array( 'taxonomy' => 'property_city', 'field' => 'slug', 'terms' => $city );
        }

        // Property location
        $location = get_post_meta( $property_id, 'property_location', false );
        if( ! empty( $location ) && is_array( $location ) ){
            $category_query[] = array( 'taxonomy' => 'property_location', 'field' => 'slug', 'terms' => $location );
        }

        // Property status tab
        if( $list_tab != 'enable' ){            
            $status = get_post_meta($property_id, 'property_status', false);
            if( !empty($status) && is_array($status) ){
                $category_query[] = array( 'taxonomy' => 'property_status', 'field' => 'slug', 'terms' => $status );
            }
        }

        // Category relation
        $category_count = count( $category_query );        
        if( $category_count > 1 ) {
            $category_query['relation'] = 'AND';
        }

        if( $category_count > 0 ) {
            $property_args['tax_query'] = $category_query;
        }

        return $property_args;
    }
}
add_filter('cityestate_property_filter', 'cityestate_property_filter');

// Advance property search auto keywork
if( !function_exists('cityestate_search_keyword') ){

    function cityestate_search_keyword(){

        // Declare variable and array
        $output = '';
        $property_title     = array();
        $property_address   = array();
        
        $keyword_search  = cityestate_option( 'adv_sea_keyword_search' );
        
        // Check is keyword type is property city and state
        if( $keyword_search != 'property_city_state' ){
            
            $query = array( 'post_type' => 'property', 'posts_per_page' => -1, 'post_status' => 'publish' );            
            $property_object = new WP_Query($query);

            while( $property_object->have_posts() ){
                // Collect the auto suggest address, zipcode and address
                $property_object->the_post();                
                $property_title[]    = get_the_title();
                $property_address[]  = get_post_meta( get_the_ID(), 'property_map_address', true );
                $property_address[]  = get_post_meta( get_the_ID(), 'property_zip', true );
                $property_address[]  = get_post_meta( get_the_ID(), 'property_address', true );
            }
            wp_reset_query();

            // Check is keyword type is property title
            if( $keyword_search == "property_title" ){
                // Collect the auto suggest title
                $property_title  = array_unique( $property_title );
                $property_title  = array_values( $property_title );
                $output       = json_encode( $property_title );

            // Check is keyword type is property address
            } else if( $keyword_search == "property_address" ){
                // Collect the auto suggest address
                $property_address    = array_unique( $property_address );
                $property_address    = array_values( $property_address );
                $output           = json_encode( $property_address );
            }
        } else {
            $property_city_state = array();
            
            $args = array( 'orderby' => 'count', 'hide_empty' => 0 );

            // Get property city taxonomy
            $property_terms = get_terms( 'property_city', $args );
            foreach( $property_terms as $term ){
                $property_city_state[].= $term->name;
            }

            // Get property area taxonomy
            $property_terms = get_terms( 'property_area', $args );
            foreach( $property_terms as $term ){
                $property_city_state[].= $term->name;
            }

            // Get property location taxonomy
            $property_terms = get_terms( 'property_location', $args );
            foreach( $property_terms as $term ){
                $property_city_state[].= $term->name;
            }
            // Remove dublicate value in auto search
            $property_city_state = array_unique( $property_city_state );
            $property_city_state = array_values( $property_city_state );
            
            // Auto complete array is ready
            $output = json_encode( $property_city_state );
        }
        return $output;
    }
}

?>