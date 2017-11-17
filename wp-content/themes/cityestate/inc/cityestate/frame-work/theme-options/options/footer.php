<?php

$theme_dir = get_template_directory_uri() . '/';
$theme_img_dir = $theme_dir . 'images/';

// Footer
Redux::setSection( $opt_name, array(

    'title'  	=> esc_html__( 'Footer', 'cityestate' ),
    'id'     	=> 'footer',
    'icon'   	=> 'el-icon-bookmark',
    'fields'    => array(

        array(
            'id'       => 'cityestate_footer_show',
            'type'     => 'switch',
            'title'     => esc_html__( 'Display Footer', 'cityestate' ),            
            'default'  => 1,
            'on'       => esc_html__( 'Yes', 'cityestate' ),
            'off'      => esc_html__( 'No', 'cityestate' )
        ),

        array(
            'id'       => 'footer_top_pages',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'required' => array( 'cityestate_footer_show', '=', '1' ),
            'options'  => array(
                                'only_home'         => esc_html__( 'Only Homepage', 'cityestate' ),
                                'all_pages'         => esc_html__( 'Homepage + Inner Pages', 'cityestate' ),
                                'only_innerpages'   => esc_html__( 'Only Inner Pages', 'cityestate' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'cityestate' )
                            ),
            'desc'     => esc_html__( 'Select pages on which you want to show Footer', 'cityestate' ),
            'default'  => 'only_innerpages'
        ),

        array(
            'id'       => 'footer_top_selected_pages',
            'type'     => 'select',
            'multi'    => true,
            'required' => array( 'footer_top_pages', '=', 'specific_pages' ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select multiple pages', 'cityestate' ),
            'data'     => 'pages'
        ),

        array(
            'id'        => 'cityestate_footer_type',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Footer Layout Type', 'cityestate' ),
            'subtitle'  => wp_kses( __( '<br>Choose among these structures (1column, 2column, 3column and 4column) for your footer section.<br>To filling these column sections you should go to appearance > widget.<br>And put every widget that you want in these sections.','cityestate' ), array( 'br' => array() ) ),            
            'options'   => array(
                                '1' => array( 'title' => esc_html__( 'Footer Layout 1', 'cityestate' ), 'img' => $theme_img_dir . 'footertype/footer1.png' ),
                                '2' => array( 'title' => esc_html__( 'Footer Layout 2', 'cityestate' ), 'img' => $theme_img_dir . 'footertype/footer2.png' ),
                                '3' => array( 'title' => esc_html__( 'Footer Layout 3', 'cityestate' ), 'img' => $theme_img_dir . 'footertype/footer3.png' ),
                                '4' => array( 'title' => esc_html__( 'Footer Layout 4', 'cityestate' ), 'img' => $theme_img_dir . 'footertype/footer4.png' ),
                                '5' => array( 'title' => esc_html__( 'Footer Layout 5', 'cityestate' ), 'img' => $theme_img_dir . 'footertype/footer5.png' ),
                                '6' => array( 'title' => esc_html__( 'Footer Layout 6', 'cityestate' ), 'img' => $theme_img_dir . 'footertype/footer6.png' ),
                            ),
            'required'  => array( 'cityestate_footer_show', '=', '1' ),
            'default'   => '2',
        ),

        // Footer Bottom Section
        array(
            'id'       => 'footer_bottom_part',
            'type'     => 'section',            
            'title'    => esc_html__( 'Footer Bottom Section', 'cityestate' ),            
            'indent'   => true
        ),

        array(
            'id'       => 'cityestate_footer_bottom_enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Footer Bottom', 'cityestate' ),
            'subtitle' => wp_kses( __( '<br>This option shows a section below the footer that you can put copyright menu and logo in it.', 'cityestate' ), array( 'br' => array() ) ),
            'default'  => 1,            
            'on'       => esc_html__( 'Show', 'cityestate' ),
            'off'      => esc_html__( 'Hide', 'cityestate' )
        ),

        array(
            'id'       => 'footer_bottom_pages',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'required' => array( 'cityestate_footer_bottom_enable', '=', '1' ),
            'options'  => array(
                                'only_home'         => esc_html__( 'Only Homepage', 'cityestate' ),
                                'all_pages'         => esc_html__( 'Homepage + Inner Pages', 'cityestate' ),
                                'only_innerpages'   => esc_html__( 'Only Inner Pages', 'cityestate' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'cityestate' )
                            ),
            'desc'     => esc_html__( 'Select pages on which you want to show Footer', 'cityestate' ),
            'default'  => 'only_innerpages'
        ),

        array(
            'id'       => 'footer_bottom_selected_pages',
            'type'     => 'select',
            'multi'    => true,
            'required' => array( 'footer_bottom_pages', '=', 'specific_pages' ),
            'title'    => esc_html__( 'Select Pages', 'cityestate' ),
            'subtitle' => esc_html__( 'You can select multiple pages', 'cityestate' ),
            'data'     => 'pages'
        ),

        array(
            'id'        => 'cityestate_footer_bottom_left',
            'type'      => 'select',
            'title'     => esc_html__( 'Footer Bottom Left', 'cityestate' ),
            'options'   => array( '1' => esc_html__( 'Logo', 'cityestate' ), '2' => esc_html__( 'Menu', 'cityestate' ), '3' => esc_html__( 'Custom Text', 'cityestate' ) ),
            'required'  => array( 'cityestate_footer_bottom_enable', '=', '1' ),
            'default'   => '3'
        ),

        array(
            'id'        => 'cityestate_footer_bottom_right',
            'type'      => 'select',
            'title'     => esc_html__( 'Footer Bottom Right', 'cityestate' ),
            'options'   => array( '1' => esc_html__( 'Logo', 'cityestate' ), '2' => esc_html__( 'Menu', 'cityestate' ), '3' => esc_html__( 'Custom Text', 'cityestate' ) ),
            'required'  => array( 'cityestate_footer_bottom_enable', '=', '1' ),
            'default'   => '2'
        ),

        array(
            'id'        => 'cityestate_footer_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Select Footer Logo', 'cityestate' ),
            'subtitle'  => esc_html__( 'Please choose an image file for footer logo.', 'cityestate' ),
            'read-only' => false,
            'required'  => array( 'cityestate_footer_bottom_enable', '=', '1' ),
        ),
         array(
            'id'        => 'cityestate_footer_background_image',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Select Footer Background Image', 'cityestate' ),
            'subtitle'  => esc_html__( 'Please choose an image file for footer Background.', 'cityestate' ),
            'read-only' => false,
        ),

        array(
            'id'        => 'cityestate_footer_copyright',
            'type'      => 'text',
            'title'     => esc_html__( 'Enter Footer Copyright Text', 'cityestate' ),
            'required'  => array( 'cityestate_footer_bottom_enable', '=', '1' ),
            'default'   => esc_html__( 'Copyright 2017. All Rights Reserved by CityEstate.', 'cityestate' ),
        ),        

    )

));

?>