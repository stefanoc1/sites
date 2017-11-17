<?php

// Testimonial metabox
$meta_boxes[] = array(
    
    'id'        => 'ce_testimonials',    
    'title'     => esc_html__('Testimonial Details', 'cityestate' ),    
    'pages'     => array( 'ce_testimonials' ),    
    'context' 	=> 'normal',
    'fields'    => array(

        array(
            'name'      => esc_html__( 'Testimonial Text', 'cityestate' ),
            'id'        => 'customer_text',
            'type'      => 'textarea',
            'desc'      => esc_html__( 'Write a Testimonial into the textarea', 'cityestate' ),
            'columns'   => 6,
        ),        

        array(
            'name'      => esc_html__( 'By who?', 'cityestate' ),
            'id'        => 'customer_name',
            'type'      => 'text',
            'desc'      => esc_html__( 'Name of the Client who give feedback', 'cityestate' ),
            'columns'   => 6,
        ),

        array(
            'name'      => esc_html__( 'Position', 'cityestate' ),
            'id'        => 'customer_position',
            'type'      => 'text',
            'desc'      => esc_html__( 'Ex: Co-Founder & CEO','cityestate' ),
            'columns'   => 6,
        ),

        array(
            'name'      		=> esc_html__( 'Photo', 'cityestate' ),
            'id'        		=> 'customer_photo',
            'type' 				=> 'image_advanced',
            'max_file_uploads' 	=> 1,
            'columns'           => 6,           
        )
    )
);

?>