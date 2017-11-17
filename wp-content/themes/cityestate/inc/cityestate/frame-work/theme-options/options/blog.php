<?php

$allow_html = array(
    'i' => array(
        'class' => array()
    ),
    'span' => array(
        'class' => array()
    ),
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array()
    )
);

Redux::setSection( $opt_name, array(

    'title'  	=> esc_html__( 'Blog', 'cityestate' ),
    'id'     	=> 'blog',
    'icon'   	=> 'el-icon-edit',
    'fields'   	=> array(

        array(
            'id'       => 'blog_featured_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Blog featured image', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'blog_no_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Default Blank Featured Image', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',            
        ),

        array(
            'id'        => 'blog_no_image_src',
            'url'       => true,
            'type'      => 'media',
            'title'     => esc_html__( 'Custom Default Blank Featured Image', 'cityestate' ),
            'read-only' => false,         
            'default'   => '',
        ),        

        array(
            'id'     => 'blog-metadata-option',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses( __( '<span class="theme-option-section-heading">Metadata Options</span>', 'cityestate' ), $allow_html ),
            'desc'   => esc_html__( 'on Blog List', 'cityestate' )
        ),        

        array(
            'id'       => 'blog_show_date',
            'type'     => 'switch',
            'title'    => esc_html__( 'Blog date', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'blog_show_author',
            'type'     => 'switch',
            'title'    => esc_html__( 'Blog author name', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'blog_show_excerpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Blog excerpt', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'blog_excerpt_list',
            'type'     => 'text',
            'title'    => esc_html__( 'Excerpt Word Length for List Posts', 'cityestate' ),
            'subtitle' => esc_html__( 'Type the number of words you want to show in the blog page for each post.', 'cityestate' ),
            'default'  => '45',
            'required' => array( 'blog_show_excerpt', '=', 1 ),
        ),

        array(
            'id'       => 'blog_readmore_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Read More Text', 'cityestate' ),
            'subtitle' => esc_html__( 'You can set another name instead of read more link.', 'cityestate' ),
            'default'  => 'Read More'
        ),

        array(
            'id'     => 'post-metadata-option',
            'type'   => 'info',
            'notice' => false,
            'style'  => 'info',
            'title'  => wp_kses( __( '<span class="theme-option-section-heading">Metadata Options</span>', 'cityestate' ), $allow_html ),
            'desc'   => esc_html__( 'on Single Post', 'cityestate' )
        ),        

        array(
            'id'       => 'post_featured_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Featured Image on Single Post', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'post_show_date',
            'type'     => 'switch',
            'title'    => esc_html__( 'Post date', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'post_show_author',
            'type'     => 'switch',
            'title'    => esc_html__( 'Post author name', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

        array(
            'id'       => 'post_show_author_detail',
            'type'     => 'switch',
            'title'    => esc_html__( 'Post about author details', 'cityestate' ),
            'default'  => 1,
            'on'       => 'Show',
            'off'      => 'Hide',
        ),

    )

));

?>