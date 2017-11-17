<?php

Redux::setSection( $opt_name, array(

    'title'      => esc_html__( 'Custom Code', 'cityestate' ),
    'id'         => 'custom_code',
    'icon'       => 'el el-cog',
    'fields'     => array(

        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom CSS Code', 'cityestate' ),
            'subtitle' => esc_html__( 'Paste your CSS code here.', 'cityestate' ),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'default'  => ''
        ),

        array(
            'id'       => 'custom_js_header',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom JS Code', 'cityestate' ),
            'subtitle' => esc_html__( 'Custom JavaScript/Analytics Header.', 'cityestate' ),
            'mode'     => 'text',
            'theme'    => 'chrome'            
        ),

        array(
            'id'       => 'custom_js_footer',
            'type'     => 'ace_editor',
            'title'    => esc_html__( 'Custom JS Code', 'cityestate' ),
            'subtitle' => esc_html__( 'Custom JavaScript/Analytics Footer.', 'cityestate' ),
            'mode'     => 'text',
            'theme'    => 'chrome'
        )

    )

) );

?>