<?php

// Get terms using term name and specific values
if( ! function_exists( 'cityestate_get_terms' ) ){
    function cityestate_get_terms( $term_name, &$cityestate_terms_array ){
        $cityestate_terms = get_terms( $term_name, array( 'hide_empty' => false ) );
        // Get the child term if available
        cityestate_term_child( 0, $cityestate_terms, $cityestate_terms_array );
    }
}

// Get revolution slider name
if( !function_exists('cityestate_revolution_slider') ){

    function cityestate_revolution_slider(){        
        global $wpdb;
        $slider_list = array();
        
        // Check revolution slider is active or not
        if( is_plugin_active('revslider/revslider.php') ){            
            $slider_list = array();
            // Get sliders from database
            $revolution_sliders = $wpdb->get_results($q = "SELECT * FROM " . $wpdb->prefix . "revslider_sliders ORDER BY id LIMIT 50");
            foreach( $revolution_sliders as $key => $item ){
                $slider_list[$item->alias] = stripslashes($item->title);
            }
        }
        return $slider_list;
    }
}

// Get terms using child term name and specific values
if( ! function_exists( 'cityestate_term_child' ) ){
    function cityestate_term_child( $parent_id, $cityestate_terms, &$cityestate_terms_array, $prefix = '' ) {    
        // Check is empty
        if( ! empty( $cityestate_terms ) ){
            // Start the loop
            foreach( $cityestate_terms as $term ){                
                // Check is term is parent
                if( $term->parent == $parent_id ){
                    $cityestate_terms_array[ $term->slug ] = $prefix . $term->name;
                    // Get the child term if available
                    cityestate_term_child( $term->term_id, $cityestate_terms, $cityestate_terms_array, $prefix . '- ' );
                }
            }
        }
    }
}

// Declare array
$property_type      = array();
$property_status    = array();
$property_feature   = array();
$property_area      = array();
$property_city      = array();
$property_location  = array();

// Get property terms
cityestate_get_terms( 'property_type', $property_type );
cityestate_get_terms( 'property_status', $property_status );
cityestate_get_terms( 'property_feature', $property_feature );
cityestate_get_terms( 'property_area', $property_area );
cityestate_get_terms( 'property_city', $property_city );
cityestate_get_terms( 'property_location', $property_location );

// Page or post metabox
$meta_boxes[] = array(

    'id'        => 'cityestate_page_setting',    
    'title'     => esc_html__('Page Header Options', 'cityestate' ),    
    'pages'     => array( 'page', 'post'),    
    'context'   => 'normal',
    'fields'    => array(

        array(
            'name'      => esc_html__( 'Header Type', 'cityestate' ),
            'id'        => 'header_type',
            'type'      => 'select',
            'options'   => array(
                                    'none'              => esc_html__( 'None', 'cityestate' ),
                                    'property_slider'   => esc_html__( 'Properties Slider', 'cityestate' ),
                                    'revolution_slider' => esc_html__( 'Revolution Slider', 'cityestate' ),
                                    'property_map'      => esc_html__( 'Properties Google Map', 'cityestate' ),
                                    'static_image'      => esc_html__( 'Image', 'cityestate' ),
                                    'splace_background' => esc_html__( 'Splace Header', 'cityestate' ),
                            ),
            'std'       => array( 'none' ),
            'desc'      => esc_html__( 'Choose page header type', 'cityestate' ),
        ),

        array(
            'name'      => esc_html__( 'Title', 'cityestate' ),
            'id'        => 'page_banner_title',
            'type'      => 'text',            
        ),

        array(
            'name'      => esc_html__( 'Subtitle', 'cityestate' ),
            'id'        => 'page_banner_subtitle',
            'type'      => 'text',
        ),

        array(
            'name'          => esc_html__( 'Revolution Slider', 'cityestate' ),
            'id'            => 'page_banner_rev_slider',
            'type'          => 'select_advanced',
            'std'           => '',
            'options'       => cityestate_revolution_slider(),
            'multiple'      => false,
            'placeholder'   => esc_html__( 'Select an Slider', 'cityestate' ),            
        ),

        array(
            'name'              => esc_html__( 'Image', 'cityestate' ),
            'id'                => 'page_banner_image',
            'type'              => 'image_advanced',
            'max_file_uploads'  => 1,            
        ),

        array(
            'name'      => esc_html__( 'Image Height', 'cityestate' ),
            'id'        => 'page_banner_height',
            'type'      => 'text',            
            'desc'      => esc_html__( 'Default 600px', 'cityestate '),
        ),

        array(
            'name'      => esc_html__( 'Overlay Color', 'cityestate' ),
            'id'        => 'page_banner_overlay',
            'type'      => 'color',
        ),

        array(
            'name'      => esc_html__( 'Overlay Color Opacity', 'cityestate' ),
            'id'        => 'page_banner_opacity',
            'type'      => 'select',
            'options'   => array(
                                    '0'     => '0',
                                    '0.1'   => '1',
                                    '0.2'   => '2',
                                    '0.3'   => '3',
                                    '0.4'   => '4',
                                    '0.5'   => '5',
                                    '0.6'   => '6',
                                    '0.7'   => '7',
                                    '0.8'   => '8',
                                    '0.9'   => '9',
                                    '1'     => '10',
                            ),
            'std'       => array( '0.5' ),            
        ),
        
        array(
            'name'      => esc_html__( 'Select City', 'cityestate'),
            'id'        => 'page_map_city',
            'type'      => 'select',
            'options'   => $property_city,
            'desc'      => esc_html__( 'Choose city for proeprties on map header, you can select multiple cities or keep all un-select to show from all cities. If you are adding agent then dont select any city', 'cityestate'),
            'multiple'  => true
        ),

        array(
            'name'      => esc_html__( 'Show Original Page Title', 'cityestate' ),
            'id'        => 'original_page_title',
            'type'      => 'select',
            'options'   => array(
                                    'yes'              => esc_html__( 'Yes', 'cityestate' ),
                                    'no'   => esc_html__( 'No', 'cityestate' ),
                            ),
            'std'       => array( 'none' ),
            'desc'      => esc_html__( 'Choose page header type', 'cityestate' ),
        ),
    )
);

// Page or post metabox
$meta_boxes[] = array(

    'id'        => 'default_template',    
    'title'     => esc_html__( 'Default Template Options', 'cityestate' ),    
    'pages'     => array( 'page', 'post' ),    
    'context' 	=> 'normal',
    'fields'    => array(

        array(
            'name'      => esc_html__( 'Sidebar Position', 'cityestate' ),
            'id'        => 'sidebar_position',
            'type'      => 'select',
            'options'   => array(
				                	'none'     => esc_html__( 'None', 'cityestate' ),				                	
                                    'right'    => esc_html__( 'Right Sidebar', 'cityestate' ),
				                	'left' 	   => esc_html__( 'Left Sidebar', 'cityestate' )
				            ),
            'std'       => array( 'none' ),
            'desc'      => esc_html__( 'Choose page Sidebar Position', 'cityestate' ),
        ),

        array(
            'name'      => esc_html__( 'Select Sidebar', 'cityestate' ),
            'id'        => 'page_sidebar',
            'type'      => 'select',
            'options'   => array(
                                    'none'                      => esc_html__( 'None', 'cityestate' ),                                   
                                    'right-sidebar'             => esc_html__( 'Right Sidebar', 'cityestate' ),
                                    'left-sidebar'              => esc_html__( 'Left Sidebar', 'cityestate' ),
                                    'property-listing'          => esc_html__( 'Property Listings', 'cityestate' ),
                                    'single-property'           => esc_html__( 'Single Property', 'cityestate' ),
                                    'agent-sidebar'             => esc_html__( 'Agent Sidebar', 'cityestate' ),
                                    'search-sidebar'            => esc_html__( 'Search Sidebar', 'cityestate' ),
                                    'page-sidebar'              => esc_html__( 'Page Sidebar', 'cityestate' ),
                                    'idx-sidebar'               => esc_html__( 'IDX Sidebar', 'cityestate' ),                                    
                            ),
            'std'       => array( 'none' ),
            'desc'      => esc_html__( 'Choose page Sidebar', 'cityestate' ),
        ),
    )
);

// Metabox for listing template
$meta_boxes[] = array(

    'id'        => 'listing_template',
    'title'     => esc_html__( 'Property Listing Advanced Options', 'cityestate' ),
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'fields'    => array(
        
        array(
            'name'      => esc_html__( 'Default View', 'cityestate' ),
            'id'        => 'list_list_view',
            'type'      => 'select',
            'options'   => array(
                                    'list_list_view' => esc_html__( 'List View', 'cityestate' ),
                                    'list_grid_view' => esc_html__( 'Grid View', 'cityestate' ),
                                ),
            'std'       => array( 'list_list_view' ),
            'desc'      => esc_html__( 'Select default view for listing page', 'cityestate' ),
            'columns'   => 6,
        ),

        array(
            'name'      => esc_html__( 'Order Properties By', 'cityestate' ),
            'id'        => 'property_order_type',
            'type'      => 'select',
            'options'   => array(
                                    'sort_lh'  => esc_html__( 'Price (Low to High)', 'cityestate' ),
                                    'sort_hl'  => esc_html__( 'Price (High to Low)', 'cityestate' ),
                                    'sort_on'   => esc_html__( 'Date Old to New', 'cityestate' ),
                                    'sort_no'   => esc_html__( 'Date New to Old', 'cityestate' ),
                                ),
            'std'       => array( 'sort_lh' ),            
            'columns'   => 6,
        ),

        array(
            'name'      => esc_html__( 'Tabs', 'cityestate' ),
            'id'        => 'list_tab',
            'desc'      => esc_html__( 'Enable/Disable listing tabs', 'cityestate' ),
            'type'      => 'select',            
            'options'   => array( 'enable' => esc_html__( 'Enable', 'cityestate' ), 'disable' => esc_html__( 'Disable', 'cityestate' ) ),
            'columns'   => 12
        ),

        array(
            'name'      => esc_html__( 'Tabs One', 'cityestate' ),
            'id'        => 'list_tab1',
            'desc'      => esc_html__( 'Choose property status for this tab', 'cityestate' ),
            'type'      => 'select',            
            'options'   => $property_status,
            'std'       => '',
            'columns'   => 6
        ),

        array(
            'name'      => esc_html__( 'Tabs Two', 'cityestate' ),
            'id'        => 'list_tab2',
            'desc'      => esc_html__( 'Choose property status for this tab', 'cityestate' ),
            'type'      => 'select',            
            'options'   => $property_status,
            'std'       => '',
            'columns'   => 6
        ),

        array(
            'name'      => esc_html__( 'Number of listings to show', 'cityestate' ),            
            'id'        => 'number_property_show',
            'type'      => 'text',
            'std'       => '9',
            'columns'   => 12
        ),

        array(
            'name'      => esc_html__( 'Types', 'cityestate' ),
            'id'        => 'property_type',
            'type'      => 'select',
            'options'   => $property_type,            
            'columns'   => 6,
            'multiple'  => true
        ),

        array(
            'name'      => esc_html__( 'Status', 'cityestate' ),
            'id'        => 'property_status',
            'type'      => 'select',
            'options'   => $property_status,
            'columns'   => 6,
            'multiple'  => true
        ),

        array(
            'name'      => esc_html__( 'Features', 'cityestate' ),
            'id'        => 'property_feature',
            'type'      => 'select',
            'options'   => $property_feature,
            'columns'   => 6,
            'multiple'  => true
        ),
        
        array(
            'name'      => esc_html__( 'Area', 'cityestate' ),
            'id'        => 'property_area',
            'type'      => 'select',
            'options'   => $property_area,            
            'columns'   => 6,
            'multiple'  => true
        ),

        array(
            'name'      => esc_html__( 'City', 'cityestate' ),
            'id'        => 'property_city',
            'type'      => 'select',
            'options'   => $property_city,            
            'columns'   => 6,
            'multiple'  => true
        ),
               
        array(
            'name'      => esc_html__( 'State / Country', 'cityestate' ),
            'id'        => 'property_location',
            'type'      => 'select',
            'options'   => $property_location,            
            'columns'   => 6,
            'multiple'  => true
        ),
    )
);

// Video post type metabox
$meta_boxes[] = array(

    'title'         => esc_attr__( 'Cityestate Post Options', 'cityestate' ),
    'post_types'    => 'post',
    'fields'        => array(

        array(
            'id'    => 'featured_video_meta',
            'name'  => esc_attr__( 'Video or Audio iFrame', 'cityestate' ),
            'desc'  => esc_attr__( 'Enter the Embed Code', 'cityestate' ),
            'type'  => 'textarea',
        ),        
    ),
);

// Metabox for splash homepage
$meta_boxes[] = array(
    
    'id'        => 'cityestate_splash_setting',    
    'title'     => esc_html__( 'Splash Header Options', 'cityestate' ),    
    'pages'     => array( 'page' ),    
    'context'   => 'normal',
    'fields'    => array(

        array(
            'name'      => esc_html__( 'Full Screen', 'cityestate' ),
            'id'        => 'splash_full_screen',
            'type'      => 'select',
            'options'   => array(
                                    'no'    => esc_html__( 'No', 'cityestate' ),
                                    'yes'   => esc_html__( 'Yes', 'cityestate' )
                                ),
            'std'       => array( 'no' ),
            'desc'      => esc_html__( 'If "Yes" it will fit according to screen size' ,'cityestate' ),
        ),

        array(
            'name'      => esc_html__( 'Title', 'cityestate' ),
            'id'        => 'splash_title',
            'type'      => 'text',            
        ),

        array(
            'name'      => esc_html__( 'Subtitle', 'cityestate' ),
            'id'        => 'splash_subtitle',
            'type'      => 'text',
        ),

        array(
            'name'      => esc_html__( 'Show Search', 'cityestate' ),
            'id'        => 'splash_search',
            'type'      => 'select',
            'options'   => array(
                                    'no'    => esc_html__( 'No', 'cityestate' ),
                                    'yes'   => esc_html__( 'Yes', 'cityestate' )
                                ),
            'std'       => array( 'no' ),            
        ),

        array(
            'name'              => esc_html__( 'Background Image', 'cityestate' ),
            'id'                => 'splash_image',
            'type'              => 'image_advanced',
                    
        ),

        array(
            'name'      => esc_html__( 'Overlay Color', 'cityestate' ),
            'id'        => 'splash_image_overlay',
            'type'      => 'color',
        ),
        array(
            'name'      => esc_html__( 'Overlay Color Opacity', 'cityestate' ),
            'id'        => 'splash_image_opacity',
            'type'      => 'select',
            'options'   => array(
                                    '0'     => '0',
                                    '0.1'   => '1',
                                    '0.2'   => '2',
                                    '0.3'   => '3',
                                    '0.4'   => '4',
                                    '0.5'   => '5',
                                    '0.6'   => '6',
                                    '0.7'   => '7',
                                    '0.8'   => '8',
                                    '0.9'   => '9',
                                    '1'     => '10',
                            ),
            'std'       => array( '0.5' ),            
        ),
    )
);

?>