<?php

// Agent metabox
$meta_boxes[] = array(

    'title'  => esc_html__( 'Agent Information', 'cityestate' ),    
    'pages'  => array( 'cityestate_agent' ),    
    'fields' => array(

        array(
            'name'      => esc_html__( 'Agent Detail', 'cityestate' ),
            'id'        => 'about_agent',
            'type'      => 'textarea',
            'columns'   => 12
        ),

        array(
            'name'      => esc_html__( 'Post Of Agent', 'cityestate' ),
            'id'        => 'agent_position',
            'type'      => 'text',
            'desc'      => esc_html__( 'Ex: Founder Or CEO.', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'name'      => esc_html__( 'Company Name', 'cityestate' ),
            'id'        => 'agent_company',
            'type'      => 'text',
            'desc'      => esc_html__( 'Ex: Fortune Creations', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id' 		=> 'agent_mobile',
            'name' 		=> esc_html__( 'Mobile Number', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. +91 1234 5678', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id' 		=> 'agent_office',
            'name' 		=> esc_html__( 'Office Number', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. 0222 12345', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id'        => 'agent_email',
            'name'      => esc_html__( 'Email Address', 'cityestate' ),
            'desc'      => esc_html__( 'Provide agent email address, Agent related messages from contact form will be sent on this email address. ', 'cityestate' ),
            'type'      => 'text',
            'std'       => '',
            'columns'   => 6
        ),

        array(
            'id' 		=> 'agent_fax',
            'name' 		=> esc_html__( 'Fax Number', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. 0222 12345', 'cityestate' ),
            'columns'   => 6
        ),        

        array(
            'id' 		=> 'agent_website',
            'name' 		=> esc_html__( 'Website', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. http://fortune-creations.com/', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id'        => 'agent_skype',
            'name'      => esc_html__( 'Skype', 'cityestate' ),
            'type'      => 'text',
            'std'       => '',
            'desc'      => esc_html__( 'Ex. fortunecreations', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id' 		=> 'agent_facebook',
            'name' 		=> esc_html__( 'Facebook URL', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. https://www.facebook.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id' 		=> 'agent_twitter',
            'name' 		=> esc_html__( 'Twitter URL', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. https://twitter.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id'        => 'agent_googleplus',
            'name'      => esc_html__( 'Google Plus URL', 'cityestate' ),
            'type'      => 'text',
            'desc'      => esc_html__( 'https://plus.google.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id'        => 'agent_pinterest',
            'name'      => esc_html__( 'Pinterest URL', 'cityestate' ),
            'type'      => 'text',
            'std'       => '',
            'desc'      => esc_html__( 'https://www.pinterest.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),        

        array(
            'id'        => 'agent_youtube',
            'name'      => esc_html__( 'Youtube URL', 'cityestate' ),
            'type'      => 'text',
            'desc'      => esc_html__( 'https://www.youtube.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id' 		=> 'agent_linkedin',
            'name' 		=> esc_html__( 'LinkedIn URL', 'cityestate' ),
            'type' 		=> 'text',
            'desc'      => esc_html__( 'Ex. https://www.linkedin.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id'        => 'agent_vimeo',
            'name'      => esc_html__( 'Vimeo URL', 'cityestate' ),
            'type'      => 'text',
            'desc'      => esc_html__( 'www.vimeo.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),

        array(
            'id'        => 'agent_instagram',
            'name'      => esc_html__( 'Instagram URL', 'cityestate' ),
            'type'      => 'text',
            'std'       => '',
            'desc'      => esc_html__( 'https://www.instagram.com/fcthemedesigns', 'cityestate' ),
            'columns'   => 6
        ),         

        array(
            'name'      => esc_html__( 'Header Type', 'cityestate' ),
            'id'        => 'header_type',
            'type'      => 'select',
            'options'   => array(
                                'static_image'      => esc_html__( 'Image', 'cityestate' ),
                            ),
            'std'       => array( 'none' ),
            'desc'      => esc_html__( 'Choose page header type', 'cityestate' ),
        ),

         array(
            'name'      => esc_html__( 'Show Original Page Title', 'cityestate' ),
            'id'        => 'original_page_title',
            'type'      => 'select',
            'options'   => array(
                                    'yes'              => esc_html__( 'Yes', 'cityestate' ),
                                    'no'   => esc_html__( 'No', 'cityestate' ),
                            ),
            'std'       => array( 'none' ),
            'desc'      => esc_html__( 'Choose page header type', 'cityestate' ),
        ),

        array(
            'name'      => esc_html__( 'Title', 'cityestate' ),
            'id'        => 'page_banner_title',
            'type'      => 'text',            
        ),

        array(
            'name'      => esc_html__( 'Subtitle', 'cityestate' ),
            'id'        => 'page_banner_subtitle',
            'type'      => 'text',
        ),

         array(
            'name'              => esc_html__( 'Image', 'cityestate' ),
            'id'                => 'page_banner_image',
            'type'              => 'image_advanced',
            'max_file_uploads'  => 1,            
        ),

        array(
            'name'      => esc_html__( 'Image Height', 'cityestate' ),
            'id'        => 'page_banner_height',
            'type'      => 'text',            
            'desc'      => esc_html__( 'Default 600px', 'cityestate '),
        ),

        array(
            'name'      => esc_html__( 'Overlay Color', 'cityestate' ),
            'id'        => 'page_banner_overlay',
            'type'      => 'color',
        ),

        array(
            'name'      => esc_html__( 'Overlay Color Opacity', 'cityestate' ),
            'id'        => 'page_banner_opacity',
            'type'      => 'select',
            'options'   => array(
                                    '0'     => '0',
                                    '0.1'   => '1',
                                    '0.2'   => '2',
                                    '0.3'   => '3',
                                    '0.4'   => '4',
                                    '0.5'   => '5',
                                    '0.6'   => '6',
                                    '0.7'   => '7',
                                    '0.8'   => '8',
                                    '0.9'   => '9',
                                    '1'     => '10',
                            ),
            'std'       => array( '0.5' ),            
        ),
    ),
);

?>