<?php

// Advance Search
Redux::setSection( $opt_name, array(
    
    'title'  => esc_html__( 'Advanced Search Form', 'cityestate' ),
    'id'     => 'advanced-search-cityestate',
    'icon'   => 'el-icon-cog',
    'fields' => array(

        array(
            'id'       => 'show_advance_search_on_header',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Advanced Search Form ?', 'cityestate' ),
            'subtitle' => esc_html__( 'Show/Hide advanced search form over header type: map, revolution slider, image, property slider and video.', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' )
        ),        

        array(
            'id'       => 'show_advance_search_header_page',
            'type'     => 'select',
            'title'    => esc_html__( 'Search Form on Which Pages', 'cityestate' ),
            'options'  => array(
				                'only_home'			=> esc_html__( 'Only Homepage', 'cityestate' ),
				                'all_pages'			=> esc_html__( 'Homepage + Inner Pages', 'cityestate' ),
				                'only_innerpages' 	=> esc_html__( 'Only Inner Pages', 'cityestate' ),
				                'specific_pages' 	=> esc_html__( 'Specific Pages', 'cityestate' )
				            ),
            'desc'     => esc_html__( 'Select on which pages you want to show search form', 'cityestate' ),
            'default'  => 'only_home'
        ),

        array(
            'id'       => 'show_advance_search_header_specific',
            'type'     => 'select',
            'multi'    => true,
            'required' => array( 'show_advance_search_header_page', '=', 'specific_pages' ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select multiple pages', 'cityestate' ),
            'data'     => 'pages'
        ),

        array(
            'id'       => 'enable_disable_save_search',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Save Search Feature.', 'cityestate' ),
            'subtitle' => esc_html__( 'Save search option on search result page', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' )
        ),

        array(
            'id'     => 'advanced-search-pricerang-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => __( '<span class="font24">Advanced Search Price range for price slider.</span>', 'cityestate' )
        ),

        array(
            'id'		=> 'adv_sea_min_price',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Minimum Price', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> '200'            
        ),

        array(
            'id'		=> 'adv_sea_max_price',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Maximum Price', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> '2500000'            
        ),

        array(
            'id'        => 'adv_sea_min_max_price',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Prices Options for Advance Search Form', 'cityestate' ),
            'read-only' => false,
            'default'   => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'cityestate' ),
        ),

        array(
            'id'     => 'beds-baths-info',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses(__( '<span class="font24">Bedrooms, Bathrooms & Garage</span>', 'cityestate' ), $allowed_html_array )
        ),

        array(
            'id'		=> 'adv_sea_bedrooms',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Number of Bedrooms', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> '1,2,3,4,5,6,7,8,9,10',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', 'cityestate' )
        ),

        array(
            'id'		=> 'adv_sea_bathrooms',
            'type'		=> 'textarea',
            'title'		=> esc_html__( 'Number of Bathrooms', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> '1,2,3,4,5,6,7,8,9,10',
            'subtitle'	=> esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', 'cityestate' )
        ),

        array(
            'id'        => 'adv_sea_garages',
            'type'      => 'textarea',
            'title'     => esc_html__( 'Number of Garage', 'cityestate' ),
            'read-only' => false,
            'default'   => '1,2,3,4,5,6,7,8,9,10',
            'subtitle'  => esc_html__( 'Only provide comma separated numbers. Do not add dashes, spaces and currency signs.', 'cityestate' )
        )

    )

));

Redux::setSection( $opt_name, array(
    'title'  		=> esc_html__( 'Search Form Fields', 'cityestate' ),
    'id'     		=> 'adv-search-fields',
    'subsection' 	=> true,
    'fields' 		=> array(

        array(
            'id'       => 'adv_sea_keyword_search',
            'type'     => 'select',
            'title'    => esc_html__( 'Keywords Field', 'cityestate' ),
            'subtitle' => esc_html__( 'What keyword field should search from ?', 'cityestate' ),
            'options'  => array(
				                'property_title' 	    => esc_html__( 'Property Title + Content', 'cityestate' ),
				                'property_address' 	    => esc_html__( 'Property Address + Street + Zip', 'cityestate' ),
                                'property_city_state'   => esc_html__( 'Search State, City or Area', 'cityestate' ),
				            ),
            'default'  => 'property_address'
        ),

        array(
            'id'       => 'adv_sea_keyword_auto',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Complete', 'cityestate' ),
            'subtitle' => esc_html__( 'Enable/Disable auto complete for keyeord field.', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', 'cityestate' ),
            'off'      => esc_html__( 'Disable', 'cityestate' ),
        ),

        array(
            'id'       => 'adv_sea_show_hide_fileds',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Hide Advanced Search Fields', 'cityestate' ),
            'subtitle' => esc_html__( 'Show/Hide advanced search fields', 'cityestate' ),
            'options'  => array(
				                'keyword'           => esc_html__( 'Keyword', 'cityestate' ),
                                'type'              => esc_html__( 'Type', 'cityestate' ),
                                'status'            => esc_html__( 'Status', 'cityestate' ),
                                'location' 			=> esc_html__( 'State / Country', 'cityestate' ),
				                'bedrooms' 			=> esc_html__( 'Bedrooms', 'cityestate' ),
				                'bathrooms' 		=> esc_html__( 'Bathrooms', 'cityestate' ),
				                'garages' 			=> esc_html__( 'Garages', 'cityestate' ),
				                'price_slider' 		=> esc_html__( 'Price Range Slider', 'cityestate' ),				                
				                'other_features' 	=> esc_html__( 'Other Features', 'cityestate' )
				            ),
            'default'  => array(
				                'keyword' 			=> '0',
				                'type' 				=> '0',
				                'status' 			=> '0',
				                'location' 			=> '0',
				                'bedrooms'          => '0',
				                'bathrooms' 		=> '0',
				                'garages' 		    => '0',
				                'price_slider' 		=> '0',
				                'other_features' 	=> '0',				                
           					)
        )

    )

));

Redux::setSection( $opt_name, array(
    'title'  		=> esc_html__( 'Search Result Page', 'cityestate' ),
    'id'     		=> 'adv-search-resultpage',
    'subsection' 	=> true,
    'fields' 		=> array(

        array(
            'id'       => 'adv_sea_result_layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Properties Layout', 'cityestate' ),
            'subtitle' => esc_html__( 'Select properties list layout for search result page.', 'cityestate' ),
            'options'  => array(
				                'list_list_view' => esc_html__( 'List View', 'cityestate' ),
				                'list_grid_view' => esc_html__( 'Grid View', 'cityestate' ),
				            ),
            'default' => 'list_list_view'
        ),

        array(
            'id'       => 'adv_sea_result_order',
            'type'     => 'select',
            'title'    => esc_html__( 'Default Order', 'cityestate' ),
            'subtitle' => esc_html__( 'Select result page properties default display order.', 'cityestate' ),
            'options'  => array(
                                'sort_lh'   => esc_html__( 'Price (Low to High)', 'cityestate' ),
                                'sort_hl'   => esc_html__( 'Price (High to Low)', 'cityestate' ),                                
                                'featured'  => esc_html__( 'Featured', 'cityestate' ),
                                'sort_no'   => esc_html__( 'Date New to Old', 'cityestate' ),
                                'sort_on'   => esc_html__( 'Date Old to New', 'cityestate' ),
                                
                            ),
            'default' => 'sort_no'
        ),

        array(
            'id'       => 'adv_sea_number_property',
            'type'     => 'text',
            'title'    => esc_html__( 'Number of Listings to Show Per Pages', 'cityestate' ),            
            'default'  => '9'
        )

    )

));

?>