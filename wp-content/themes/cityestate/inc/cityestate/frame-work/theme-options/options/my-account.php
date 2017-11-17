<?php

// Headers
Redux::setSection( $opt_name, array(

    'title'            => esc_html__( 'My Account', 'cityestate' ),
    'id'               => 'myaccount',
    'icon'             => 'el el-screen',
    'fields'           => array(

        array(
            'id'       => 'my_profile_label',
            'type'     => 'text',
            'title'    => esc_html__( 'My Profile Label', 'cityestate' ),
            'subtitle' => esc_html__( 'Label for link of my profile page', 'cityestate' ),
            'default'  => 'My Profile'
        ),

        array(
            'id'       => 'my_profile_page',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'My Profile Page', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

        array(
            'id'       => 'my_properties_label',
            'type'     => 'text',
            'title'    => esc_html__( 'My Properties Label', 'cityestate' ),
            'subtitle' => esc_html__( 'Label for link of my property page', 'cityestate' ),
            'default'  => 'My Properties'
        ),

        array(
            'id'       => 'my_properties_page',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'My Properties Page', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

        array(
            'id'       => 'submit_property_label',
            'type'     => 'text',
            'title'    => esc_html__( 'Submit Property Label', 'cityestate' ),
            'subtitle' => esc_html__( 'Label for link of submit property page', 'cityestate' ),
            'default'  => 'Submit Property'
        ),

        array(
            'id'       => 'submit_property_page',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'Submit Property Page', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

        array(
            'id'       => 'favorite_property_label',
            'type'     => 'text',
            'title'    => esc_html__( 'Favorite Properties Label', 'cityestate' ),
            'subtitle' => esc_html__( 'Label for link of favorite properties page', 'cityestate' ),
            'default'  => 'Favorite Property'
        ),

        array(
            'id'       => 'favorite_property_page',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'Favorite Property Page', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

         array(
            'id'       => 'saved_search_label',
            'type'     => 'text',
            'title'    => esc_html__( 'Saved Search Label', 'cityestate' ),
            'subtitle' => esc_html__( 'Label for link of saved search page', 'cityestate' ),
            'default'  => 'Saved Search'
        ),

        array(
            'id'       => 'saved_search_page',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'Save Search Page', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

        array(
            'id'       => 'invoice_label',
            'type'     => 'text',
            'title'    => esc_html__( 'Invoices Label', 'cityestate' ),
            'subtitle' => esc_html__( 'Label for link of Invoices page', 'cityestate' ),
            'default'  => 'Invoices'
        ),

        array(
            'id'       => 'invoice_page',
            'type'     => 'select',
            'multi'    => false,
            'title'    => esc_html__( 'Invoice Page', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select page', 'cityestate' ),
            'data'     => 'pages',
            'default'  => ''
        ),

    )

) );

?>