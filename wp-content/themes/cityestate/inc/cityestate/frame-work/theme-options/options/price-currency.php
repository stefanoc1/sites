<?php

// Price And Currency
Redux::setSection( $opt_name, array(

    'title'  => esc_html__( 'Price & Currency', 'cityestate' ),
    'id'     => 'price-format',
    'icon'   => 'el-icon-usd',
    'fields' => array(

        array(
            'id'		=> 'property_price_symbol',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Enter Currency Symbol', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> '$',
            'subtitle'	=> esc_html__( 'Enter currency sign. For Example: $.', 'cityestate' )
        ),

        array(
            'id'		=> 'property_price_position',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Position of the currency symbol', 'cityestate' ),
            'read-only'	=> false,
            'options'	=> array(
				                'before'	=> esc_html__( 'Before Digit', 'cityestate' ),
				                'after'		=> esc_html__( 'After Digit', 'cityestate' )
				            ),
            'default'	=> 'before'            
        ),

        array(
            'id'		=> 'property_price_decimal',
            'type'		=> 'select',
            'title'		=> esc_html__( 'Select Number of decimal points?', 'cityestate' ),
            'read-only'	=> false,
            'options'	=> array(
				                '0'	=> '0',
				                '1'	=> '1',
				                '2'	=> '2',
				                '3'	=> '3',
				                '4'	=> '4',
				                '5'	=> '5',
				                '6'	=> '6',
				                '7'	=> '7',
				                '8'	=> '8',
				                '9'	=> '9',
				                '10' => '10',
				            ),
            'default'	=> '0'            
        ),

        array(
            'id'		=> 'property_price_decimal_sep',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Enter Decimal Point Separator', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> '.',
            'subtitle'	=> esc_html__( 'Enter the decimal point separator. For Example: .', 'cityestate' )
        ),

        array(
            'id'		=> 'property_price_decimal_tho_sep',
            'type'		=> 'text',
            'title'		=> esc_html__( 'Enter Thousands Separator', 'cityestate' ),
            'read-only'	=> false,
            'default'	=> ',',
            'subtitle'	=> esc_html__( 'Enter the thousands separator. For Example: ,', 'cityestate' )
        )

    ),

));

?>