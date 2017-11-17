<?php

// Contact Form 7
Redux::setSection( $opt_name, array(

    'title'     => esc_html__( 'Contact Form 7', 'cityestate' ),
    'id'        => 'contact-form-7',
    'icon'      => 'el-icon-envelope',
    'fields'    => array(

        array(
            'id'       => 'contact_form_7_in_property_page',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable contact form 7 for property detail page ?', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' ),
        ),

        array(
            'id'       => 'contact_form_7_for_property_page',
            'type'     => 'textarea',
            'required' => array( 'contact_form_7_in_property_page', '=', '1' ),
            'title'    => esc_html__( 'Agent Contact Form', 'cityestate' ),
            'desc'     => esc_html__( 'Ex: [contact-form-7 id="5359" title="Contact Me"]', 'cityestate' ),
            'subtitle' => esc_html__( 'Enter contact for 7 shortcode for agent form above image, sidebar and property gallery lightbox.', 'cityestate' )
        ),
        
        array(
            'id'       => 'contact_form_7_in_agent_page',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable contact form 7 for agent detail page ?', 'cityestate' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enabled', 'cityestate' ),
            'off'      => esc_html__( 'Disabled', 'cityestate' ),
        ),

        array(
            'id'       => 'contact_form_7_for_agent_page',
            'type'     => 'textarea',
            'required' => array( 'contact_form_7_in_agent_page', '=', '1' ),
            'title'    => esc_html__( 'Agent Detail Form', 'cityestate' ),
            'desc'     => esc_html__( 'Ex: [contact-form-7 id="5359" title="Contact Me"]', 'cityestate' ),
            'subtitle' => esc_html__( 'Enter contact for 7 shortcode for agent detail page.', 'cityestate' )            
        )

    )

));

?>