<?php

// Typography Option
Redux::setSection( $opt_name, array(

    'title'  => esc_html__( 'Typography', 'cityestate' ),
    'id'     => 'cityestate-typography',
    'icon'   => 'el-icon-font',
    'fields' => array(

        array(
            'id'                => 'typo-body',
            'type'              => 'typography',
            'title'             => esc_html__( 'Body', 'cityestate' ),
            'google'            => true,
            'font-family'       => true,
            'font-backup'       => false,
            'text-align'        => false,
            'text-transform'    => true,
            'font-style'        => false,
            'units'             => 'px',
            'subtitle'          => esc_html__( 'Select your custom font options for your main body fonts.', 'cityestate' ),
            'default'           => array(
                                        'color'             => '#000000',
                                        'font-weight'       => '300',
                                        'font-family'       => 'Roboto',
                                        'google'            => true,
                                        'font-size'         => '16px',
                                        'line-height'       => '24px',
                                        'text-transform'    => 'none'
                                    )
        ),

        array(
            'id'                => 'typo-headers',
            'type'              => 'typography',
            'title'             => esc_html__( 'Headers', 'cityestate' ),
            'google'            => true,
            'font-family'       => true,
            'font-backup'       => false,
            'text-align'        => true,
            'text-transform'    => true,
            'color'             => false,
            'font-style'        => false,
            'units'             => 'px',
            'subtitle'          => esc_html__( 'Select your custom font options for your headers.', 'cityestate' ),
            'default'           => array(
                                        'font-family'       => 'Roboto',
                                        'font-weight'       => '500',
                                        'google'            => true,
                                        'font-size'         => '14px',
                                        'line-height'       => '18px',
                                        'text-transform'    => 'none',
                                        'text-align'        => 'left'
                                    )
        ),

        array(
            'id'                => 'typo-mobile-menu',
            'type'              => 'typography',
            'title'             => esc_html__( 'Mobile Menu', 'cityestate' ),
            'google'            => true,
            'font-family'       => true,
            'font-backup'       => false,
            'text-align'        => true,
            'text-transform'    => true,
            'color'             => false,
            'font-style'        => false,
            'units'             => 'px',
            'subtitle'          => esc_html__( 'Select your custom font options for your mobile menu.', 'cityestate' ),
            'default'           => array(
                                        'font-family'       => 'Roboto',
                                        'font-weight'       => '500',
                                        'google'            => true,
                                        'font-size'         => '14px',
                                        'line-height'       => '18px',
                                        'text-transform'    => 'none',
                                        'text-align'        => 'left'
                                    )
        ),

        // Typo Headings 1
        array(
            'id'                => 'typo-headings',
            'type'              => 'typography',
            'title'             => esc_html__( 'Headings', 'cityestate' ),
            'google'            => true,
            'font-family'       => true,
            'font-backup'       => false,
            'text-align'        => true,
            'font-size'         => false,
            'line-height'       => false,
            'text-transform'    => true,
            'color'             => false,
            'font-style'        => false,
            'units'             => 'px',
            'subtitle'          => esc_html__( 'Select your custom font options for headings ( h1, h2, h3, h3 etc ).', 'cityestate' ),
            'default'           => array(
                                        'font-family'       => 'Roboto',
                                        'font-weight'       => '500',
                                        'google'            => true,
                                        'text-transform'    => 'inherit',
                                        'text-align'        => 'inherit'
                                    )

        )

    ),

));

?>