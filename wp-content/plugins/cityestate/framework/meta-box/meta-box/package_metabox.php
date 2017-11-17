<?php

// Package metabox
$meta_boxes[] = array(

    'title'  => esc_html__( 'Package Details', 'cityestate' ),    
    'pages'  => array( 'citystate_packages' ),
    'fields' => array(

        array(
            'id' 		=> 'package_time',
            'name' 		=> esc_html__( 'Package Time Duration', 'cityestate' ),
            'type' 		=> 'select',
            'options' 	=> array( 'Day' => esc_html__( 'Day', 'cityestate' ), 'Week' => esc_html__( 'Week', 'cityestate' ), 'Month' => esc_html__( 'Month', 'cityestate' ), 'Year' => esc_html__( 'Year', 'cityestate' ) ),
            'columns' 	=> 6,
        ),

        array(
            'id' 		=> 'package_unit',
            'name' 		=> esc_html__( 'Package per X unit', 'cityestate' ),
            'type' 		=> 'text',
            'std' 		=> '0',
            'desc'      => esc_html__( 'Ex: 1,2,3', 'cityestate' ),
            'columns' 	=> 6,
        ),

        array(
            'id' 		=> 'package_list',
            'name' 		=> esc_html__( 'How many listings are included?', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex: 50', 'cityestate' ),
            'columns' 	=> 6,

        ),

        array(
            'id' 		=> 'package_unlimited_list',
            'name' 		=> esc_html__( 'Allow unlimited listings', 'cityestate' ),
            'type' 		=> 'checkbox',
            'desc' 		=> esc_html__( 'Allow unlimited listings ?', 'cityestate' ),
            'columns' 	=> 6,
        ),

        array(
            'id' 		=> 'package_featured',
            'name' 		=> esc_html__( 'How many Featured listings are included?', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex: 20', 'cityestate' ),
            'columns' 	=> 6,
        ),

        array(
            'id' 		=> 'package_price',
            'name' 		=> esc_html__( 'Package Price ', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex: 59.99', 'cityestate' ),
            'columns' 	=> 6,
        ),

        array(
            'id' 		=> 'package_show',
            'name' 		=> esc_html__( 'Is Package Visible?', 'cityestate' ),
            'type' 		=> 'select',
            'options' 	=> array( 'yes' => esc_html__( 'Yes', 'cityestate' ), 'no' => esc_html__( 'No', 'cityestate' ) ),
            'columns' 	=> 6,
        ),

        array(
            'id' 		=> 'package_stripe_number',
            'name' 		=> esc_html__( 'Enter Package ID', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex: gold_package', 'cityestate' ),
            'columns' 	=> 6,
        )
    ),
);

?>