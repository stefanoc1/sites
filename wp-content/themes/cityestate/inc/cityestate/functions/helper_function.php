<?php

// Walker nav menu
class cityestate_menu_walker extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth=0, $args=array(), $current_object_id = 0 ){
        // Get menu item
        $this->curItem  = $item;
        $indent         = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names    = $value = '';
        
        // Get menu class
        $classes        = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[]      = 'menu-item-' . $item->ID;
        $class_names    = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names    = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        // Get menu item id
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        // Check is page nav menu
        if( 'page' == $item->object ){
            $post_obj = get_post( $item->object_id, 'OBJECT' );         
        }

        // Collect li of menu
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        // Collect menu attribute
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        
        // Add nav menu in filter
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        
        // Declare menu
        $attributes     = '';
        $item_output    = '';
        
        foreach( $atts as $attr => $value ){
            // Check value is available
            if( ! empty( $value ) ){
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        // Check is page
        if( 'page' == $item->object ){
            
            // Get post object
            $post_obj   = get_post( $item->object_id, 'OBJECT' );
            $is_mega    = get_post_meta( $item->object_id, 'cityestate_mega_menu_meta', true );
            
            // Check is mega menu
            if( !empty($is_mega) )
                $item_output .= do_shortcode($post_obj->post_content);
            else {
                $item_output .= $args->before;
                
                // Colorize categories in menu
                $color ='';
                if( $item->object == 'category' ){
                    $cat_data   = get_option("category_$item->object_id");
                    $color      = (!empty($cat_data['catBG']))?'style="color:'. $cat_data['catBG'] .'"':'';
                }

                // Menu a tag
                $item_output .= '<a '. $color . $attributes. ' data-description="' .$item->description .'">';
                
                // Menu icon
                if( !empty($item->icon) )               
                    $item_output .= '<i class="'.$item->icon.'"></i>';
                
                // Collect menu
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
            }
        } else {
            // Menu a tag
            $item_output .= $args->before;
            $item_output .= '<a '. $attributes. ' data-description="' .$item->description .'">';
            
            // Menu icon
            if( !empty($item->icon) )
                $item_output .= '<i class="'.$item->icon.'"></i>';

            // Collect menu
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Get property category
if( !function_exists('cityestate_category_values') ){

    function cityestate_category_values( $cat_name, $category, $find_cat, $cat_prefix = " " ){
        // Check category and name ia available
        if( !empty($category) && taxonomy_exists($cat_name) ){
            foreach( $category as $term ){
                // Find the category
                if( $find_cat == $term->slug ){
                    echo '<option value="' . $term->slug . '" selected="selected">' . $cat_prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->slug . '">' . $cat_prefix . $term->name . '</option>';
                }
                // Get the child category                
                $child_terms = get_terms( $cat_name, array( 'hide_empty' => false, 'parent' => $term->term_id ) );
                // Check child category is find
                if( !empty($child_terms) ){
                    cityestate_category_values( $cat_name, $child_terms, $find_cat, "- ".$cat_prefix );
                }
            }
        }
    }
}

// Get number of basic detail of property search
if( !function_exists('cityestate_search_number_list') ){

    function cityestate_search_number_list( $field ){
        // Define default value
        $number = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );
        $search = '';

        // Number for garages
        if( $field == 'garages' ){
            // Check garages is set
            if( isset( $_GET['garages'] ) ){
                $search = $_GET['garages'];
            }
            // Get garages values
            $search_garages = cityestate_option('adv_sea_garages');
            // Check garages is availalbe
            if( !empty($search_garages) ){
                // Explode garages
                $garages_array = explode( ',', $search_garages );
                // Check values available in array
                if( is_array($garages_array) && !empty($garages_array) ){
                    $temp_garages = array();
                    // Collect garages
                    foreach( $garages_array as $baths ){
                        $temp_garages[] = $baths;
                    }
                    // Check garages is available
                    if( !empty( $temp_garages ) ){
                        $number = $temp_garages;
                    }
                }
            }
        }

        // Number for bedrooms
        if( $field == 'bedrooms' ){
            // Check bedrooms is set
            if( isset( $_GET['bedrooms'] ) ){
                $search = $_GET['bedrooms'];
            }            
            // Get bedrooms values
            $search_bedrooms = cityestate_option( 'adv_sea_bedrooms' );

            // Check bedrooms is availalbe
            if( !empty($search_bedrooms) ){
                // Explode bedrooms
                $bedrooms_array = explode( ',', $search_bedrooms );
                
                // Check values available in array
                if( is_array($bedrooms_array) && !empty($bedrooms_array) ){
                    $temp_bedrooms = array();
                    // Collect bedrooms
                    foreach( $bedrooms_array as $beds ){
                        $temp_bedrooms[] = $beds;
                    }
                    // Check bedrooms is available
                    if( !empty($temp_bedrooms) ){
                        $number = $temp_bedrooms;
                    }
                }
            }
        }

        // Number for bathrooms
        if( $field == 'bathrooms' ){
            // Check bathrooms is set
            if( isset( $_GET['bathrooms'] ) ){
                $search = $_GET['bathrooms'];
            }
            // Get bathrooms values
            $search_bathrooms = cityestate_option( 'adv_sea_bathrooms' );
            // Check bathrooms is availalbe
            if( !empty($search_bathrooms) ){
                // Explode bathrooms
                $bathrooms_array = explode( ',', $search_bathrooms );
                // Check values available in array
                if( is_array($bathrooms_array) && !empty($bathrooms_array) ){
                    $temp_bathrooms = array();
                    // Collect bathrooms
                    foreach( $bathrooms_array as $baths ){
                        $temp_bathrooms[] = $baths;
                    }
                    // Check bathrooms is available
                    if( !empty( $temp_bathrooms ) ){
                        $number = $temp_bathrooms;
                    }
                }
            }
        }

        // Check number is available
        if( !empty($number) ){
            foreach( $number as $number ){
                // Find the number
                if( $search == $number ){
                    echo '<option value="'.esc_attr( $number ).'" selected="selected">'.esc_attr( $number ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $number ).'">'.esc_attr( $number ).'</option>';
                }
            }
        }
    }
}

// Get placeholder image
if( !function_exists('cityestate_image_placeholder') ) {
    
    function cityestate_image_placeholder( $dimension ){
        // Define global
        global $_wp_additional_image_sizes;

        // Declare variable
        $width = $height = 0;

        // Image alt text        
        $alt = get_bloginfo('name');

        // Check image size
        if( in_array( $dimension , array( 'thumbnail', 'medium', 'large' ) ) ){
            $width    = get_option( $dimension . '_size_w' );
            $height   = get_option( $dimension . '_size_h' );
        // Add custom size
        } else if( isset( $_wp_additional_image_sizes[ $dimension ] ) ){
            $width    = $_wp_additional_image_sizes[ $dimension ]['width'];
            $height   = $_wp_additional_image_sizes[ $dimension ]['height'];
        }
        // Check image width and height is set
        if( intval( $width ) > 0 && intval( $height ) > 0 ) {
            return '<img src="http://placehold.it/' . $width . 'x' . $height . '&text=' . urlencode( $alt ) . '" />';
        }
        return '';
    }
}

// Property basic detail
if( !function_exists('cityestate_basic_info') ){
    
    function cityestate_basic_info(){

        // Get property basic detail
        $bedrooms      = get_post_meta( get_the_ID(), 'property_bedrooms', true );
        $bathrooms     = get_post_meta( get_the_ID(), 'property_bathrooms', true );
        $garage        = get_post_meta( get_the_ID(), 'property_garage', true );        

        $output = '';

        // Check property bedrooms is set
        if( !empty( $bedrooms ) ){
            $bedrooms          = esc_attr( $bedrooms );
            // Set property bedrooms label
            $bedrooms_lebel    = ($bedrooms > 1 ) ? esc_html__( 'Bathrooms', 'cityestate' ) : esc_html__( 'Bathrooms', 'cityestate' );

            // Add bedrooms detail
            $output .= '<li>';
            $output .= '<span>'.esc_attr( $bedrooms ).'</span> '. esc_attr( $bedrooms_lebel );
            $output .= '</li>';
        }
        
        // Check property bathrooms is set
        if( !empty( $bathrooms ) ){
            $bathrooms = esc_attr( $bathrooms );
            // Set property bedrooms label
            $bathrooms_lebel = ($bathrooms > 1 ) ? esc_html__( 'Bedrooms', 'cityestate' ) : esc_html__( 'Bedrooms', 'cityestate' );

            // Add bathrooms detail
            $output .= '<li>';
            $output .= '<span>'.esc_attr( $bathrooms ).'</span> '. esc_attr( $bathrooms_lebel );
            $output .= '</li>';
        }

        // Check property garage is set
        if( !empty( $garage ) ){
            $garage = esc_attr( $garage );
            // Set property garage label
            $garage_lebel = ($garage > 1 ) ? esc_html__( 'Garages', 'cityestate' ) : esc_html__( 'Garages', 'cityestate' );

            // Add garage detail
            $output .= '<li>';
            $output .= '<span>'.esc_attr( $garage ).'</span> '. esc_attr( $garage_lebel );
            $output .= '</li>';
        }
        return $output;        
    }
}

// Get template link
if( !function_exists('cityestate_template_url') ){

    function cityestate_find_template_url($name){
        // Collect template args
        $args = array( 'meta_key' => '_wp_page_template', 'meta_value' => $name );
        
        // Get pages
        $page = get_pages($args);
        
        // Checl pages found
        if( $page ){
            $template_link = get_permalink( $page[0]->ID );
        } else {
            $template_link = home_url('/');
        }
        // Return template link
        return $template_link;
    }
}

// Cityestate Breadcrumb
if ( ! function_exists( 'cityestate_breadcrumb' ) ){
    
    function cityestate_breadcrumb( $separator = true ){
        // Show breadcrumb
        $show_breadcrumb = cityestate_option( 'show_breadcrumb' );

        // Check breadcrumb status
        if( $show_breadcrumb != 0 ){
            
            global $post;
            
            // Set static label
            $text['home']     = esc_html__( 'Home', 'cityestate' );
            $text['category'] = esc_html__( 'Archive by Category "%s"', 'cityestate' );
            $text['404']      = esc_html__( 'Error 404', 'cityestate' );
            $text['page']     = esc_html__( 'Page %s', 'cityestate' );
            $text['cpage']    = esc_html__( 'Comment Page %s', 'cityestate' );
            $text['search']   = esc_html__( 'Search Results for "%s" Query', 'cityestate' );
            $text['tag']      = esc_html__( 'Posts Tagged "%s"', 'cityestate' );
            $text['author']   = esc_html__( 'Articles Posted by %s', 'cityestate' );            
            
            // Check breadcrumb separator
            if( $separator ){
                $separator_before = '<li aria-hidden="true">';
                $separator_temp = '<i class="fa fa-angle-right"></i>';
                $separator_after = '</li>';
            } else {
                $separator_before = '';
                $separator_temp = '';
                $separator_after = '';
            }

            // Set default mode
            $set_home_link = 1;
            $set_on_home   = 0;
            $set_current   = 1;
            $before         = '<li class="active">';
            $after          = '</li>';
            
            // Set link parent element
            $home_link      = home_url('/');
            $link_before    = '<li>';
            $link_after     = '</li>';
            $link_attr      = '';
            $link_in_before = '';
            $link_in_after  = '';
            $link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
            $frontpage_id   = get_option('page_on_front');
            $parent_id      = $post->post_parent;        
            
            // Combine separator
            $separator_temp = ' ' . $separator_before . $separator_temp . $separator_after . ' ';

            // Check home or front page
            if( is_home() || is_front_page() ){
                if( $set_on_home ) 
                    echo '<a href="' . $home_link . '">' . $text['home'] . '</a>';                
            } else {
                // Check is home page
                if( $set_home_link ) 
                    echo sprintf($link, $home_link, $text['home']);
                
                // Check is category page
                if( is_category() ){

                    $cat = get_category(get_query_var('cat'), false);

                    // Check category parent
                    if( $cat->parent != 0 ){                        
                        $cats = get_category_parents($cat->parent, TRUE, $sep);
                        
                        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                        
                        if( $set_home_link ) 
                            echo $separator_temp;
                        echo $cats;
                    }

                    // Get paged query
                    if( get_query_var('paged') ){
                        $cat = $cat->cat_ID;
                        echo $separator_temp . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $separator_temp . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        if( $set_current ) 
                            echo $separator_temp . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                    }
                // Check page is search
                } elseif ( is_search() ){
                    // Check have posts
                    if( have_posts() ){
                        // Check is home page
                        if( $set_home_link && $set_current ) 
                            //echo $separator_temp;
                        
                        if( $set_current) 
                            echo $before . sprintf($text['search'], get_search_query()) . $after;
                    } else {
                        // Check is home page
                        if( $set_home_link ) 
                            echo $separator_temp;
                        
                        echo $before . sprintf($text['search'], get_search_query()) . $after;
                    }
                // Check is day page
                } elseif ( is_day() ){
                    // Set link
                    if( $set_home_link ) 
                        echo $separator_temp;
                    
                    // Print breadcrumbs
                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator_temp;
                    echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
                    
                    // Check is current page
                    if( $set_current ) 
                        echo $separator_temp . $before . get_the_time('d') . $after;
                // Check is month page
                } elseif ( is_month() ){
                    // Check is home page
                    if( $set_home_link ) 
                        echo $separator_temp;
                    
                    echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
                    // Check is current page
                    if( $set_current ) 
                        echo $separator_temp . $before . get_the_time('F') . $after;
                // Check is year page
                } elseif ( is_year() ){
                    // Check is home page
                    if( $set_home_link && $set_current ) 
                        echo ecs_html($separator_temp);
                    // Check is current page
                    if( $set_current ) 
                        echo $before . get_the_time('Y') . $after;
                // Check is single page
                } elseif ( is_single() && !is_attachment() ){
                    // Check is home page
                    if( $set_home_link )
                        //echo $separator_temp;

                    // Check post or property page
                    if( get_post_type() != 'post' && get_post_type() != 'property' ){
                        // Get post object
                        $post_type = get_post_type_object(get_post_type());
                        // Get post slug
                        $slug = $post_type->rewrite;
                        
                        printf( $link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name );
                        // Check is current page
                        if( $set_current )
                            echo $before . get_the_title() . $after;
                    // Check is property page
                    } else if( get_post_type() == 'property' ){
                        // Get property term
                        $property_terms = get_the_terms( get_the_ID(), 'property_type' );
                        if( !empty($property_terms) ){
                            // Run the loop
                            foreach( $property_terms as $term ){
                                $term_link = get_term_link($term);
                                if( is_wp_error($term_link) ){
                                    continue;
                                }
                                echo '<li><a href="' . esc_url($term_link) . '">' . esc_attr( $term->name ). '</a></li>';
                            }
                        }
                        // Check current page
                        if( $set_current == 1 ){
                            echo $before . get_the_title() . $after;
                        }

                    } else {
                        // Get the category list
                        $sep    = '';
                        $cat    = get_the_category();
                        $cat    = $cat[0];
                        $cats   = get_category_parents($cat, TRUE, $sep);

                        // Check the category and status
                        if( !$set_current || get_query_var('cpage') ) 
                            $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);

                        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);

                        echo $cats;                        
                        // Check category page
                        if( get_query_var('cpage') ){
                            echo $separator_temp . sprintf($link, get_permalink(), get_the_title()) . $separator_temp . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                        } else {
                            if( $set_current ) 
                                echo $before . get_the_title() . $after;
                        }
                    }
                // Check custom post type page
                } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
                    // Get post object
                    $post_type = get_post_type_object(get_post_type());
                    // Check paged query
                    if( get_query_var('paged') ){
                        echo $separator_temp . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $separator_temp . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        if( $set_current ) 
                            echo $separator_temp . $before . $post_type->label . $after;
                    }
                // Check is attachment page
                } elseif ( is_attachment() ) {
                    // Check is home page
                    if( $set_home_link )
                        echo $separator_temp;
                    // Get page parent
                    $parent = get_post($parent_id);                    
                    $cat    = get_the_category($parent->ID); $cat = $cat[0];                    
                    // Check category is set
                    if( $cat ){
                        $cats = get_category_parents($cat, TRUE, $sep);
                        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                        echo $cats;
                    }
                    printf( $link, get_permalink($parent), $parent->post_title );
                    // Check current page is set
                    if( $set_current ) 
                        echo $separator_temp . $before . get_the_title() . $after;
                // Check is page
                } elseif ( is_page() && !$parent_id ){
                    if( $set_current )
                        echo $before . get_the_title() . $after;
                // Check page with parent
                } elseif ( is_page() && $parent_id ) {
                    // Check home page link
                    if( $set_home_link ) 
                        echo $separator_temp;                    
                    if( $parent_id != $frontpage_id ){                        
                        $breadcrumbs = array();
                        // Run the loop
                        while( $parent_id ){                            
                            $page = get_page($parent_id);                            
                            if( $parent_id != $frontpage_id ){
                                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                            }
                            $parent_id = $page->post_parent;
                        }
                        // Reverse the breadcrumb array
                        $breadcrumbs = array_reverse($breadcrumbs);
                        for( $i = 0; $i < count($breadcrumbs); $i++ ){
                            echo $breadcrumbs[$i];                            
                            if( $i != count($breadcrumbs)-1 )
                                echo $separator_temp;
                        }
                    }
                    // Check is current page
                    if( $set_current )
                        echo $separator_temp . $before . get_the_title() . $after;
                // Check is atag page
                } elseif ( is_tag() ){
                    // Get paged
                    if( get_query_var('paged') ){
                        // Get tag object
                        $tag_id = get_queried_object_id();
                        $tag = get_tag($tag_id);
                        echo $separator_temp . sprintf($link, get_tag_link($tag_id), $tag->name) . $separator_temp . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        // Check page is current
                        if( $set_current )
                            echo $separator_temp . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
                    }
                // Check is author page
                } elseif ( is_author() ){
                    global $author;
                    // Get author name
                    $author = get_userdata($author);
                    // Get pages query
                    if( get_query_var('paged') ){
                        // Check is home page
                        if( $set_home_link ) 
                            echo $separator_temp;                        
                        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $separator_temp . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        // Check is home page
                        if( $set_home_link && $set_current ) 
                            echo $separator_temp;
                        // Check is current page
                        if( $set_current) 
                            echo $before . sprintf($text['author'], $author->display_name) . $after;
                    }
                // Check is 404 page
                } elseif ( is_404() ){
                    // Check is home page
                    if( $set_home_link && $set_current ) 
                        echo $separator_temp;
                    // Check is current page
                    if( $set_current ) 
                        echo $before . $text['404'] . $after;
                // Check post format
                } elseif ( has_post_format() && !is_singular() ){
                    // Check the home page link
                    if( $set_home_link )
                        echo $separator_temp;                    
                    echo get_post_format_string( get_post_format() );
                }            
            }
        }
    }
}

// Blog breadcrumb
if ( ! function_exists( 'cityestate_blog_breadcrumbs' ) ){
    
    function cityestate_blog_breadcrumbs(){
        // Get breadcrumb status
        $show_breadcrumb = cityestate_option( 'show_breadcrumb' );

        if( $show_breadcrumb != 0 ){            
            
            global $post;
            
            // Set static label
            $text['home']     = esc_html__( 'Home', 'cityestate' );
            $text['author']   = esc_html__( 'Articles Posted by %s', 'cityestate' );
            $text['404']      = esc_html__( 'Error 404', 'cityestate' );
            $text['category'] = esc_html__( 'Archive by Category "%s"', 'cityestate' );
            $text['search']   = esc_html__( 'Search Results for "%s" Query', 'cityestate' );
            $text['tag']      = esc_html__( 'Posts Tagged "%s"', 'cityestate' );
            $text['page']     = esc_html__( 'Page %s', 'cityestate' );
            $text['cpage']    = esc_html__( 'Comment Page %s', 'cityestate' );
            
            // Set separator
            $separator_before     = '<span aria-hidden="true">';
            $separator_temp            = '<i class="fa fa-angle-right"></i>';
            $separator_after      = '</span>';
            
            // Set home page status
            $set_home_link = 1;
            $set_on_home   = 0;
            $set_current   = 1;
            $before         = '<li class="active">';
            $after          = '</li>';
            
            // Set link
            $home_link      = home_url('/');
            $link_before    = '<li>';
            $link_after     = '</li>';
            $link_attr      = '';
            $link_in_before = '';
            $link_in_after  = '';
            $link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
            $frontpage_id   = get_option('page_on_front');
            $parent_id      = $post->post_parent;        
            $separator_temp            = ' ' . $separator_before . $separator_temp . $separator_after . ' ';

            // Set home link
            if( $set_home_link ) 
                echo sprintf( $link, $home_link, $text['home'] );

            if( is_home() ){
                echo $separator_temp . $before . esc_html__( 'Blog', 'cityestate' ) . $after;
            }
            
        }
    }
}

// Filter the string
if( ! function_exists( 'cityestate_string_filter' ) ){
    function cityestate_string_filter( $string ){
        // Filter the string
        $string = preg_replace( '/&#36;/', '', $string );
        $string = preg_replace( '/[^A-Za-z0-9\-]/', '', $string );
        $string = preg_replace( '/\D/', '', $string );
        return $string;
    }
}

// Comment list customization
if( ! function_exists( 'cityestate_comment_callback' ) ){

    function cityestate_comment_callback( $comment, $args, $depth ){
        // Get global comment
        $GLOBALS['comment'] = $comment; ?>

        <!-- List comment -->
        <li <?php comment_class('media'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="row">
                <div class="col-sm-2 col-xs-3">
                    <!-- Comment author photo -->
                    <?php echo get_avatar( $comment, 100 ); ?>
                </div>
                <div class="col-sm-10 col-xs-9">
                    <div class="replyer_name">
                        <!-- Author name -->
                        <h4><?php comment_author(); ?></h4>
                    </div>
                    <span class="reply_date_time"><?php printf( esc_html__( '%1$s at %2$s', 'cityestate' ), get_comment_date(), get_comment_time() ); ?></span>                    
                    <!-- Author comment status -->
                    <div class="reply_message">
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'cityestate' ); ?></em>
                         <?php else:
                            comment_text();
                        endif; ?>
                    </div>
                    <!-- Edit comment link -->
                    <?php edit_comment_link( esc_html__( 'Edit', 'cityestate' ), ' ' );
                    
                    $html_array = array( 'i' => array( 'class' => array() ) ); 

                    comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses(__( 'Reply <i class="fa fa-angle-right"></i>', 'cityestate' ), $html_array ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </div>
        <?php
    }
}

// Get user dashboard properties
if( !function_exists('cityestate_user_property_list') ){

    function cityestate_user_property_list(){
        // Collect the args and get pages
        $args = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_properties.php' );
        $page = get_pages($args);
        // Check page is found
        if( $page ){
            $properties_page = get_permalink( $page[0]->ID );
        } else {
            $properties_page = home_url('/');
        }
        return $properties_page;
    }
}

// Get submit property url
if( !function_exists('cityestate_user_submit_property') ){
    
    function cityestate_user_submit_property(){
        // Collect the args and get pages
        $args   = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_submit_property.php' );
        $pages  = get_pages($args);
        // Check page is found
        if( $pages ){
            $submit_page = get_permalink( $pages[0]->ID );
        } else {
            $submit_page = home_url('/');
        }
        return $submit_page;
    }
}

// Get favorites properties dashboard
if( !function_exists('cityestate_user_favorite_property_page') ){
    
    function cityestate_user_favorite_property_page(){
        // Collect the args and get pages
        $args   = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_favorites.php' );
        $pages  = get_pages($args);
        // Check page is found
        if( $pages ){
            $favorite_page = get_permalink( $pages[0]->ID );
        } else {
            $favorite_page = home_url('/');
        }
        return $favorite_page;
    }
}

// Get Saved Search dashboard
if( !function_exists('cityestate_user_save_search_link') ){
    
    function cityestate_user_save_search_link(){
        // Collect the args and get pages
        $args   = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_saved_search.php' );
        $pages  = get_pages($args);
        // Check page is found
        if( $pages ){
            $search_page = get_permalink( $pages[0]->ID );
        } else {
            $search_page = home_url('/');
        }
        return $search_page;
    }
}

// Get invoice dashboard
if( !function_exists('cityestate_user_invoice_page_link') ){
    
    function cityestate_user_invoice_page_link(){
        // Collect the args and get pages
        $args   = array( 'meta_key' => '_wp_page_template', 'meta_value' => 'templates/dashboard_invoices.php' );
        $pages  = get_pages($args);
        // Check page is found
        if( $pages ){
            $invoice_page = get_permalink( $pages[0]->ID );
        } else {
            $invoice_page = home_url('/');
        }
        return $invoice_page;
    }
}

// Near by place type
function cityestate_near_by_places(){
    return array( "accounting" => "Accounting", "airport" => "Airport", "amusement_park" => "Amusement Park", "aquarium" => "Aquarium", "art_gallery" => "Art Gallery", "atm" => "ATM", "bakery" => "Bakery", "bank" => "Bank", "bar" => "Bar", "beauty_salon" => "Beauty Salon", "bicycle_store" => "Bicycle Store", "book_store" => "Book Store", "bowling_alley" => "Bowling Alley", "bus_station" => "Bus Station", "cafe" => "Cafe", "campground" => "Campground", "car_dealer" => "Car Dealer", "car_rental" => "Car Rental", "car_repair" => "Car Repair", "car_wash" => "Car Wash", "casino" => "Casino", "cemetery" => "Cemetery", "church" => "Church", "city_hall" => "City Hall", "clothing_store" => "Clothing Store", "convenience_store" => "Convenience Store", "courthouse" => "Courthouse", "dentist" => "Dentist", "department_store" => "Department Store", "doctor" => "Doctor", "electrician" => "Electrician", "electronics_store" => "Electronics Store", "embassy" => "Embassy", "establishment" => "Establishment", "finance" => "Finance", "fire_station" => "Fire Station", "florist" => "Florist", "food" => "Food", "funeral_home" => "Funeral Home", "furniture_store" => "Furniture Store", "gas_station" => "Gas Station", "general_contractor" => "General Contractor", "grocery_or_supermarket" => "Grocery or Supermarket", "gym" => "Gym", "hair_care" => "Hair Care", "hardware_store" => "Hardware Store", "health" => "Health", "hindu_temple" => "Hindu Temple", "home_goods_store" => "Home Goods Store", "hospital" => "Hospital", "insurance_agency" => "Insurance Agency", "jewelry_store" => "Jewelry Store", "laundry" => "Laundry", "lawyer" => "Lawyer", "library" => "Library", "liquor_store" => "Liquor Store", "local_government_office" => "Local Government Office", "locksmith" => "Locksmith", "lodging" => "Lodging", "meal_delivery" => "Meal Delivery", "meal_takeaway" => "Meal Takeaway", "mosque" => "Mosque", "movie_rental" => "Movie Rental", "movie_theater" => "Movie Theater", "moving_company" => "Moving Company", "museum" => "Museum", "night_club" => "Night Club", "painter" => "Painter", "park" => "Park", "parking" => "Parking", "pet_store" => "Pet Store", "pharmacy" => "Pharmacy", "physiotherapist" => "Physiotherapist", "place_of_worship" => "Place Of Worship", "plumber" => "Plumber", "police" => "Police", "post_office" => "Post Office", "real_estate_agency" => "Real Estate Agency", "restaurant" => "Restaurant", "roofing_contractor" => "Roofing Contractor", "rv_park" => "RV Park", "school" => "School", "shoe_store" => "Shoe Store", "shopping_mall" => "Shopping Mall", "spa" => "Spa", "stadium" => "Stadium", "storage" => "Storage", "store" => "Store", "subway_station" => "Subway Station", "synagogue" => "Synagogue", "taxi_stand" => "Taxi Stand", "train_station" => "Train Station", "travel_agency" => "Travel Agency", "university" => "University", "veterinary_care" => "Veterinary Care", "zoo" => "Zoo" );
}