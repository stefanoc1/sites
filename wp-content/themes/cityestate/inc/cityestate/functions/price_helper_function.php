<?php

// Property price
if( !function_exists('cityestate_get_property_price') ){

    function cityestate_get_property_price( $type = '' ){

        // Get property price
        $first_price    = get_post_meta( get_the_ID(), 'property_price', true );
        $second_price   = get_post_meta( get_the_ID(), 'property_second_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'property_price_postfix', true );

        $output = '';

        // Check first price is set
        if( !empty($first_price) ){
            // Check price postfix is set
            if( !empty($price_postfix) ){
                $price_postfix = '&#47;' . $price_postfix;
            }

            // Check first and second price is set
            if( !empty($first_price) && !empty($second_price) ){
                // Check property detail type
                if( $type == "property_detail" ){
                    // Set property price
                    $output .= '<h3 class="property-price">' . cityestate_filter_property_price($first_price) . '</h3>';
                } else {
                    // Set property price
                    $output .= '<h3 class="property-box1-price">' . cityestate_filter_property_price($first_price) . '</h3>';
                }
                // Check second price is set
                if( !empty($second_price) ){
                    // Check property detail type
                    if( $type == "property_detail" ){                        
                        $output .= '<h4 class="property-price-description">';
                        // Set property price
                        $output .= cityestate_filter_property_price($second_price) ."<span>".$price_postfix;
                        $output .= '</span></h4>';
                    // Check property detail type
                    } else if( $type == "featured_list" ){                        
                        $output .= '<label> ';
                        // Set property price
                        $output .= cityestate_filter_property_price($second_price) ."<span>". $price_postfix;
                        $output .= ' </span></label>';
                    } else {                        
                        $output .= '<h4 class="property-box1-price-description">';
                        // Set property price
                        $output .= cityestate_filter_property_price($second_price);
                        $output .= '</h4>';
                    }
                }
            } else {
                // Check first price is set                
                if( !empty( $first_price ) ){
                    // Check property detail type
                    if( $type == "property_detail" ){                        
                        $output .= '<h3 class="property-box1-price price"><label class="price">';
                        // Set property price
                        $output .= cityestate_filter_property_price($first_price);
                        $output .= '</label></h3>';
                    // Check property detail type
                    } else {                        
                        $output .= '<h3 class="property-box1-price price"><label class="price">';
                        // Set property price
                        $output .= cityestate_filter_property_price($first_price);
                        $output .= '</label></h3>';
                    }
                }
            }
        }
        return $output;
    }
}

// Filter property price
if( !function_exists('cityestate_filter_property_price') ){

    function cityestate_filter_property_price( $property_price ){
        // Filter propert price
        $property_price = doubleval( $property_price );

        // Check property price is set
        if( $property_price ){

            // Get the currency positiob
            $position_currency = cityestate_option( 'property_price_symbol' );

            // Check currency postion is set
            if( !empty($position_currency) ){
                $position_currency = $position_currency;
            } else {
                // Set default currency position
                $position_currency = '$';
            }

            // Get property price detail
            $property_price_decimal     = intval( cityestate_option( 'property_price_decimal' ) );
            $dec_point                  = cityestate_option( 'property_price_decimal_sep' );
            $thousands_sep              = cityestate_option( 'property_price_decimal_tho_sep' );
            $property_price_position    = cityestate_option( 'property_price_position' );
            $formatted_price            = number_format( $property_price , $property_price_decimal , $dec_point , $thousands_sep );

            // Check property price position
            if( $property_price_position == 'before' ){
                return $position_currency . $formatted_price;
            } else {
                return $formatted_price . $position_currency;
            }
        } else {
            $position_currency = esc_html__( 'invalid', 'cityestate' );
        }
        return $position_currency;
    }
}

// Minimum property price list
if( !function_exists('cityestate_min_property_price') ){
    
    function cityestate_min_property_price(){
        $search_price = '';

        // Set default price range
        $price_array = array( 1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000 );        

        // Get price range from admin
        $admin_price = cityestate_option( 'adv_sea_min_max_price' );

        // Check admin is set price
        if( !empty($admin_price) ){

            // Explode price
            $price_strings_array = explode( ',', $admin_price );

            // Check price is set and find in array
            if( is_array( $price_strings_array ) && !empty( $price_strings_array ) ){                
                $temp_price = array();
                // Run the loop
                foreach( $price_strings_array as $minimum_price ){                    
                    // Set price float value
                    $price_point = floatval( $minimum_price );
                    // Check price is not one
                    if( $price_point > 1 ){
                        $temp_price[] = $price_point;
                    }
                }
                // Check temp price is set
                if( !empty( $temp_price ) ){
                    $price_array = $temp_price;
                }
            }
        }

        // Get max price
        if( isset( $_GET['max_price'] ) ){
            $search_price = $_GET['max_price'];
        }

        // Check price array is set
        if( !empty( $price_array ) ){

            foreach( $price_array as $minimum_price ){
                // Match the property price
                if( $search_price == $minimum_price ){
                    echo '<option value="'.esc_attr( $minimum_price ).'" selected="selected">'.cityestate_filter_property_price( $minimum_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $minimum_price ).'">'.cityestate_filter_property_price( $minimum_price ).'</option>';
                }
            }
        }
    }
}