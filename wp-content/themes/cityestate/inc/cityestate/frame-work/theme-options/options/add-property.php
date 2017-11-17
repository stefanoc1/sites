<?php
Redux::setSection( $opt_name, array(

    'title'     => esc_html__( 'Submit Property Options', 'cityestate' ),
    'id'        => 'add-property-page',
    'desc'      => '',
    'icon'      => 'el-icon-cog el-icon-small',
    'fields'    => array(
        
        array(
            'id'       => 'generate_property_id',
            'type'     => 'switch',
            'title'    => esc_html__( 'Auto Generated Property ID ?', 'cityestate' ),
            'subtitle' => esc_html__( 'Enable/Disable auto generated property id', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' ),
        ),

        array(
            'id'      => 'property_submit_layout',
            'type'    => 'sorter',
            'title'   => esc_html__( 'Submission Form Layout Manager', 'cityestate' ),
            'desc'    => esc_html__( 'Drag and drop layout manager, to quickly organize your property submission form layout.', 'cityestate' ),
            'options' => array(
                                'enabled'  => array(
                                    'description'               => esc_html__( 'Description', 'cityestate' ),
                                    'media'                     => esc_html__( 'Media', 'cityestate' ),
                                    'details'                   => esc_html__( 'Details', 'cityestate' ),
                                    'location'                  => esc_html__( 'Location', 'cityestate' ),
                                    'features'                  => esc_html__( 'Features', 'cityestate' ),
                                    'amenities'                 => esc_html__( 'Amenities', 'cityestate' ),
                                    'essential_infomation'      => esc_html__( 'Essential Infomation', 'cityestate' ),
                                    'flooring_goods_included'   => esc_html__( 'Flooring & Goods included', 'cityestate' ),
                                    'interior_exterior'         => esc_html__( 'Interior & Exterior', 'cityestate' ),
                                    'room_dimensions'           => esc_html__( 'Room Dimensions', 'cityestate' ),
                                    'floor_plans'               => esc_html__( 'Floor Plans', 'cityestate' ),                                    
                                    'property_video'            => esc_html__( 'Property Video', 'cityestate' ),
                                    'near_by_place'             => esc_html__( 'Near By Place', 'cityestate' ),
                                    'agent_information'         => esc_html__( 'Agent Information', 'cityestate' ),
                                ),
                                'disabled' => array()
            ),
        ),
        
        array(
            'id'       => 'show_property_location',
            'type'     => 'select',
            'title'    => esc_html__('Show dropdowns for Property Location ?', 'cityestate'),
            'subtitle' => esc_html__('Show dropdowns for Property Location ( Neighborhood, City, State/County ) ?', 'cityestate'),
            'options'  => array(
                                'yes' => esc_html__( 'Yes', 'cityestate' ),
                                'no'  => esc_html__( 'No', 'cityestate' )
                        ),
            'default'  => 'no',
        ),

        array(
            'id'       => 'property_year_built',
            'type'     => 'select',
            'title'    => esc_html__( 'Show Calender for Year Built Field ?', 'cityestate' ),
            'options'  => array(
                            'yes'   => esc_html__( 'Yes', 'cityestate' ),
                            'no'    => esc_html__( 'No', 'cityestate' )
                        ),
            'default'  => 'yes',
        ),
        
        array(
            'id'        => 'set_area_prefix',
            'type'      => 'select',
            'title'     => esc_html__( 'Default area prefix', 'cityestate' ),
            'subtitle'  => esc_html__( 'Default option for area prefix.', 'cityestate' ),
            'options'   => array(
                            'SqFt'  => esc_html__( 'Square Feet - ft²', 'cityestate' ),
                            'm²'    => esc_html__( 'Square Meters - m²', 'cityestate' ),
                        ),
            'default'   => 'SqFt'
        ),
        
        array(
            'id'       => 'user_set_area_prefix',
            'type'     => 'switch',
            'title'    => esc_html__( 'Can user change area prefix?', 'cityestate' ),
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' ),
        ),

        array(
            'id'        => 'property_image_limit',
            'type'      => 'text',
            'title'     => esc_html__( 'Maximum Images Per Property', 'cityestate' ),
            'subtitle'  => esc_html__( 'Maximum images allow for single property.', 'cityestate' ),
            'default'   => '10'
        ),
        
        array(
            'id'        => 'property_image_size',
            'type'      => 'text',
            'title'     => esc_html__( 'Maximum File Size Per Property', 'cityestate' ),
            'subtitle'  => esc_html__( 'Maximum upload image size. For example 10kb, 500kb, 1mb, 10m, 100mb', 'cityestate' ),
            'default'   => '1000kb'
        ),

    )

));

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Show/Hide Fields', 'cityestate' ),
    'id'            => 'property-showhide',
    'subsection'    => true,
    'fields'        => array(

        array(
            'id'        => 'show_submit_property_field',
            'type'      => 'checkbox',
            'title'     => esc_html__( 'Submit Property Form Fields', 'cityestate' ),
            'subtitle'  => esc_html__( 'Choose which fields you want to hide on add property page?', 'cityestate' ),
            'options'   => array(
                                'property_id'       => esc_html__( 'Property ID', 'cityestate' ),
                                'property_type'     => esc_html__( 'Type', 'cityestate' ),
                                'property_status'   => esc_html__( 'Status', 'cityestate' ),
                                'property_label'    => esc_html__( 'Label', 'cityestate' ),
                                'sale_rent_price'   => esc_html__( 'Sale or Rent Price', 'cityestate' ),
                                'second_price'      => esc_html__( 'Second Price (Optional)', 'cityestate' ),
                                'price_postfix'     => esc_html__( 'After Price Label (ex: monthly)', 'cityestate' ),
                                'bedrooms'          => esc_html__( 'Bedrooms', 'cityestate' ),
                                'bathrooms'         => esc_html__( 'Bathrooms', 'cityestate' ),
                                'area_size'         => esc_html__( 'Area Size', 'cityestate' ),
                                'garages'           => esc_html__( 'Garage', 'cityestate' ),
                                'year_built'        => esc_html__( 'Year Built', 'cityestate' ),                                
                                'address'           => esc_html__( 'Address (*only street name and building no)', 'cityestate' ),
                            ),
            'default'   => array(
                                'property_id'       => '0',
                                'property_type'     => '0',
                                'property_status'   => '0',
                                'property_label'    => '0',
                                'sale_rent_price'   => '0',
                                'second_price'      => '0',
                                'price_postfix'     => '0',
                                'bedrooms'          => '0',
                                'bathrooms'         => '0',
                                'area_size'         => '0',
                                'garages'           => '0',
                                'year_built'        => '0',
                                'address'           => '0',
                            )
        ),

    )

));

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Required Fields', 'cityestate' ),
    'id'            => 'property-required-fields',
    'subsection'    => true,
    'fields'        => array(

        array(
            'id'       => 'required_submit_property_field',
            'type'     => 'checkbox',
            'title'    => esc_html__( 'Required Fields', 'cityestate' ),
            'subtitle' => esc_html__( 'Make add property fields required.', 'cityestate' ),
            'options'  => array(
                                'property_title'            => esc_html__( 'Title', 'cityestate' ),
                                'property_type'             => esc_html__( 'Type', 'cityestate' ),
                                'property_status'           => esc_html__( 'Status', 'cityestate' ),
                                'property_label'            => esc_html__( 'Label', 'cityestate' ),
                                'property_price'            => esc_html__( 'Sale or Rent Price', 'cityestate' ),
                                'property_price_label'      => esc_html__( 'After Price Label', 'cityestate' ),
                                'property_id'               => esc_html__( 'Property ID', 'cityestate' ),
                                'property_beds'             => esc_html__( 'Bedrooms', 'cityestate' ),
                                'property_baths'            => esc_html__( 'Bathrooms', 'cityestate' ),
                                'property_size'             => esc_html__( 'Area Size', 'cityestate' ),
                                'property_garage'           => esc_html__( 'Garages', 'cityestate' ),
                                'property_year_built'       => esc_html__( 'Year Built', 'cityestate' ),
                                'property_short_address'    => esc_html__( 'Address (*only street name and building no)', 'cityestate' ),
                            ),
            'default'  => array(
                                'property_title'            => '0',
                                'property_type'             => '0',
                                'property_status'           => '0',
                                'property_label'            => '0',
                                'property_price'            => '0',
                                'property_price_label'      => '0',
                                'property_id'               => '0',
                                'property_beds'             => '0',
                                'property_baths'            => '0',
                                'property_size'             => '0',
                                'property_garage'           => '0',
                                'property_year_built'       => '0',
                                'property_short_address'    => '0',
                            )
        ),

    )

));

?>