<?php

// Logo and Favicon
Redux::setSection( $opt_name, array(

    'title'  => esc_html__( 'Logos & Favicon', 'cityestate' ),
    'id'     => 'logo-favicon',
    'icon'   => 'el-icon-home',
    'fields' => array(

        array(
            'id'        => 'header_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Websit Logo', 'cityestate' ),
            'read-only' => false,
            'default'   => array( 'url' => get_template_directory_uri() .'/images/logos/logo.png' ),
            'subtitle'  => esc_html__( 'Upload your website logo.', 'cityestate' )
        ),

        array(
            'id'        => 'header_retina_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Website Logo Retina Version', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/logos/logo@2x.png' ),
            'subtitle'  => esc_html__( '', 'cityestate' )
        ),

        array(
            'id'        => 'header_transparent_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Logo For Transparent Header', 'cityestate' ),
            'read-only' => false,
            'default'   => array( 'url' => get_template_directory_uri() .'/images/logos/logo-white.png' ),
            'subtitle'  => esc_html__( 'Upload your website logo for transparent header.', 'cityestate' )
        ),

        array(
            'id'        => 'header_transparent_retina_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Logo For Transparent Header Retina Version', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/logos/logo-white@2x.png' ),
            'subtitle'  => esc_html__( 'Upload your website retina version logo for transparent header (optional).', 'cityestate' )
        ),

        array(
            'id'       => 'desktop_logo_dimensions',
            'type'     => 'dimensions',
            'units'    => array( 'px' ),
            'title'    => esc_html__( 'Size Of Desktop logo (Width/Height) Option', 'cityestate' ),
            'default'  => array( 'Width' => '', 'Height' => '' ),
            'subtitle' => esc_html__( 'Set custom size of Desktop logo.', 'cityestate' )
        ),        

        array(
            'id'        => 'retina_logo_width',
            'type'      => 'text',
            'default'   => '140px',
            'title'     => esc_html__( 'Select Ratina Logo Width', 'cityestate' ),
            'subtitle'  => esc_html__( 'Select your standard retina logo width.', 'cityestate' )
        ),

        array(
            'id'        => 'retina_logo_height',
            'type'      => 'text',
            'default'   => '24px',
            'title'     => esc_html__( 'Select Ratina Logo Height', 'cityestate' ),
            'subtitle'  => esc_html__( 'Select your retina logo height.', 'cityestate' )
        ),        

        array(
            'id'        => 'cityestate_favicon',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Upload Favicon', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/favicons/favicon.png' ),
            'subtitle'  => esc_html__( 'Upload your webwebsite favicon.', 'cityestate' )
        ),

        array(
            'id'        => 'cityestate_iphone_favicon',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Upload Apple iPhone Icon ', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/favicons/favicon-57x57.png' ),
            'subtitle'  => esc_html__( 'Upload your website iPhone icon (Size 57px by 57px).', 'cityestate' )
        ),

        array(
            'id'        => 'cityestate_iphone_favicon_retina',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Upload Apple iPhone Retina Icon ', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/favicons/favicon-114x114.png' ),
            'subtitle'  => esc_html__( 'Upload your website iPhone retina icon (Size 114px by 114px).', 'cityestate' )
        ),

        array(
            'id'        => 'cityestate_ipad_favicon',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Upload Apple iPad Icon ', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/favicons/favicon-72x72.png' ),
            'subtitle'  => esc_html__( 'Upload your website iPad icon (Size 72px by 72px).', 'cityestate' )
        ),

        array(
            'id'        => 'cityestate_ipad_favicon_retina',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Upload Apple iPad Retina Icon ', 'cityestate' ),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/favicons/favicon-144x144.png' ),
            'subtitle'  => esc_html__( 'Upload your website iPad retina icon (Size 144px by 144px).', 'cityestate' )
        )    
    )
) );