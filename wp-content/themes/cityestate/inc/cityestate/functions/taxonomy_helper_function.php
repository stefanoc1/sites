<?php

// Property type for admin list
if( ! function_exists( 'cityestate_admin_property_type_id' ) ){
    
    function cityestate_admin_property_type_id( $add_category = true ){

        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property type category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_type' ) );
        $property_type = new Cityestate_property_type_walker;

        // Get property type walk
        $property_type->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property type category
            return array_merge( $categories_buffer, $property_type->property_type_buffer );
        } else {
            // Get property type category
            return $property_type->property_type_buffer;
        }
    }
}

class Cityestate_property_type_walker extends Walker {    
    // Get the category name
    var $tree_type = 'property_type';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_type_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }

    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_type_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }

    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Property status
if( ! function_exists( 'cityestate_admin_property_status_id' ) ){
    
    function cityestate_admin_property_status_id( $add_category = true ){
        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property status category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_status' ) );

        $property_status = new Cityestate_property_status_walker;

        // Get property status walk
        $property_status->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property status category
            return array_merge( $categories_buffer, $property_status->property_status_buffer );
        } else {
            // Get property status category
            return $property_status->property_status_buffer;
        }
    }

}

class Cityestate_property_status_walker extends Walker {
    // Get the category name
    var $tree_type = 'property_status';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_status_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }
    
    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_status_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }
    
    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Property features
if( ! function_exists( 'cityestate_admin_property_features_id' ) ){
    
    function cityestate_admin_property_features_id( $add_category = true ){
        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property feature category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_feature' ) );

        $property_feature = new Cityestate_property_feature_walker;

        // Get property feature walk
        $property_feature->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property feature category
            return array_merge( $categories_buffer, $property_feature->property_feature_buffer );
        } else {
            // Get property feature category
            return $property_feature->property_feature_buffer;
        }
    }
}

class Cityestate_property_feature_walker extends Walker {
    // Get the category name
    var $tree_type = 'property_feature';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_feature_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }
    
    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_feature_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }
    
    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Property city
if( ! function_exists( 'cityestate_admin_property_city_id' ) ){
    
    function cityestate_admin_property_city_id( $add_category = true ){
        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property city category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_city' ) );

        $property_city = new Cityestate_property_city_walker;

        // Get property city walk
        $property_city->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property city category
            return array_merge( $categories_buffer, $property_city->property_city_buffer );
        } else {
            // Get property city category
            return $property_city->property_city_buffer;
        }
    }

}

class Cityestate_property_city_walker extends Walker {
    // Get the category name
    var $tree_type = 'property_city';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_city_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }
    
    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_city_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }
    
    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Property area
if( ! function_exists( 'cityestate_admin_property_area_id' ) ){
    
    function cityestate_admin_property_area_id( $add_category = true ){
        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property area category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_area' ) );

        $property_area = new Cityestate_property_area_walker;

        // Get property area walk
        $property_area->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property area category
            return array_merge( $categories_buffer, $property_area->property_area_buffer );
        } else {
            // Get property area category
            return $property_area->property_area_buffer;
        }
    }

}

class Cityestate_property_area_walker extends Walker {
    // Get the category name
    var $tree_type = 'property_area';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_area_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }
    
    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_area_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }

    
    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Property location
if( ! function_exists( 'cityestate_admin_property_location_id' ) ){
    
    function cityestate_admin_property_location_id( $add_category = true ){
        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property location category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_location' ) );

        $property_location = new Cityestate_property_location_walker;

        // Get property location walk
        $property_location->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property location category
            return array_merge( $categories_buffer, $property_location->property_location_buffer );
        } else {
            // Get property location category
            return $property_location->property_location_buffer;
        }
    }

}

class Cityestate_property_location_walker extends Walker {
    // Get the category name
    var $tree_type = 'property_location';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_location_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }
    
    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_location_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }
    
    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Property label
if( ! function_exists( 'cityestate_admin_property_label_id' ) ){
    
    function cityestate_admin_property_label_id( $add_category = true ){
        // Check is admin
        if( is_admin() === false ){
            return;
        }

        // Get property label category
        $categories = get_categories( array( 'hide_empty' => 0, 'taxonomy' => 'property_label' ) );

        $property_location = new Cityestate_property_label_walker;

        // Get property label walk
        $property_location->walk($categories, 4);
        
        // Check add category is set
        if( $add_category === true ){
            $categories_buffer['- All Types -'] = '';
            // Merge property label category
            return array_merge( $categories_buffer, $property_location->property_location_buffer );
        } else {
            // Get property label category
            return $property_location->property_location_buffer;
        }
    }

}

class Cityestate_property_label_walker extends Walker {
    // Get the category name
    var $tree_type = 'property_label';
    var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

    // Set category buffer
    var $property_location_buffer = array();

    // Start level
    function start_lvl( &$output, $depth = 0, $args = array() ){
    }

    // End level
    function end_lvl( &$output, $depth = 0, $args = array() ){
    }
    
    // Start category level
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ){
       $this->property_location_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }
    
    // End category level
    function end_el( &$output, $page, $depth = 0, $args = array() ){
    }
}

// Get category detail
if( ! function_exists( 'cityestate_category_detail' ) ){
    
    function cityestate_category_detail( $tax_name, $field_name ){
        // Get category field
        $term_filed = array( 'fields' => $field_name );

        $terms  = wp_get_post_terms( get_the_ID(), $tax_name, $term_filed );
        $temp   = '';
       
        // Check term found
        if( !empty($terms) ){
            foreach( $terms as $term ):
                $temp .= $term.', ';            
            endforeach;
            
            // Store category
            $field_name = rtrim ( $temp, ', ' );            
            return $field_name;
        }
        return '';
    }
}

// Get category detail
if( ! function_exists( 'cityestate_taxonomy_detail_id' ) ){
    
    function cityestate_taxonomy_detail_id( $tax_name, $field_name, $post_id ){
        // Get category field
        $term_filed = array( 'fields' => $field_name );

        $terms  = wp_get_post_terms( $post_id, $tax_name, $term_filed );
        $temp   = '';
        
        // Check term found
        if( !empty($terms) ){
            foreach( $terms as $term ):
                $temp .= $term.', ';            
            endforeach;
            
            // Store category
            $field_name = rtrim ( $temp, ', ' );            
            return $field_name;
        }
        return '';
    }
}